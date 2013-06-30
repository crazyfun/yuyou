<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model=new TravelImages();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
  		$model->attributes=$_POST[$model_name];
  		$old_image_ids=$_REQUEST['image_ids'];
  		$image_ids=explode(",",$old_image_ids);
  		$insert_model=new TravelImages();
  		foreach((array)$image_ids as $key => $value){
  			 $model_data=$insert_model->find("t.travel_id=:travel_id AND t.travel_area_id=:travel_area_id AND t.image_id=:image_id",array(':travel_id'=>$_POST[$model_name]['travel_id'],':travel_area_id'=>$_POST[$model_name]['travel_area_id'],':image_id'=>$value));
  			 if(empty($model_data)){
  			 	  $insert_model->id=null;
  			 	  $insert_model->setIsNewRecord(true);
						$insert_model->attributes=$_POST[$model_name];
						$insert_model->image_id=$value;
						if($insert_model->validate()){
							$insert_model->insert_datas();
						}
  			 }
  		}
  		$model->deleteAll("travel_id=:travel_id AND travel_area_id=:travel_area_id AND image_id NOT ".Util::db_create_in($image_ids),array(':travel_id'=>$_POST[$model_name]['travel_id'],':travel_area_id'=>$_POST[$model_name]['travel_area_id']));
		  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		}else{
			$id=$_REQUEST['id'];
			$travel_id=$_REQUEST['travel_id'];
			$model=!empty($id)?$model->get_table_datas($id,array()):$model;
			if(!empty($travel_id)){
				$model->travel_id=$travel_id;
			}
			$model_datas=$model->findAll(array('select'=>'t.image_id','condition'=>"t.travel_id=:travel_id",'params'=>array(':travel_id'=>$model->travel_id)));
			$image_ids=array();
			foreach((array)$model_datas as $key => $value){
				$image_ids[]=$value->image_id;
			}
			$old_image_ids=implode(",",array_unique($image_ids));
		}
		$this->display('add',array('model'=>$model,'str_image_ids'=>$old_image_ids));
  } 
}
?>
