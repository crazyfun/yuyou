<?php
class GrouporderviewAction extends BaseAction{
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
   	  $id=$_REQUEST['id'];
   	  $model=GroupOrder::model();
   	  $model=$model->with("Group")->findByPk($id);
   	  if($model->user_id!=$user_id){
   	  	$this->controller->redirect($this->controller->createUrl("error/error404"));
   	  }
		 $this->display("group_order_view",array('model'=>$model,'user_data'=>$user_data,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
  }

}
?>