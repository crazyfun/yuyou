<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	$model=new Travel();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
		  $model->attributes=$_POST[$model_name];
		  $model->start_region=$this->controller->region_id;
		  if(empty($model->modify_time)){
		  	$model->modify_time=Date("Y-m-d H:i:s");
		  }
		  $travel_att=$_REQUEST['travel_att'];
		  $category_id=$_REQUEST['category_id'];
		  $end_region=$_REQUEST['end_region'];
		  $start_region=$_REQUEST['start_region'];
		  $old_attr=$model->attr;
		  $old_attr=explode(",",$old_attr);
		  if(in_array("p",(array)$travel_att)){
		  	if(!in_array("p",$old_attr)){
		  		array_push($old_attr,"p");
		  	}
		  }else{
		  	if(in_array("p",$old_attr)){
		  		foreach($old_attr as $key => $value){
		  	  	if($value=="p"){
		  	  		unset($old_attr[$key]);
		  	  	}
		  	  }
		  	}
		  }
		  $model->category_id=$category_id;
		  $model->end_region=$end_region;
		  $model->start_region=$start_region;
		  $model->attr=implode(",",(array)$old_attr);
 			$mid_region=$_REQUEST['mid_region'];
		  $model->mid_region=$mid_region;
		  $linetype=$_REQUEST['linetype'];
		  $model->linetype=$linetype;
		  $model->company_id=$this->controller->company_id;
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
		  $channel_id=$_REQUEST['channel_id'];
		  $model=!empty($id)?$model->get_table_datas($id,array()):$model; 
		  $model->channel_id=$channel_id;
		 
	 }

	 $this->display('add',array('model'=>$model,'travel_att'=>$travel_att));
  } 
 
}
?>
