<?php
class EditconponAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	

  	$model=new CouponResume();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
      $model->attributes=$_POST[$model_name];
      $consume_temp=new ConsumeTemp();
		  $consume_temp->consume(20,$model->user_id,$model->type,$model->value,array('value'=>$model->value));	  
			$this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		}else{
			$user_id=$_REQUEST['id'];
			$model->user_id=$user_id;
		}

		$this->display('editconpon',array('model'=>$model));
  } 
}
?>
