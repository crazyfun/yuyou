<?php
class EditAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	$model=new Downloadsserver();
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
		  $downloads_id=$_REQUEST['downloads_id'];
		  $model=!empty($id)?$model->get_table_datas($id,array()):$model;
		  if(!empty($downloads_id)){
		  	$model->downloads_id=$downloads_id;
		  }
	 }
	 $this->display('add',array('model'=>$model));
  } 
}
?>
