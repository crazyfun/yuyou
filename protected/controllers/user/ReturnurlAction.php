<?php
class ReturnurlAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_user_page();
        $this->controller->user_tag="index";
        WebConfig::set_seo_content(array(),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action(){
   	  $pay_code=$_GET['code'];
   	  $pay_code_obj=ucfirst($pay_code);
      $pay_obj    = new $pay_code_obj();
      $result=$pay_obj->respond();
      if($result){
      	$this->controller->f(CV::PAYSUCCESS);
      }else{
      	$this->controller->f(CV::PAYFAILED);
      }
      switch($pay_code){
      	case 'alipay':
      	  $price=$_GET['total_fee'];
      	  break;
      	case 'kuaiqian':
      	  $price=$_REQUEST['payAmount'];
      	  break;
      	default:
      	  break;
      }
   	  $this->display("pay3",array('price'=>$price,'pay_code'=>$pay_code));
		
  }

}
?>