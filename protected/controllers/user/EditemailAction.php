<?php
class EditemailAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_user_page();
        $this->controller->user_tag="editemail";
        WebConfig::set_seo_content(array(),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action(){
   	  $cssPath=$this->controller->get_css_path();
      $jsPath=$this->controller->get_js_path();
   	  require_once('config.inc.php');
  	  require_once('uc_client/client.php');
   	  $user_id=Yii::app()->user->id;
			$model=new User("EditEmail");
			$model_name=ucfirst(get_class($model));
			if($_POST[$model_name]){
				$model=!empty($_POST[$model_name]['id'])?$model->findByPk($_POST[$model_name]['id']):$model;
				$user_email=$model->user_email;
				if($user_email==$_POST[$model_name]['user_email']){
					$model->addError('user_email',"邮箱不能相同");
				}else{
				$model->setScenario("EditEmail");
      	$model->attributes=$_POST[$model_name];
				if($model->validate()){
		    		$result=$model->insert_datas();
		    		if($result){
		    			$user_email=$model->user_email;
		    			$ucresult = uc_user_edit($model->user_login,"","",$user_email,'1');
		    			$this->controller->f(CV::SUCCESS);
		    		}
		  	}else{
			     $this->controller->f(CV::FAIL);
		  	}
		   }
			}else{
      	 $model=empty($user_id)?$model:$model->findByPk($user_id);
      	 $user_email=$model->user_email;
			}
			$this->display('edit_email',array('model'=>$model,'user_email'=>$user_email,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
  }

}
?>