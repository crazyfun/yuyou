<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
    require_once('config.inc.php');
  	require_once('uc_client/client.php');
   	$user_id=Yii::app()->user->id;
   	$model=new Messages("AdminSend");
   	$action=$_REQUEST['action'];
   	switch($action){
   		case 'delete':
   		  $ids=$_REQUEST['ids'];
   		  $type=$_REQUEST['type'];
				if(!empty($ids)){
					if(is_array($ids)){
						foreach($ids as $key => $value){
							$model->delete_table_datas($value);
						}
					}else{
			  		$model->delete_table_datas($ids);
					}
				}
				$this->controller->redirect($this->controller->createUrl("message/index",array('type'=>$type)));
				break;
			case 'ajax_delete':
			  if(Yii::app()->request->isAjaxRequest){
    		   $id=$_REQUEST['id'];
    		   $result_flag=$model->delete_table_datas($id);
    		   if($result_flag){
    		   	$result=Util::combo_ajax_message('1',array('id'=>$id),"删除成功");
    		   }else{
    		   	$result=Util::combo_ajax_message('2',array(),"删除失败");
    		  }
       		 echo $result;
        }else{
        	return false;
        }
			  exit();
			  break;
      case 'send':
      $type=$_REQUEST['type'];
	    if(empty($type)){
	  		$type='1';
	  	}
     $model_name=ucfirst(get_class($model));
     $user_name="";
		 if($_POST[$model_name]){
			$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
			$model->setScenario("AdminSend");
      $model->attributes=$_POST[$model_name];
      $model->status='1';
			if($model->validate()){
		    	$result=$model->insert_datas();
		    	if($result){
		    		$this->controller->redirect($this->controller->createUrl("message/index",array('type'=>'3')));
		    	}
		  }else{
		  	    if(!empty($model->user_id)){
		  	    	 $user_model=User::model();
		  	    	 $user_datas=$user_model->findByPk($model->user_id);
		  	    	 $user_name=$user_datas->user_login;
		  	    }
			  		$this->controller->f(CV::FAIL);
		  }
		}
		  $this->display("index",array('model'=>$model,'cssPath'=>$cssPath,'jsPath'=>$jsPath,'type'=>$type,'user_name'=>$user_name));
		  break;
   		default:
   		  		$conditions=array();
	 				  $params=array();
	  				$page_params=array();
	  				$type=$_REQUEST['type'];
	  				if(empty($type)){
	  					$type='2';
	  				}
	  					if($type=="2"){
		   						array_push($conditions," (t.user_id=:user_id) OR (t.is_all=:is_all)");
		   						$params[':user_id']=$user_id;
		   						$params[':is_all']="2";
	  					}
	  					if($type=="3"){
	  						array_push($conditions,"t.create_id=:create_id");
	  						$params[':create_id']=$user_id;
	  					}
	  				
						//定义排序类
						$sort=new CSort();
  					$sort->attributes=array();
  					$sort->defaultOrder="t.create_time DESC";
  					$sort->params=$page_params;
  					
  					//生成ActiveDataProvider对象
	 					$criteria=new CDbCriteria;
	 					$dataProvider=new CActiveDataProvider($model, array(
							'criteria'=>array(
							'condition'=>implode(' AND ',$conditions),
							'params'=>$params,
							'with'=>array("User","SendUser"),
						),
						'pagination'=>array(
						'pageSize' => '20',
						'params' => $page_params,
					),
					'sort'=>$sort,
	 			));
				$this->display("index",array('model'=>$model,'dataProvider'=>$dataProvider,'page_params'=>$page_params,'type'=>$type));
   		  break;
   	}
  
  } 
}
?>
