<?php
class EditAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	$model=new TravelFlashAd();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
  		$flash_img=$model->flash_img;
		  $model->attributes=$_POST[$model_name];
		  $region_ids=$_POST[$model_name]['region_ids'];
		  if(!empty($region_ids)){
		  	$model->region_ids=implode(",",$region_ids);
		  }
		  //�ж��Ƿ����޸�ͼƬ
		  $select_flash_img=$_REQUEST['select_flash_img'];
		  if(!$select_flash_img){
		     $upload_file=CUploadedFile::getInstance($model, 'flash_img');
		     if(!empty($upload_file->name)){
					  $model->flash_img=Util::rename_file($upload_file->name);
			   }
			}else{
				 $model->flash_img=$flash_img;
			}
			if($model->validate()){
				//�ϴ�ͼƬ
				if(($upload_file!=null)&&!empty($model->flash_img)){
				  $save_path="upload/travelflashad";
			    Util::makeDirectory($save_path);
				  $upload_file->saveAs($save_path."/".$model->flash_img);
				  $model->flash_img=$save_path."/".$model->flash_img;
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
	 if(!empty($model->region_ids)){
	   $model->region_ids=explode(",",$model->region_ids);	
	 }
	 $this->display('add',array('model'=>$model));
  } 
}
?>
