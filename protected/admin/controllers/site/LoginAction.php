<?php
session_start();
class LoginAction extends BaseAction{

	protected function beforeAction(){
        $this->controller->init_login_page();
        $this->controller->pageTitle="后台管理";
        return true;
    }
   protected function do_action(){	

    $ts = time();
		$model=new User("AdminLogin");
		// collect user input data
		if(isset($_POST['User']))
		{
			
			$model->attributes=$_POST['User'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->admin_login()){
			  //Yii::app()->session->add('permissions_type','59');
				$this->controller->redirect(array('site/index'));
			}
		}
		// display the login form
		$this->display('login',array('model'=>$model,'ts'=>$ts));
  }
  
  

}
?>
