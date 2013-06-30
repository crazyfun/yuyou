<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	$model=new Hotels();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
		  $model->attributes=$_POST[$model_name];
		  if(empty($model->modify_time)){
		  	$model->modify_time=Date("Y-m-d H:i:s");
		  }
		  $category_id=$_REQUEST['category_id'];
		  $model->category_id=$category_id;
		  $facility=$_REQUEST['facility'];
		  $model->facility=implode(",",(array)$facility);
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
   if(!empty($model->facility)){
   	$model->facility=explode(",",$model->facility);
  }else{
  	$model->facility=array();
  }
  
	 $this->display('add',array('model'=>$model));
  } 
 
}
?>
