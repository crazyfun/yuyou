<?php
class StatusAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
		$model=HotelsOrder::model();
		$id=$_REQUEST['id'];
		$status=$_REQUEST['status'];
		$model_data=$model->with("Hotels","User",'HotelsBeds')->findByPk($id);
		if(!empty($id)){
			switch($status){
					case '3':
				   $result=$model->updateByPk($id,array('status'=>$status));
				  
           $send_message=new SendMessage();
   	    	 $send_message->send_message(27,$model_data->contacter_phone,array('order_serial'=>$model_data->order_serial,'title'=>$model_data->Hotels->title,'start_date'=>$model_data->start_date,'contact_phone'=>$model_data->Hotels->hotel_telephone,'address'=>$model_data->Hotels->hotel_address));
				  break;
				case '4':
				  $result=$model->updateByPk($id,array('status'=>$status));
				  if($result){
   	  			$hotels_order_numbers=new HotelsOrderNumbers();
		    		$start_date_time=strtotime($model_data->start_date);
						$end_date_time=strtotime($model_data->end_date);
						$diff_day=($end_date_time-$start_date_time)/86400;
						for($ii=0;$ii <= $diff_day;$ii++){
							$current_date=date("Y-m-d",mktime(0,0,0,date("m",$start_date_time),(date("d",$start_date_time)+$ii),date("Y",$start_date_time)));
							$order_numbers_data=$hotels_order_numbers->find("t.hotels_id=:hotels_id AND t.hotels_price_id=:hotels_price_id AND date=:date",array(':hotels_id'=>$model_data->hotels_id,':hotels_price_id'=>$model_data->hotels_price_id,':date'=>$current_date));
            	$hotels_order_numbers->updateByPk($order_numbers_data->id,array('order_numbers'=>($order_numbers_data->order_numbers-$model_data->numbers)));
						}
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
