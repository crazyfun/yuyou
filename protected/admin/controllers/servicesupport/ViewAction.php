<?php
class ViewAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	$id=$_REQUEST['id'];
   	$model=ServiceSupport::model();
   	$content_model=new SupportContent();
   	$model=empty($id)?$model:$model->with("User","ConfigValues")->findByPk($id);
   	$support_content_data=$content_model->get_support_content_datas($id);
		$this->display("view",array('model'=>$model,'content_model'=>$content_model,'support_content_data'=>$support_content_data));
  } 
}
?>
