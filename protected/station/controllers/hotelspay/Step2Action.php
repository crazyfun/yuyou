<?php
class Step2Action extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_page();
        return true;
    }
   protected function do_action(){
   	   	$cssPath=$this->controller->get_css_path();
     		$jsPath=$this->controller->get_js_path();
        $order_id=$_REQUEST['id'];
   			if(empty($order_id)){
   				$this->controller->redirect($this->controller->createUrl("error/error404"));
   			}
   			$model=HotelsOrder::model();
   	  	$model=$model->with("Hotels","HotelsBeds","HotelsPrice")->findByPk($order_id);	
   	  	$this->display("step2",array('model'=>$model,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
   }
}
?>