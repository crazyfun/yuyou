<?php
class NotifyurlAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_hotels_page();
        $sys_config=SysConfig::model();
		    $all_syscfg_values=$sys_config->get_all_syscfg();
        WebConfig::set_seo_content(array('seo_title'=>$all_syscfg_values['sfc_home_title']),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action() {
   	  $pay_code=$_GET['code'];
   	  $pay_code_obj=ucfirst($pay_code);
      $pay_obj    = new $pay_code_obj();
      $result=$pay_obj->hotelsrespond();
   }
}
?>