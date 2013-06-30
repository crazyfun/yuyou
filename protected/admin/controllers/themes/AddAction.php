<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	$model=new Themes();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
  		$theme_preview=$model->theme_preview;
			$model->attributes=$_POST[$model_name];
		 //ÅÐ¶ÏÊÇ·ñÊÇÐÞ¸ÄÍ¼Æ¬
		  $select_theme_preview=$_REQUEST['select_theme_preview'];
		  if(!$select_theme_preview){
		     $upload_file=CUploadedFile::getInstance($model, 'theme_preview');
		     if(!empty($upload_file->name)){
					  $model->theme_preview=Util::rename_file($upload_file->name);
			   }
			}else{
				 $model->theme_preview=$theme_preview;
			}
			if($model->validate()){
				//ÉÏ´«Í¼Æ¬
				if(($upload_file!=null)&&!empty($model->theme_preview)){
				  $save_path="upload/themes";
			    Util::makeDirectory($save_path);
				  $upload_file->saveAs($save_path."/".$model->theme_preview);
				  $model->theme_preview=$save_path."/".$model->theme_preview;
			  }
			  $model->insert_datas();
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
	}else{
		$id=$_REQUEST['id'];
		$model=!empty($id)?$model->get_table_datas($id,array()):$model;
	}

	$this->display('add',array('model'=>$model));
  } 
}
?>
