<?php
class StatusAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
		$model=ServiceSupport::model();
		$id=$_REQUEST['id'];
		$status=$_REQUEST['status'];
		$model->updateByPk($id,array('status'=>$status));
		$this->controller->redirect($this->controller->createUrl("index",array()));
  } 
}
?>
