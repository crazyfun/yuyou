<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model=new Images();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
  		$src=$model->src;
      $model->attributes=$_POST[$model_name];
      //ÅÐ¶ÏÊÇ·ñÊÇÐÞ¸ÄÍ¼Æ¬
		  $select_src=$_REQUEST['select_src'];
		  if(!$select_src){
		     $upload_file=CUploadedFile::getInstance($model, 'src');
		     if(!empty($upload_file->name)){
					  $model->src=Util::rename_file($upload_file->name);
			   }
			}else{
				 $model->src=$src;
			}
			if($model->validate()){
					//ÉÏ´«Í¼Æ¬
				if(($upload_file!=null)&&!empty($model->src)){
				  $save_path="upload/images";
			    Util::makeDirectory($save_path);
				  $upload_file->saveAs($save_path."/".$model->src);
				  $model->src=$save_path."/".$model->src;
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
