<?php
class Step3Action extends BaseAction{
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
   	    $model=TempOrder::model();
   	    $model=$model->with("Travel")->findByPk($order_id);
   	    if(empty($model)){
   	    	$this->controller->redirect($this->controller->createUrl("error/error404"));
   	    }
   	    $action=$_REQUEST['action'];
   	    if($action=="order"&&!empty($model)){

   	    	$travel_order=TravelOrder::model();
   	    	$travel_order_id=$travel_order->create_travel_order($order_id);
   	    	if($travel_order_id){
   	    		$comment=$_REQUEST['comment'];
   	    		$result=$travel_order->updateByPk($travel_order_id,array('comment'=>$comment));
   	    		$this->controller->redirect($this->controller->createUrl("travelpay/step4",array('order_id'=>$travel_order_id)));
   	    	}else{
   	    		$this->controller->set_flash("数据库操作错误",CV::FAILED_ADMIN_OPERATE);
   	    	}
   	    	
   	    }
				$this->display("step3",array('model'=>$model,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
   }
}
?>