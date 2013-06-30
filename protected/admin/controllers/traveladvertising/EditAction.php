<?php
class EditAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	$model=new TravelAdvertising();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
		  $model->attributes=$_POST[$model_name];
		   $region_ids=$_POST[$model_name]['region_ids'];
		  if(!empty($region_ids)){
		  	$model->region_ids=implode(",",$region_ids);
		  }
			if($model->validate()){
			  $model->insert_datas();
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
	 }else{
		  $id=$_REQUEST['id'];
		  $model=!empty($id)?$model->get_table_datas($id,array()):$model;
	 }
	  if(!empty($model->region_ids)){
	   $model->region_ids=explode(",",$model->region_ids);	
	 }
	 $this->display('add',array('model'=>$model));
  } 
}
?>
