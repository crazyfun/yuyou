<?php
class Step4Action extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_page();
        return true;
    }
   protected function do_action(){
   	    $cssPath=$this->controller->get_css_path();
     		$jsPath=$this->controller->get_js_path();
        $order_id=$_REQUEST['order_id'];
   			if(empty($order_id)){
   				$this->controller->redirect($this->controller->createUrl("error/error404"));
   			}
   			$model=TravelOrder::model();
   	  	$model=$model->with("Travel")->findByPk($order_id);
   	  	$this->controller->set_flash("您的订单生成成功，请等待计调确认。",CV::FAILED_ADMIN_OPERATE);
        $this->display("step4",array('model'=>$model,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
   }
}
?>