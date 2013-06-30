<?php
class AutoCCommand extends CConsoleCommand
{
	public function run($args){
		$current_date=date('Y-m-d');
		//删除临时订单
		$temp_order=TempOrder::model();
		$temp_order->deleteAll();
		$tem_order_contacter=TemOrderContacter::model();
		$tem_order_contacter->deleteAll();
		$temp_order_insurance=TempOrderInsurance::model();
		$temp_order_insurance->deleteAll();
	 	 //取消预留
	 	 $travel_order=TravelOrder::model();
	 	 $travel_order->updateAll(array('reserved'=>'1','reserved_date'=>''),'reserved_date<=:reserved_date AND status=:status',array(':reserved_date'=>$current_date,':status'=>'2'));
	 	 //订单过期
	 	 $travel_order_datas=$travel_order->with("Travel","User",'TravelOrderContacter')->findAll("t.travel_date<=:travel_date AND (t.status='1' OR t.status='2' OR t.status='3' OR t.status='4' OR t.status='5')",array(':travel_date'=>$current_date));
	 	 foreach((array)$travel_order_datas as $key => $value){
	 	 	   $result=$value->updateByPk($value->id,array('status'=>'8','reserved'=>'1','reserved_date'=>''));
   			 $travel_order_numbers=TravelOrderNumbers::model();
   	 		$travel_order_numbers_data=$travel_order_numbers->find("t.travel_id=:travel_id AND t.start_date=:start_date",array(':travel_id'=>$value->travel_id,':start_date'=>$value->travel_date));
   	 		$travel_order_numbers_data->order_numbers=$travel_order_numbers_data->order_numbers-($value->adult_nums+$value->child_nums);
   	 		if($travel_order_numbers_data->validate()){
   	   		 $travel_order_numbers_data->insert_datas();
   	  			$travel=Travel::model();
      			$travel_data=$travel->findByPk($value->travel_id);
      			$travel_data->buy_numbers=$travel_data->buy_numbers-($value->adult_nums+$value->child_nums);
      			$travel_data->insert_datas();
   	 		}
   	 		if(!empty($value->coupon)||$value->coupon!='0.00'){
   	  			$user_id=$value->user_id;
   	  			$consume_temp=new ConsumeTemp();
		    		$consume_temp->consume(17,$user_id,'1',$value->coupon,array('title'=>$value->Travel->title,'value'=>$value->coupon));  
   			}
	 	 }	

	 	 //商家过期
	 	 $company=Company::model();
	 	 $company->updateAll(array('status'=>'2'),"status=:status AND start_time<=:start_time",array(':status'=>'1',':start_time'=>$current_date));
	 	 $company->updateAll(array('status'=>'1'),"status=:status AND (end_time<=:end_time)",array(':status'=>'2',':end_time'=>$current_date));
	 	 
	 	 //团购定制过期
	 	 $group_customize=GroupCustomize::model();
	 	 $group_customize->updateAll(array('status'=>'2'),'status=:status AND start_time<=:start_time',array(':status'=>'1',':start_time'=>$current_date));
  }
}
