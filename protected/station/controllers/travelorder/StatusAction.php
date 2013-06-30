<?php
class StatusAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
		$model=TravelOrder::model();
		$id=$_REQUEST['id'];
		$status=$_REQUEST['status'];
		$model_data=$model->with("Travel","User",'TravelOrderContacter')->findByPk($id);
		if(!empty($id)){
			switch($status){
					case '6':
				   $result=$model->updateByPk($id,array('status'=>$status));
				   $travel_order_contacter=TravelOrderContacter::model();
   	    	 $order_contacter_data=$travel_order_contacter->find("t.order_id=:order_id AND t.main=:main",array(':order_id'=>$model_data->id,':main'=>1));
           $travel_order_serial=TravelOrderSerial::model();
   	    	 $order_serial_data=$travel_order_serial->find("t.order_id=:order_id",array(':order_id'=>$model_data->id));
   	    	 $company=Company::model();
           $company_data=$company->findByPk($model_data->company_id);
           $send_message=new SendMessage();
   	    	 $send_message->send_message(18,$order_contacter_data->contacter_phone,array('order_serial'=>$travel_order_serial->order_serial,'title'=>$model_data->Travel->title,'travel_date'=>$model_data->travel_date,'contact_phone'=>$company_data->telephone,'address'=>$company_data->address));
				  break;
				case '8':
				  $result=$model->updateByPk($id,array('status'=>$status,'reserved'=>'1','reserved_date'=>''));
   	  		$travel_order_numbers=TravelOrderNumbers::model();
   	  		$travel_order_numbers_data=$travel_order_numbers->find("t.travel_id=:travel_id AND t.start_date=:start_date",array(':travel_id'=>$model_data->travel_id,':start_date'=>$model_data->travel_date));
   	  		$travel_order_numbers_data->order_numbers=$travel_order_numbers_data->order_numbers-($model_data->adult_nums+$model_data->child_nums);
   	  		if($travel_order_numbers_data->validate()){
   	  				$travel_order_numbers_data->insert_datas();
   	  				$travel=Travel::model();
      				$travel_data=$travel->findByPk($model_data->travel_id);
      			  $travel_data->buy_numbers=$travel_data->buy_numbers-($model_data->adult_nums+$model_data->child_nums);
      			  $travel_data->insert_datas();
   	  	  }
   	  		if(!empty($model_data->coupon)||$model_data->coupon!='0.00'){
   	  			$user_id=$model_data->user_id;
   	  			$consume_temp=new ConsumeTemp();
		    	  $consume_temp->consume(17,$user_id,'1',$model_data->coupon,array('title'=>$model_data->Travel->title,'value'=>$model_data->coupon));  
   	  		}
   	  	
				  break;
				default:
				  $update_datas['status']=$status;
					$model->updateByPk($id,$update_datas);
				  break;
			}
			
		}
		$this->controller->redirect($this->controller->createUrl("index",array()));
  } 
}
?>
