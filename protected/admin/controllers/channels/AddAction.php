<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	$model=new Channels();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
		  $model->attributes=$_POST[$model_name];
		  $channel_category=$_REQUEST['channel_category'];
		  if(!empty($channel_category)){
		  	$model->channel_category=implode(",",$channel_category);
		  }
			if($model->validate()){
			  $model->insert_datas();
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
	 }else{
		  $id=$_REQUEST['id'];
		  $parent_id=$_REQUEST['parent_id'];
		  $model=!empty($id)?$model->get_table_datas($id,array()):$model;
		  $model->parent_id=$parent_id;
		  if(empty($id)){
		  	$sys_config=SysConfig::model();
		  	$sys_config_datas=$sys_config->get_all_syscfg();
		  	$model->cover_template=$sys_config_datas['sfc_cover_template'];
		  	$model->lists_template=$sys_config_datas['sfc_lists_template'];
		  	$model->archive_template=$sys_config_datas['sfc_archive_template'];
		  	if(!empty($parent_id)){
		  		$parent_data=$model->findByPk($parent_id);
		  	$model->is_hidden=$parent_data->is_hidden;
		  	$model->pattern=$parent_data->pattern;
		  	$model->permission=$parent_data->permission;
		  	$model->link_type=$parent_data->link_type;
		  	$model->link_href=$parent_data->link_href;
		  	$model->channel_category=$parent_data->channel_category;
		  	$model->cover_template=$parent_data->cover_template;
		  	$model->lists_template=$parent_data->lists_template;
		  	$model->archive_template=$parent_data->archive_template;
		  	$model->list_view=$parent_data->list_view;
		  	$model->list_sort=$parent_data->list_sort;
		  	$model->list_sort_type=$parent_data->list_sort_type;
		  	$model->list_limit=$parent_data->list_limit;
		  	$model->image_size=$parent_data->image_size;
		  	$channel_category=explode(",",$model->channel_category);
		  	}
		  }else{
		  	
		  	$channel_category=explode(",",$model->channel_category);
		  }
	 }
	 $this->display('add',array('model'=>$model,'channel_category'=>$channel_category));
  } 
}
?>
