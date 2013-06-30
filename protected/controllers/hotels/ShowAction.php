<?php
class ShowAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_hotels_page();
        return true;
    }
   protected function do_action(){
   	$cssPath=$this->controller->get_css_path();
    $jsPath=$this->controller->get_js_path();
    $archive=$_REQUEST['id'];
    if(empty($archive)){
    	$this->controller->redirect("/error/error404");
    }
    $archives_model=Hotels::model();
    $archive_data=$archives_model->with("Channels","ChannelCategory","Company","HotelRegion","HotelsBrand","HotelsBeds","HotelsArea","HotelsImages","HotelsTran")->findByPk($archive);
    if(empty($archive_data)){
    	$this->controller->redirect("/error/error404");
    }
    $archive_data->views=$archive_data->views+1;
    $archive_data->save();
    $channel=$archive_data->channel_id;
    $category=$archive_data->category_id;
    $channels=Channels::model();
    $channels_data=$channels->findByPk($channel);
    $parent_id=$channels_data->parent_id;
    $permission=$channels_data->permission;
    if(Util::view_permission($permission)){
    	$channel_name=$channels_data->name;
    	WebConfig::set_breadcrumbs(array($channel_name=>$this->controller->createUrl("mchannels/list",array('channel'=>$channel,'category'=>'')),$archive_data->title));
    	$seo_title=$archive_data->title;
    	$seo_keywords=$archive_data->seo_keywords;
    	$seo_describe=$archive_data->seo_describe;
    	$travel_tags=$archive_data->archive_tags;
   		WebConfig::set_seo_content(array('seo_title'=>$seo_title.",".$travel_tags),array('seo_keywords'=>$seo_keywords.",".$travel_tags),array('seo_description'=>$seo_describe.",".$travel_tags));
    	$archive_template=$channels_data->archive_template;
    	$archive_template=Util::get_file_name($archive_template);
    	if(empty($channels_data->pattern)){
    		$pattern_database="tr_archive";
    	}else{
    		$pattern_database="tr_".$channels_data->pattern;
    	}
    	if($this->controller->beginCache($id, array('dependency'=>array(
        'class'=>'system.caching.dependencies.CDbCacheDependency',
        'sql'=>'SELECT MAX(update_time) FROM '.$pattern_database)))){ 
            $this->display($archive_template,array('cssPath'=>$cssPath,'jsPath'=>$jsPath,'channel_name'=>$channel_name,'channel'=>$channel,'channel_parent'=>$parent_id,'category'=>$category,'archive'=>$archive,'content'=>$archive_data,'pattern'=>$channels_data->pattern));
        $this->controller->endCache();
      }
	  }
   }

}
?>