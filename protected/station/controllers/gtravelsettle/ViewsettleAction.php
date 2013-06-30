<?php
class ViewsettleAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model=new TravelSettle();
  	$model_name=get_class($model);
  	$order_id=$_REQUEST['order_id'];
  	if(isset($_POST[$model_name])){
  			$model->attributes=$_POST[$model_name];
  			$model->type='1';
  			$model->status='2';
  			if($model->validate()){
  				$result=$model->insert_datas();
  				if($result){
  					$this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
  				}else{
  					$this->controller->f(CV::FAILED_ADMIN_OPERATE);
  				}
  	    }

  	}else{
  		
			$model_data=$model->find("t.order_id = :order_id",array(':order_id'=>$order_id));
			if(!empty($model_data)){
				$model=$model_data;
			}else{
			  $model->order_id=$order_id;
			}
	  }
			$travel_order=TravelOrder::model();
			$travel_order_data=$travel_order->with("Travel","User","TravelOrderContacter","Company")->findByPk($order_id);
			
			
	  $this->display('viewsettle',array('travel_order_data'=>$travel_order_data,'model'=>$model));
  } 
}
?>
