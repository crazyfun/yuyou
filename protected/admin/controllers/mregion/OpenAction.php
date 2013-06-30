<?php
class OpenAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
		$model=Region::model();
		$id=$_REQUEST['id'];
		$open=$_REQUEST['open'];
		if(!empty($id)){
			$update_datas['open']=$open;
			$model->updateByPk($id,$update_datas);
		}
		$this->controller->redirect($this->controller->createUrl("index",array()));
  } 
}
?>
