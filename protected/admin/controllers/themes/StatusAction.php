<?php
class StatusAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
		$model=Themes::model();
		$id=$_REQUEST['id'];
    $model->updateAll(array('default_theme'=>'0'),'default_theme=:default_theme',array(':default_theme'=>'1'));
    $model->updateByPk($id,array('default_theme'=>'1'));
		$this->controller->redirect($this->controller->createUrl("index",array()));
  } 
}
?>
