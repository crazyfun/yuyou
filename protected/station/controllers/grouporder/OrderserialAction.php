<?php
class OrderserialAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	$model=new GroupOrder();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$order_serial=$_POST[$model_name]['order_serial'];
  		if(empty($order_serial)){
  			$model->addError("order_serial","订单号不能为空");
  		}else{
        $group_order_data=$model->with("Group")->find(array('condition'=>"t.order_serial=:order_serial AND Group.company_id=:company_id AND t.pay_status=:pay_status",'params'=>array(':order_serial'=>$order_serial,':company_id'=>$this->controller->company_id,':pay_status'=>'2'),'together'=>'true'));
  			if(empty($group_order_data)){
  				$model->addError("order_serial","订单号不存在");
  			}else{
  				
  				if($group_order_data->Group->user_time < date("Y-m-d H:i:s")){
  					$model->addError("order_serial","订单号已过期");
  				}else{
  					if($group_order_data->status=='2'){
  						$model->addError("order_serial","订单号已使用过");
  					}else{
  						$model->updateByPk($group_order_data->id,array('status'=>'2','user_time'=>time()));
           		$send_message=new SendMessage();
   	    	 		$send_message->send_message(23,$group_order_data->cell_phone,array('order_serial'=>$group_order_data->order_serial,'title'=>$group_order_data->Group->title,'user_date'=>date("Y-m-d H:i:s")));
              $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
  					}
  				}
  			}
  		}
	  }else{
		  
	  }
	 $this->display('order_serial',array('model'=>$model));
  } 
}
?>
