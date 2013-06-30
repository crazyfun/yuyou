<?php
class ViewAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	$id=$_REQUEST['id'];
  	$model=HotelsOrder::model();
  	$model=$model->with("Hotels","User","HotelsBeds","HotelsPrice","Company")->findByPk($id);
	 $this->display('view',array('model'=>$model));
  } 
}
?>
