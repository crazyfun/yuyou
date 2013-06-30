<?php
class TravelorderstatusAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_user_page();
        $this->controller->user_tag="travelorder";
        WebConfig::set_seo_content(array(),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action(){
   	  $cssPath=$this->controller->get_css_path();
     	$jsPath=$this->controller->get_js_path();
   	  $user_id=Yii::app()->user->id;
   	  $user=User::model();
   	  $user_data=$user->findByPk($user_id);
   	  $model=TravelOrder::model();
   	  $id=$_REQUEST['id'];
   	  $model_data=$model->with("Travel")->findByPk($id);
   	  if($model_data->user_id!=$user_id){
   	  	$this->controller->redirect($this->controller->createUrl("error/error404"));
   	  }
   	  $status=$_REQUEST['status'];
   	  if($status==8){
   	  	$result=$model->updateByPk($id,array('status'=>$status));
   	  	if($result){
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
   	  			$consume_temp=new ConsumeTemp();
		    	  $consume_temp->consume(	17,$user_id,'1',$model_data->coupon,array('title'=>$model_data->Travel->title,'value'=>$model_data->coupon));  
   	  		}
   	  	}
   	  }
   	  $this->controller->redirect($this->controller->createUrl("user/travelorder",array('order_status'=>'3')));
  }

}
?>