<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	
  	$model=new TravelAddress();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
		  $model->attributes=$_POST[$model_name];
			if($model->validate()){
			  $model->insert_datas();

			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
	 }else{
	 	  
		  $id=$_REQUEST['id'];
		  $travel_id=$_REQUEST['travel_id'];
		  $model=!empty($id)?$model->get_table_datas($id,array()):$model;
		  if(!empty($travel_id)){
		  	$model->travel_id=$travel_id;
		  }
	 }
	 $this->display('add',array('model'=>$model));
  } 
}
?>
