<?php
class ViewAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
	require_once('config.inc.php');
  	require_once('uc_client/client.php');
   	$user_id=Yii::app()->user->id;
   	$id=$_REQUEST['id'];
   	$type=$_REQUEST['type'];
   	if(empty($id)){
   		$this->controller->redirect($this->controller->createUrl("error/error404"));
   	}
   	$messages=Messages::model();
   	$message_data=$messages->findByPk($id);
   	$messages->updateByPk($id,array('status'=>'2'));
    $this->display('view',array('model'=>$model,'message_data'=>$message_data,'type'=>$type,'user_id'=>$user_id));
  } 
}
?>
