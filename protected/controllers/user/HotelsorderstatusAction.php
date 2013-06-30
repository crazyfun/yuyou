<?php
class HotelsorderstatusAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_user_page();
        $this->controller->user_tag="hotelsorder";
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
   	  $model=HotelsOrder::model();
   	  $id=$_REQUEST['id'];
   	  $model_data=$model->with("Hotels")->findByPk($id);
   	  if($model_data->user_id!=$user_id){
   	  	$this->controller->redirect($this->controller->createUrl("error/error404"));
   	  }
   	  $status=$_REQUEST['status'];
   	  if($status==4){
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
   	  }
   	  $this->controller->redirect($this->controller->createUrl("user/hotelsorder",array('order_status'=>'3')));
  }

}
?>