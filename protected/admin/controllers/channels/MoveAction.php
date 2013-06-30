<?php
class MoveAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	$model=new Channels();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$result=$model->updateByPk($_POST[$model_name]['id'],array('parent_id'=>$_POST[$model_name]['parent_id']));
			if($result){
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
		  $model_data=$model->findByPk($_POST[$model_name]['id']);
		  $pattern=$model_data->pattern;
	 }else{
		  $id=$_REQUEST['id'];
		  $model=!empty($id)?$model->get_table_datas($id,array()):$model;
		  $pattern=$model->pattern;
	 }
	 $this->display('move',array('model'=>$model,'pattern'=>$pattern));
  } 
}
?>
