<?php
class SupportviewAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_user_page();
        $this->controller->user_tag="ssupport";
        WebConfig::set_seo_content(array(),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action(){
   	  $cssPath=$this->controller->get_css_path();
      $jsPath=$this->controller->get_js_path();
   	  $user_id=Yii::app()->user->id;
   		$id=$_REQUEST['id'];
   	if(empty($id)){
   	  	$this->controller->redirect($this->controller->createUrl("error/error404"));
   	}   
   	$model=ServiceSupport::model();
   	$content_model=new SupportContent();
		$content_model_name=ucfirst(get_class($content_model));
		if($_POST[$content_model_name]){
		          $content_model->attributes=$_POST[$content_model_name];
		    			$content_model->relation_id=$id;
		    			   //判断是否是修改图片
		  				$select_image=$_REQUEST['select_image'];
		  				if(!$select_image){
		     				$upload_file=CUploadedFile::getInstance($content_model, 'image');
		     				if(!empty($upload_file->name)){
					  				$content_model->image=Util::rename_file($upload_file->name);
			   				}
					 		}
					 		if($content_model->validate()){
					 			  //上传图片
								if(($upload_file!=null)&&!empty($content_model->image)){
									
				  					$save_path="upload/support";
			    					Util::makeDirectory($save_path);
				  					$upload_file->saveAs($save_path."/".$content_model->image);
				  					$content_model->image=$save_path."/".$content_model->image;
			 					 }
					 			$result1=$content_model->insert_datas();
					 			if($result1){
					 				$model->updateByPk($content_model->relation_id,array('status'=>'1'));
					 				$this->controller->f(CV::SUCCESS);
					 			}else{
					 				$this->controller->f(CV::FAIL);
					 			}
					 		}else{
					 			$this->controller->f(CV::FAIL);
					 		}
		
	  }else{	
   	 
   	}
    
   	$model=empty($id)?$model:$model->with("User","ConfigValues")->findByPk($id);
   	$support_content_data=$content_model->get_support_content_datas($id);
		$this->display("support_view",array('model'=>$model,'content_model'=>$content_model,'support_content_data'=>$support_content_data,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
  }

}
?>