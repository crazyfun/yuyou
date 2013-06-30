<?php
class Step1Action extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_page();
        return true;
    }
   protected function do_action(){
   	  //初始化页面需要的全局变量
   	  $cssPath=$this->controller->get_css_path();
      $jsPath=$this->controller->get_js_path(); 
      $action=$_REQUEST['action'];
      $hotels_price_id=$_REQUEST['hotels_price_id'];
      if(empty($hotels_price_id)){
      	$this->controller->redirect($this->controller->createUrl("/error/error404"));
      	exit();
      } 
      $start_date=$_REQUEST['start_date'];
      $end_date=$_REQUEST['end_date'];
      $model=HotelsPrice::model();
      $model_data=$model->with("Hotels","HotelsBeds")->findByPk($hotels_price_id);
      $room_remain=$model_data->get_room_remain($model_data->id,$start_date,$end_date);
      if($room_remain<=0){
      	$this->controller->redirect($this->controller->createUrl("/error/errorover"));
      	exit();
      }
      $hotels_order=new HotelsOrder();
      $hotels_order_name=get_class($hotels_order);
    if(isset($_POST[$hotels_order_name])){
  		$hotels_order=!empty($_POST[$hotels_order_name]['id'])?$model->get_table_datas($_POST[$hotels_order_name]['id']):$hotels_order;
		  $hotels_order->attributes=$_POST[$hotels_order_name];
		  $hotels_order->start_date=$start_date;
		  $hotels_order->end_date=$end_date;
		  $numbers=$_REQUEST['numbers'];
		  $live_numbers=$_REQUEST['live_numbers'];
		  $hotels_order->numbers=$numbers;
		  $hotels_order->live_numbers=$live_numbers;
		  $date=new Date($hotels_order->start_date);
		  $diff_days=$date->dateDiff($hotels_order->end_date);
		  $hotels_order->total_price=floatval($hotels_order->numbers*$model_data->price*$diff_days);
		  $hotels_order->hotels_id=$model_data->hotels_id;
		  $hotels_order->hotels_bed_id=$model_data->bed_id;
		  $hotels_order->hotels_price_id=$model_data->id;
		  $hotels_order->company_id=$this->controller->company_id;
			if($hotels_order->validate()){
			  $result=$hotels_order->insert_datas();
			  if($result){
		    		$hotels_order->updateByPk($hotels_order->id,array('order_serial'=>("H".Util::randStr(6,"NUMBER").$hotels_order->id)));
		    		$this->controller->redirect($this->controller->createUrl("hotelspay/step2",array('id'=>$hotels_order->id)));
			  }else{
			  	 $this->controller->f(CV::FAIL);
			  }
		  }else{
			  $this->controller->f(CV::FAIL);
		  }
	 }else{
	 	 $hotels_order->start_date=$start_date;
	 	 $hotels_order->end_date=$end_date;
	 }
	
    $this->display("step1",array('model'=>$model_data,'hotels_order'=>$hotels_order,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
      
   }

}
?>