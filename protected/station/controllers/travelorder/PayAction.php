<?php
class PayAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	$model=new TravelPays();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
		 
		  $model->attributes=$_POST[$model_name];
		   $model->id=time();
		  $model->setIsNewRecord(true);
		  $model->pay_time=time();
		  $model->price=$model->TravelOrder->total_price;
		  $model->user_id=Yii::app()->user->id;

			if($model->validate()){
			  $result=$model->insert_datas();
			  if($result){
			  	
			  	$model->change_order_status($model->id,"");
			  }
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
	 }else{
		  $order_id=$_REQUEST['id'];
		  if(!empty($order_id)){
		  	$model->order_id=$order_id;
		  }
	 }
	 $this->display('pay',array('model'=>$model));
  } 
}
?>
