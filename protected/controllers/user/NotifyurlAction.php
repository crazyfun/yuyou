<?php
class NotifyurlAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_user_page();
        $this->controller->tag="index";
        $this->controller->breadcrumbs=array('用户中心'=>$this->controller->createUrl("index"),'在线充值');
        $this->controller->set_seo('在线充值','','');
        return true;
    }
   protected function do_action(){
   	  $pay_code=$_GET['code'];
   	  $pay_code_obj=ucfirst($pay_code);
      $pay_obj    = new $pay_code_obj();
      $result=$pay_obj->respond();
     
  }

}
?>