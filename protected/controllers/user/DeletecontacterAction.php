<?php
class DeletecontacterAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_user_page();
        $this->controller->user_tag="contacter";
        WebConfig::set_seo_content(array(),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action(){
    $model=Contacter::model();
		$id=$_REQUEST['id'];
		if(!empty($id)){
			  $model->delete_table_datas($id);
		}
		$this->controller->redirect($this->controller->createUrl("user/contacter",array()));
  }
}
?>