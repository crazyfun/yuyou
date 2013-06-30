<?php
class OrderserialAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	$model=new HotelsOrder();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$order_serial=$_POST[$model_name]['order_serial'];
  		if(empty($order_serial)){
  			$model->addError("order_serial","订单号不能为空");
  		}else{
  			$model->order_serial=$order_serial;
  			$model_data=$model->with("Hotels")->find(array('condition'=>"t.order_serial=:order_serial AND Hotels.company_id=:company_id AND t.pay_status=:pay_status AND t.status=3",'params'=>array(':order_serial'=>$order_serial,':company_id'=>$this->controller->company_id,':pay_status'=>'2')));
  			if(empty($model_data)){
  				$model->addError("order_serial","订单号不存在");
  			}else{
  				
  				if($model_data->end_date < date("Y-m-d")){
  					$model->addError("order_serial","订单号已过期");
  				}else{
  					if($model_data->status=='5'){
  						$model->addError("order_serial","客户已入住");
  					}else{
  						$model->updateByPk($model_data->id,array('status'=>'5','user_time'=>time()));
           		$send_message=new SendMessage();
   	    	 		$send_message->send_message(26,$model_data->contacter_phone,array('order_serial'=>$model_data->order_serial,'title'=>$model_data->Hotels->title));
              $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
  				}
  			}	
  		}
	}
}
	 $this->display('order_serial',array('model'=>$model));
  } 
}
?>
