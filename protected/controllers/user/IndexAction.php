<?php
class IndexAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_user_page();
        $this->controller->user_tag="index";
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
   	  $model=User::model();
   	  $model=empty($user_id)?$model:$model->findByPk($user_id);
			$this->display("index",array('model'=>$model,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
  }

}
?>