<?php
class DeleteAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
		$model=GalleryImages::model();
		$id=$_REQUEST['id'];
		$gallery_id=$_REQUEST['gallery_id'];
		if(!empty($id)){
			if(is_array($id)){
				foreach($id as $key => $value){
					$model->delete_table_datas($value);
				}
			}else{
			  $model->delete_table_datas($id);
			}
		}
		$this->controller->redirect($this->controller->createUrl("index",array('gallery_id'=>$gallery_id)));
  } 
}
?>
