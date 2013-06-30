<?php
class EditcontacterAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_user_page();
        $this->controller->user_tag="contacter";
        WebConfig::set_seo_content(array(),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action(){
   	$cssPath=$this->controller->get_css_path();
    $jsPath=$this->controller->get_js_path();
    $id=$_REQUEST['id'];
		$user_id=Yii::app()->user->id;
		$model=new Contacter();
		$model_name=ucfirst(get_class($model));
		if($_POST[$model_name]){
			$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
      $model->attributes=$_POST[$model_name];
			if($model->validate()){
		    	$result=$model->insert_datas();
		    	if($result){
		    		$this->controller->f(CV::SUCCESS);
		    	}
		  }else{
			  $this->controller->f(CV::FAIL);
		  }
		}else{
       $model=empty($id)?$model:$model->findByPk($id);
       $model->user_id=$user_id;
		}
		$this->display('editcontacter',array('model'=>$model,'uc_avatarflash'=>$uc_avatarflash,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
  }
}
?>