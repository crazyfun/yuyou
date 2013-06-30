<?php
class EditAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	
  $model=new TravelDate();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
		  $model->attributes=$_POST[$model_name];
		  if($model->date_type=="2"){
		  	if($_POST[$model_name]['type_period_value1'] < $_POST[$model_name]['travel_date']){
		  		$_POST[$model_name]['type_period_value1']=$_POST[$model_name]['travel_date'];
		  	}
		  	$model->type_value1=$model->type_period_value1=$_POST[$model_name]['type_period_value1'];
		  	$model->type_value2=$model->type_period_value2=$_POST[$model_name]['type_period_value2'];
		  }
			if($model->validate()){
			  $result=$model->insert_datas();
			  if($result){
			     $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
			  }else{
			  	 $this->controller->f(CV::FAILED_ADMIN_OPERATE);
			  }
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
	 }else{
		  $id=$_REQUEST['id'];
		  $travel_id=$_REQUEST['travel_id'];
		  $model=!empty($id)?$model->get_table_datas($id,array()):$model; 
		  if(!empty($travel_id))
		  	$model->travel_id=$travel_id;
		  if($model->date_type=="2"){
		  		$model->type_period_value1=$model->type_value1;
		  		$model->type_period_value2=$model->type_value2;
		  }
	 }
	 $this->display('add',array('model'=>$model));
  }
}
?>
