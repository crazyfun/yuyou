<?php
class HotelsorderserialAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_page();
        $this->controller->user_tag="hotelsorder";
        WebConfig::set_seo_content(array(),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action(){
   	$cssPath=$this->controller->get_css_path();
    $jsPath=$this->controller->get_js_path();
    $id=$_REQUEST['id'];
		$user_id=Yii::app()->user->id;
		$user=User::model();
   	$user_data=$user->findByPk($user_id);
   	$model=HotelsOrder::model();
   	$hotels_order_data=$model->findByPk($id);
   	if($hotels_order_data->user_id!=$user_id){
   	   $this->controller->redirect($this->controller->createUrl("error/error404"));
   	}
   	$is_order_serial=false;
		$action=$_REQUEST['action'];
		if($action=="send"){
			   $pay_password=$_REQUEST['pay_password'];
			   $user_salt=Util::createSalt($user_data->user_salt);
				 if(Util::hc($pay_password,$user_salt)==$user_data->pay_password){
				 	    $is_order_serial=true;
			  		  $order_serial=$hotels_order_data->order_serial;
				 }else{
				   	$this->controller->set_flash("支付密码不正确",CV::FAIL);
				 }
		}
		$this->display('hotels_order_serial',array('id'=>$id,'is_order_serial'=>$is_order_serial,'order_serial'=>$order_serial,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
  }
}
?>