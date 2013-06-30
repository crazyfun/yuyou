<?php
class ViewAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	$id=$_REQUEST['id'];
  	$model=GroupOrder::model();
  	$model=$model->with("Group","User")->findByPk($id);
	 $this->display('view',array('model'=>$model));
  } 
}
?>
