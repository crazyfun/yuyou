<?php
class Registe2Action extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_main_page();
        WebConfig::set_seo_content(array(),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action(){
   	$cssPath=$this->controller->get_css_path();
    $jsPath=$this->controller->get_js_path();
		require_once('config.inc.php');
  	require_once('uc_client/client.php');
		$model=new User("WebRegiste2");
		$model_name=ucfirst(get_class($model));
		if($_POST[$model_name]){
			$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
			$model->setScenario("WebRegiste2");
      $model->attributes=$_POST[$model_name];
			if($model->validate()){
		    	$result=$model->insert_datas();
		    	if($result){
		    		$uc_avatarflash = uc_avatar($model->id);
		    		$this->controller->redirect($this->controller->createUrl("registe/registe3",array('uid'=>$model->id)));
		    	}
		  }else{
		  	$uc_avatarflash = uc_avatar($model->id);
			
		  }
		}else{
       $model=$model->findByPk($uid);
       $uc_avatarflash = uc_avatar($model->id);
		}
		$this->display('registe2',array('model'=>$model,'uc_avatarflash'=>$uc_avatarflash,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
   }

}
?>