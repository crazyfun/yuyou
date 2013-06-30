<?php
class LogoutAction extends BaseAction{
	
	protected function beforeAction(){
        $this->controller->layout='/layouts/login';
        return true;
    }
   protected function do_action(){
    Yii::app()->user->logout();
    Yii::app()->session->remove("permissions_type");
		$this->controller->redirect(array("site/login"));
  }
  
  

}
?>
