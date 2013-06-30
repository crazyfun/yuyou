<?php
class AgreementAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_page();
        WebConfig::set_seo_content(array(),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action(){
		Util::reset_vars();
		$sys_config=SysConfig::model();
		$sys_config_value=$sys_config->get_all_syscfg();
		$agreement_value=$sys_config_value['sfc_user_agreement'];
		$this->display('agreement',array('agreement_value'=>$agreement_value));
   }

}
?>