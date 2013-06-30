<?php
class ViewAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	$id=$_REQUEST['id'];
  	$model_name=Ucfirst($_REQUEST['model']);
  	$model=new $model_name;
  	$model=$model->findByPk($id);
	 $this->display('view',array('model'=>$model));
  } 
}
?>
