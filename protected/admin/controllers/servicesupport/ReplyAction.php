<?php
class ReplyAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
    $model=new SupportContent();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
		  $model->attributes=$_POST[$model_name];
		  $model->reply_id=Yii::app()->user->id;
      $model->reply_time=time();
			if($model->validate()){
			  $model->insert_datas();
			  $service_support=ServiceSupport::model();
			  $service_support->updateByPk($model->relation_id,array('status'=>'3'));
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
	 }else{
		  $id=$_REQUEST['id'];
		  $model=!empty($id)?$model->get_table_datas($id,array()):$model;
	 }
	 $this->display('reply',array('model'=>$model));
  } 
}
?>
