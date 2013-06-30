<?php
class GrouporderstatusAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_user_page();
        $this->controller->user_tag="grouporder";
        WebConfig::set_seo_content(array(),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action(){
   	  $cssPath=$this->controller->get_css_path();
     	$jsPath=$this->controller->get_js_path();
   	  $user_id=Yii::app()->user->id;
   	  $user=User::model();
   	  $user_data=$user->findByPk($user_id);
   	  $model=GroupOrder::model();
   	  $id=$_REQUEST['id'];
   	  $model_data=$model->with("Group")->findByPk($id);
   	  if($model_data->user_id!=$user_id){
   	  	$this->controller->redirect($this->controller->createUrl("error/error404"));
   	  }
   	  $status=$_REQUEST['status'];
   	  if($status==3){
   	  	$result=$model->updateByPk($id,array('status'=>$status));
   	  }
   	  $this->controller->redirect($this->controller->createUrl("user/grouporder",array('order_status'=>'3')));
  }

}
?>