<?php
class AddsupportAction extends BaseAction{
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
		$model=new ServiceSupport();
		$content_model=new SupportContent();
		$model_name=ucfirst(get_class($model));
		$content_model_name=ucfirst(get_class($content_model));
		if($_POST[$model_name]){
			$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
      $model->attributes=$_POST[$model_name];
			if($model->validate()){
		    	$result=$model->insert_datas();
		    	if($result){
		    		if($_POST[$content_model_name]){
		    			$content_model->attributes=$_POST[$content_model_name];
		    			$content_model->relation_id=$model->id;
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
					 				$this->controller->redirect($this->controller->createUrl("user/ssupport"));
					 			}else{
					 				$this->controller->f(CV::FAIL);
					 			}
					 		}else{
					 			$this->controller->f(CV::FAIL);
					 		}
					 		
		    		}
		     }else{
		     	  $this->controller->f(CV::FAIL);
		    }
		  }else{
			  $this->controller->f(CV::FAIL);
		  }
		}else{
      
		}
		$this->display('add_support',array('model'=>$model,'content_model'=>$content_model,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
  }

}
?>