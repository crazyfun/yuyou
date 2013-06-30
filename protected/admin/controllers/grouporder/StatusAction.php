<?php
class StatusAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
		$model=GroupOrder::model();
		$id=$_REQUEST['id'];
		$status=$_REQUEST['status'];
		$model_data=$model->with("Group","User")->findByPk($id);
		if(!empty($id)){
				  $update_datas['status']=$status;
					$model->updateByPk($id,$update_datas);
		}
		$this->controller->redirect($this->controller->createUrl("index",array()));
  } 
}
?>
