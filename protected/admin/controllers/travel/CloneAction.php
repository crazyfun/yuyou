<?php
class CloneAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	$model=new Travel();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
		  if(!empty($_POST[$model_name]['channel_id'])){
		  	$model->channel_id=$_POST[$model_name]['channel_id'];
		  }
		  if(!empty($_POST[$model_name]['company_id'])){
		  	$model->company_id=$_POST[$model_name]['company_id'];
		  }
		  $new_travel=new Travel();
		  $new_travel->attributes=$model->attributes;
		  $new_travel->attr="";
		  $new_travel->buy_numbers=0;
		  $new_travel->status=1;
		  $new_travel->views=0;
		  $new_travel->goods=0;
		  $new_travel->bads=0;
		  $new_travel->category_id="";
		  if($model->validate()){
		  	$new_travel->id=null;
		  	$new_travel->setIsNewRecord(true);
			  $result=$new_travel->insert_datas();
			  if($result){
			  	$travel_date=new TravelDate();
			  	$travel_date_datas=$travel_date->findAll("t.travel_id=:travel_id",array(':travel_id'=>$model->id));
			  	foreach($travel_date_datas as $key => $value){
			  		$travel_date->id=null;
			  		$travel_date->setIsNewRecord(true);
			  		$travel_date->attributes=$value->attributes;
			  		$travel_date->travel_id=$new_travel->id;
			  		if($travel_date->validate()){
			  		 	$result=$travel_date->insert_datas();
			  		}
			  		
			  	}
			  	
			  	
			  	$travel_images=new TravelImages();
			  	$travel_area=new TravelArea();
			  	$travel_area_datas=$travel_area->findAll("t.travel_id=:travel_id",array(':travel_id'=>$model->id));
			  	$new_area_ids=array();
			  	$old_area_ids=array();
			  	foreach($travel_area_datas as $key => $value){
			  		$travel_area->id=null;
			  		$travel_area->setIsNewRecord(true);
			  		$travel_area->attributes=$value->attributes;
			  		$travel_area->travel_id=$new_travel->id;
			  		if($travel_area->validate()){
			  		 	$result=$travel_area->insert_datas();
			  		 	if($result){
			  		 		 array_push($old_area_ids,$value->id);
			  		 		 array_push($new_area_ids,$travel_area->id);
			  	$travel_images_datas=$travel_images->findAll("t.travel_id=:travel_id AND t.travel_area_id=:travel_area_id",array(':travel_id'=>$model->id,':travel_area_id'=>$value->id));
			  	foreach($travel_images_datas as $key1 => $value1){
			  		$travel_images->id=null;
			  		$travel_images->setIsNewRecord(true);
			  		$travel_images->attributes=$value1->attributes;
			  		$travel_images->travel_area_id=$travel_area->id;
			  		$travel_images->travel_id=$new_travel->id;
			  		if($travel_images->validate()){
			  		 	$result=$travel_images->insert_datas();
			  		}
			  		
			  	}
			  		 	}
			  		}
			  		
			  	}
			  	
			  	
			  	$travel_route=new TravelRoute();
			  	$travel_route_datas=$travel_route->findAll("t.travel_id=:travel_id",array(':travel_id'=>$model->id));
			  	foreach($travel_route_datas as $key => $value){
			  		$travel_route->id=null;
			  		$travel_route->setIsNewRecord(true);
			  		$travel_route->attributes=$value->attributes;
			  		$travel_route->travel_route=str_replace($old_area_ids,$new_area_ids,$value->travel_route);
			  		$travel_route->travel_id=$new_travel->id;
			  		
			  		if($travel_route->validate()){
			  		 	$result=$travel_route->insert_datas();
			  		}
			  		
			  	}
	        $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
			  }else{
			  	$this->controller->f(CV::FAILED_ADMIN_OPERATE);
			  }
			  
			}else{
				$this->controller->f(CV::FAILED_ADMIN_OPERATE);
			}
		  
	 }else{
		  $id=$_REQUEST['id'];
		  $model=!empty($id)?$model->get_table_datas($id,array()):$model; 
	 }
	 $this->display('clone',array('model'=>$model));
  }
}
?>
