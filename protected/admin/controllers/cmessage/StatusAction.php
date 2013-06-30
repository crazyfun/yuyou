<?php
class StatusAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
		$model=ContacterMessage::model();
		$id=$_REQUEST['id'];
		$status=$_REQUEST['status'];
		if(!empty($id)){
			if(is_array($id)){
				foreach($id as $key => $value){
					$model->updateByPk($value,array('status'=>$status));
				}
			}else{
			  $model->updateByPk($id,array('status'=>$status));
			}
		}
		$this->controller->redirect($this->controller->createUrl("index",array()));
  } 
}
?>
