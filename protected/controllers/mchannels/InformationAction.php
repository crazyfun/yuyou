<?php
class InformationAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_main_page();
        return true;
    }
   protected function do_action(){
   	$cssPath=$this->controller->get_css_path();
    $jsPath=$this->controller->get_js_path();
		$channel=$_REQUEST['channel'];
		if(empty($channel)){
			$this->controller->redirect("/error/error404");
		}
		$category=$_REQUEST['category'];
    $channels=Channels::model();
    $channels_data=$channels->findByPk($channel);
    $parent_id=$channels_data->parent_id;
    $permission=$channels_data->permission;
    if(Util::view_permission($permission)){
    	$name=$channels_data->name;
    	WebConfig::set_breadcrumbs(array($name));
    	$seo_title=$channels_data->seo_title;
    	$seo_keywords=$channels_data->seo_keywords;
    	$seo_describe=$channels_data->seo_describe;
   		WebConfig::set_seo_content(array('seo_title'=>$seo_title),array('seo_keywords'=>$seo_keywords),array('seo_description'=>$seo_describe));
    	$lists_template=$channels_data->lists_template;
    	$lists_template=Util::get_file_name($lists_template);
  
    $model=Archives::model();
    $condition=array();
		$params=array();
		$page_params=array(); 
		
		
		if(!empty($channel)){
      $channel_childrens=$channels->get_descendant($channel);
			$condition[]="t.channel_id ".Util::db_create_in($channel_childrens);
			$page_params['channel']=$channel;
		}
		$title=$_REQUEST['title'];
		if(!empty($title)){
      
			$condition[]="t.title LIKE :title";
			$params[':title']="%".$title."%";
			$page_params['title']=$title;
		}
		
		
		$channel_category=ChannelCategory::model();
		if(!empty($category)){
    	$category_childrens=$channel_category->get_descendant($category);
    	$condition[]="t.category_id ".Util::db_create_in($category_childrens);
			$page_params['category']=$category;
		}

  	$condition[]=" t.status=:status ";
    $params[':status']='2';
    
    $config_values=ConfigValues::model();
    $sort_select=$config_values->findByPk($channels_data->list_sort);
		$sort_select=$sort_select->value;
		$block_sort_type=CV::$block_sort_type;
		$sort_type=$block_sort_type[$channels_data->list_sort_type];
				
				
       //定义排序类
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.".$sort_select." ".$sort_type;
  	$sort->params=$page_params;
  	
  	//生成ActiveDataProvider对象
  	$dataProvider=new CActiveDataProvider($model, array(
				'criteria'=>array(
			  	'condition'=>implode(' AND ',$condition),
			 	 	'params'=>$params,
			  	'with'=>array('Channels','User',"ChannelCategory"),
			  	'together'=>true,
		    ),
				'pagination'=>array(
          'pageSize' => $channels_data->list_limit,
          'params' => $page_params,
      	),
      	'sort'=>$sort,
		));
		
		
		
  
			$this->display($lists_template,array('cssPath'=>$cssPath,'jsPath'=>$jsPath,'name'=>$name,'channel'=>$channel,'channel_parent'=>$parent_id,'category'=>$category,'pattern'=>$channels_data->pattern,'dataProvider'=>$dataProvider,'page_params'=>$page_params));
	  }
   }

}
?>