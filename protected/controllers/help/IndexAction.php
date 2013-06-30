<?php
class IndexAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_main_page();
        $sys_config=SysConfig::model();
		    $all_syscfg_values=$sys_config->get_all_syscfg();
        WebConfig::set_seo_content(array(),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action(){
   	  //初始化页面需要的全局变量
   	  $cssPath=$this->controller->get_css_path();
      $jsPath=$this->controller->get_js_path(); 
      $cid=$_REQUEST['cid'];
      
			if(empty($cid)){
				$category=InformationCategory::model();
				$category_data=$category->get_first_category(CV::$model_type['help']);
				$cid=$category_data->id;
			}
			$this->display("index",array('cssPath'=>$cssPath,'jsPath'=>$jsPath,'cid'=>$cid));
   }
}
?>