<?php
class DeleteAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
		$model=HotelsBeds::model();
		$id=$_REQUEST['id'];
		$hotels_id=$_REQUEST['hotels_id'];
		if(!empty($id)){
			if(is_array($id)){
				foreach($id as $key => $value){
					$model->delete_table_datas($value);
				}
			}else{
			  $model->delete_table_datas($id);
			}
		}
		$this->controller->redirect($this->controller->createUrl("index",array('hotels_id'=>$hotels_id)));
  } 
}
?>
