<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	$model=new HotelsPrice();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
		  $model->attributes=$_POST[$model_name];
			if($model->validate()){
				$hotels_beds=HotelsBeds::model();
				$hotels_beds_data=$hotels_beds->find("id=:id",array(':id'=>$_POST[$model_name]['bed_id']));
				$model->hotels_id=$hotels_beds_data->hotels_id;
			  $model->insert_datas();
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
	 }else{
	 	  
		  $id=$_REQUEST['id'];
		  $bed_id=$_REQUEST['bed_id'];
		  $model=!empty($id)?$model->get_table_datas($id,array()):$model;
		  if(!empty($bed_id)){
		  	$model->bed_id=$bed_id;
		  }
		  
	 }
	 $this->display('add',array('model'=>$model));
  } 
}
?>
