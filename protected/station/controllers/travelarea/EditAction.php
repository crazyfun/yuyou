<?php
class EditAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	$model=new TravelArea();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
		  $model->attributes=$_POST[$model_name];
			if($model->validate()){
			  $model->insert_datas();
			   $import=$_POST[$model_name]['import'];
			  if($import){
			  	$images_category=ImagesCategory::model();
			  	$images_category_datas=$images_category->find("name=:name",array(':name'=>$model->travel_area));
			  	$images=Images::model();
			  	$images_datas=$images->findAll("category_id=:category_id",array(":category_id"=>$images_category_datas->id));
			  	$travel_images=TravelImages::model();
			  	foreach((array)$images_datas as $key => $value){
			  		$travel_images_data=$travel_images->find("travel_id=:travel_id AND travel_area_id=:travel_area_id AND image_id=:image_id",array(':travel_id'=>$model->travel_id,':travel_area_id'=>$model->id,':image_id'=>$value->id));
			  		if(empty($travel_images_data)){
			  			$travel_images->id=null;
  			 	  	$travel_images->setIsNewRecord(true);
  			 	  	$travel_images->travel_id=$model->travel_id;
  			 	  	$travel_images->travel_area_id=$model->id;
							$travel_images->image_id=$value->id;
							$travel_images->create_id=Yii::app()->user->id;
							$travel_images->create_time=time();
							if($travel_images->validate()){
								$travel_images->insert_datas();
							}
						}
			  	}
			  }
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
