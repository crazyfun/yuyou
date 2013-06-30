<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	$model=new Information();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
  		$information_image=$model->information_image;
		  $model->attributes=$_POST[$model_name];
		  $model->model_type=CV::$model_type['help'];
		  //ÅÐ¶ÏÊÇ·ñÊÇÐÞ¸ÄÍ¼Æ¬
		  $select_information_image=$_REQUEST['select_information_image'];
		  if(!$select_information_image){
		     $upload_file=CUploadedFile::getInstance($model, 'information_image');
		     if(!empty($upload_file->name)){
					  $model->information_image=Util::rename_file($upload_file->name);
			   }
			}else{
				 $model->information_image=$information_image;
			}
			if($model->validate()){
				//ÉÏ´«Í¼Æ¬
				if(($upload_file!=null)&&!empty($model->information_image)){
				  $save_path="upload/information/".CV::$model_type['help'];
			    Util::makeDirectory($save_path);
				  $upload_file->saveAs($save_path."/".$model->information_image);
				  $model->information_image=$save_path."/".$model->information_image;
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
