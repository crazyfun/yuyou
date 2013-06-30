<?php
class EditAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	$model=new Group();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
  		$image=$model->image;
		  $model->attributes=$_POST[$model_name];
		  $addition_select=$_REQUEST['addition_select'];
		  if(empty($model->modify_time)){
		  	$model->modify_time=Date("Y-m-d H:i:s");
		  }
		  $archive_att=$_REQUEST['archive_att'];
		  $select_image=$_REQUEST['select_image'];
		  $category_id=$_REQUEST['category_id'];
		  $model->category_id=$category_id;
		  $model->attr=implode(",",(array)$archive_att);
		  if(empty($addition_select)){
		  	$addition_select=array();
		  }
		  $save_path="upload/group/".$model->channel_id;
		  if(in_array('1',$addition_select)){
		    $first_image="";
		  	if(in_array('2',$addition_select)){
		  		$download_contents=$model->content=Util::httpdownloadimages($model->content,$save_path,true,true);
		  		$first_image=$download_contents['image'];
		  		$model_content=$download_contents['content'];
		  		$model->content=$model_content;
		  		
		  	}else{
		  		$download_contents=$model->content=Util::httpdownloadimages($model->content,$save_path,false,true);
		  		$first_image=$download_contents['image'];
		  		$model_content=$download_contents['content'];
		  		$model->content=$model_content;
		  		
		  	}
		   if(!$select_image){	
		  	$model->image=$first_image;
		   }else{
		   	  $model->image=$image;
		   }
		  }else{
		  	if(in_array('2',$addition_select)){
		  	 $download_contents=Util::httpdownloadimages($model->content,$save_path,true,false);
		  	 $model->content=$download_contents['content'];
		    }
		  	 //ÅÐ¶ÏÊÇ·ñÊÇÐÞ¸ÄÍ¼Æ¬
		  	if(!$select_image){
		     	$upload_file=CUploadedFile::getInstance($model, 'image');
		     	if(!empty($upload_file->name)){
					  $model->image=Util::rename_file($upload_file->name);
			   	}
				}else{
				 		$model->image=$image;
				}
		  }
			if($model->validate()){			 
			  //ÉÏ´«Í¼Æ¬
				if((!$select_image)&&($upload_file!=null)&&!empty($model->image)&&!in_array('1',$addition_select)){
			   	  Util::makeDirectory($save_path);
				  	$upload_file->saveAs($save_path."/".$model->image);
				  	$model->image=$save_path."/".$model->image;
			  }
			  if((!$select_image)&&!empty($model->image)){
			  	$this->resize_archive_image($model->channel_id,"",$model->image);
			  }		  
			  $model->content=$this->replace_archive_keywords($model->content);
			  $result=$model->insert_datas();
			  if($result){
			  	 if(!empty($model->archive_tags)){
			  	 	  $insert_archive_tags=explode(",",$model->archive_tags);
			  	 	  $archive_tags=ArchiveTags::model();
			  	 	  foreach($insert_archive_tags as $key => $value){
			  	 	  	 $archive_tags_datas=$archive_tags->find("tag_name=:tag_name",array(':tag_name'=>$value));
			  	 	  	 if(empty($archive_tags_datas)){
			  	 	  	 	  $archive_tags->setIsNewRecord(true);
			  	 	  	 	  $archive_tags->id=null;
			  	 	  	 	  $archive_tags->tag_name=$value;
			  	 	  	 	  $archive_tags->count=1;
			  	 	  	 	  $archive_tags->insert_datas();
			  	 	  	 }else{
			  	 	  	 	  $archive_tags_datas->count=$archive_tags_datas->count+1;
			  	 	  	 	  $archive_tags_datas->insert_datas();
			  	 	  	 }
			  	 	  }
			  	 }
			     $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
			  }else{
			  	 $this->controller->f(CV::FAILED_ADMIN_OPERATE);
			  }
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
	 }else{
		  $id=$_REQUEST['id'];
		  $model=!empty($id)?$model->get_table_datas($id,array()):$model; 
		  $attr=$model->attr;
		  $archive_att=explode(",",$attr);
		  $addition_select=array('1','2');
		  
	 }
	 $this->display('add',array('model'=>$model,'addition_select'=>$addition_select,'archive_att'=>$archive_att));
  } 
  
  function resize_archive_image($channel_id,$save_path,$image){
  	$channels=Channels::model();
  	$channels_data=$channels->findByPk($channel_id);
  	$image_size=$channels_data->image_size;
  	if(!empty($image_size)&&!empty($image)){
  	$explode_image_size=explode(",",$image_size);
  	foreach($explode_image_size as $key => $value){
  		$tem_explode=explode("*",$value);
  		$width=$tem_explode[0];
  		$height=$tem_explode[1];
  		Util::cut_image($width,$height,$save_path,$image);
  	}
  }
  }
  
   function replace_archive_keywords($content){
  	$archive_keywords=ArchiveKeywords::model();
  	$archive_keywords_datas=$archive_keywords->findAll();
  	$replace_name=array();
  	$replace_href=array();
  	foreach($archive_keywords_datas as $key => $value){
  		$percent=$value->percent;
  		$preg_count=preg_match_all("|(<a href='".$value->href."' target='_blank'>)?".$value->name."(</a>)?|",$content,$preg_match_all);
  		$replace_count=$preg_count*$percent;
  		$replace_name="|(<a href='".$value->href."' target='_blank'>)?".$value->name."(</a>)?|";
  		$replace_href="<a href='".$value->href."' target='_blank'>".$value->name."</a>";
  	  $content=preg_replace($replace_name,$replace_href,$content,$replace_count);
  	}
  	return $content;
  }
}
?>
