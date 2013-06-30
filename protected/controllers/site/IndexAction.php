<?php
class IndexAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_main_page();
        $sys_config=SysConfig::model();
		    $all_syscfg_values=$sys_config->get_all_syscfg();
		    $ip_convert=IpConvert::get();
		    $region_data=$ip_convert->init_region();
        WebConfig::set_seo_content(array('seo_title'=>$region_data['name']."出发".$all_syscfg_values['sfc_home_title']),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action(){
      
   	  //初始化页面需要的全局变量
   	  $cssPath=$this->controller->get_css_path();
      $jsPath=$this->controller->get_js_path(); 
			$this->display("index",array('cssPath'=>$cssPath,'jsPath'=>$jsPath));
   }

}
?>