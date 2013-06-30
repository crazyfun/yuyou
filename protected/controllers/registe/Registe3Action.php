<?php
class Registe3Action extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_main_page();
        WebConfig::set_seo_content(array(),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action(){
   	$cssPath=$this->controller->get_css_path();
    $jsPath=$this->controller->get_js_path();
		$this->display('registe3',array('model'=>$model,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
   }

}
?>