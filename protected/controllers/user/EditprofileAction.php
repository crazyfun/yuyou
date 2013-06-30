<?php
class EditprofileAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_user_page();
        $this->controller->user_tag="editprofile";
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
		$model=new User();
		$model_name=ucfirst(get_class($model));
		if($_POST[$model_name]){
			$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
			$model->setScenario("WebRegiste2");
      $model->attributes=$_POST[$model_name];
			if($model->validate()){
		    	$result=$model->insert_datas();
		    	if($result){
		    		$uc_avatarflash = uc_avatar($model->id);
		    		$this->controller->f(CV::SUCCESS);
		    	}
		  }else{
		  	$uc_avatarflash = uc_avatar($model->id);
			  $this->controller->f(CV::FAIL);
		  }
		}else{
       $model=empty($user_id)?$model:$model->findByPk($user_id);
       $uc_avatarflash = uc_avatar($model->id);
		}
		$this->display('edit_profile',array('model'=>$model,'uc_avatarflash'=>$uc_avatarflash,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
  }
}
?>