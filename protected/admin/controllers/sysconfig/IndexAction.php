<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model      = new SysConfig();
  	$model_name = get_class($model);
    $cus_form   = "sci";
    $sci_pk     = $model->getMetaData()->tableSchema->primaryKey;
  	//处理表单数据
  	$oldcfg = array();
  	if( isset( $_POST[$model_name] ) || isset( $_POST[$cus_form] )){
  		
      foreach( $_POST[$cus_form] as $sci_n => $sci_v ){
      	$sci_crit = $model->get_table_datas( NULL, array('condition' =>"sci_name='$sci_n'") );
        if( !empty( $sci_crit ) ){//更新
        	 $model->$sci_pk    = $sci_crit[0]->id;
        	 $model->_pk        = $sci_crit[0]->id;
        	 $model->attributes = array('sci_name'=> $sci_n, 'sci_value'=> $sci_v);
        	 $model->setIsNewRecord(false);
        }else{//新增
        	 $model->$sci_pk    = 0;
        	 $model->attributes = array('sci_name'=> $sci_n, 'sci_value'=> $sci_v);
        	 $model->setIsNewRecord(true);
        }
        
        //数据验证
			  if( $model->validate() && !$model->hasErrors() ){//模型验证
			    $model->save();
		    }else{//未通过验证
		    	$this->controller->f(CV::FAILED_ADMIN_OPERATE);
		    	//$this->_errors
			    break;
		    }
      }
      
      //新增或更新后
      if( !$model->hasErrors() ) {
      	$this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
      	$oldcfg = $model->get_admin_all_sysconfig();
      }
      	
		}else{//更新数据：
			
		  //获取全部的信息，
      $oldcfg = $model->get_admin_all_sysconfig();
		}

		$this->display('index',array('model'=> $model,'oldcfg'=> $oldcfg ));
  }
  
}
?>
