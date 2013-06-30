<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	$model=new Region();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['region_id'])?$model->get_table_datas($_POST[$model_name]['region_id']):$model;
		  $model->attributes=$_POST[$model_name];
			if($model->validate()){
			  $model->insert_datas();
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
	 }else{
		  $pid=$_REQUEST['pid'];
		  if($pid){
		  	$model->parent_id=$pid;
		  }
	 }
	 $this->display('add',array('model'=>$model));
  } 
}
?>
