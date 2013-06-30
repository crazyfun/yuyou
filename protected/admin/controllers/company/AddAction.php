<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	
  	$model=new Company();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
		  $model->attributes=$_POST[$model_name];
      $model->agreement='1';
      if(empty($_POST[$model_name]['start_time'])){
      	$model->start_time=date("Y-m-d");
      }
     if(!empty($_POST[$model_name]['end_time'])){
     	 if($_POST[$model_name]['region_id']=='0'){
      	$model->region_id="";
      }
			if($model->validate()){
			  $result=$model->insert_datas();
			  if($result){
			   if($model->company_type=="6"){
			  	$hotels=new Hotels();
			  	$hotels_data=$hotels->find("t.company_id=:company_id",array(':company_id'=>$model->id));
			  	$hotels=empty($hotels_data)?$hotels:$hotels_data;
			  	$hotels->channel_id=138;
			  	$hotels->title=$model->company_name;
			  	$hotels->hotel_level=1;
			  	$hotels->hotel_region=$model->region_id;
			  	$hotels->hotel_price_limit=1;
			  	$hotels->company_id=$model->id;
			  	$hotels->hotel_address=$model->address;
			  	$hotels->hotel_coordinate=$model->coordinate;
			  	$hotels->hotel_telephone=$model->telephone;
			  	if($hotels->validate()){
			       $hotels->insert_datas();
			    }
			   }
			  	$this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
			  }
			  
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
		 }else{
		 	 $model->addError('end_time',"结束时间不能为空");
		 }
		  
	 }else{
		  $id=$_REQUEST['id'];
		  $model=!empty($id)?$model->get_table_datas($id,array()):$model;
	 }
	 $this->display('add',array('model'=>$model));
  } 
}
?>
