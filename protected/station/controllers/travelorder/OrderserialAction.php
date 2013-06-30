<?php
class OrderserialAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	$model=new TravelOrderSerial();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$order_serial=$_POST[$model_name]['order_serial'];
  		if(empty($order_serial)){
  			$model->addError("order_serial","订单号不能为空");
  		}else{
  			$model->order_serial=$order_serial;
  			$model_data=$model->find(array('condition'=>"order_serial=:order_serial",'params'=>array(':order_serial'=>$order_serial)));
  			$travel_order=TravelOrder::model();
        $travel_order_data=$travel_order->with("Travel")->find(array('condition'=>"t.id=:order_id AND Travel.company_id=:company_id AND t.pay_status=:pay_status AND (t.status=6 OR t.status=7)",'params'=>array(':order_id'=>$model_data->order_id,':company_id'=>$this->controller->company_id,':pay_status'=>'2')));
  			
  			if(!empty($travel_order_data)){
  			if(empty($model_data)){
  				$model->addError("order_serial","订单号不存在");
  			}else{
  				
  				if($travel_order_data->travel_date < date("Y-m-d")){
  					$model->addError("order_serial","订单号已过期");
  				}else{
  					if($model_data->status=='2'){
  						$model->addError("order_serial","订单号已使用过");
  					}else{
  						$model->updateByPk($model_data->id,array('status'=>'2','user_time'=>time()));
  						$travel_order->updateByPk($model_data->order_id,array('status'=>'9'));

  						$travel_order_contacter=TravelOrderContacter::model();
   	    			$order_contacter_data=$travel_order_contacter->find("t.order_id=:order_id AND t.main=:main",array(':order_id'=>$model_data->order_id,':main'=>1));
           		$send_message=new SendMessage();
   	    	 		$send_message->send_message(19,$order_contacter_data->contacter_phone,array('order_serial'=>$model_data->order_serial,'title'=>$travel_order_data->Travel->title,'travel_date'=>$travel_order_data->travel_date));
              $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
  					}
  				}
  			}
  		}else{
  			$model->addError("order_serial","订单号不存在");
  		}
  			
  			
  		}
	  }else{
		  
	  }
	 $this->display('order_serial',array('model'=>$model));
  	
  } 
}
?>
