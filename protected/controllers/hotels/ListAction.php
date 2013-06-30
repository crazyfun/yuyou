<?php
class ListAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_hotels_page();
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
    	 $ip_convert=IpConvert::get();
		    $region_data=$ip_convert->init_region();
   		WebConfig::set_seo_content(array('seo_title'=>$region_data['name']."出发".$seo_title),array('seo_keywords'=>$region_data['name']."出发".$seo_keywords),array('seo_description'=>$region_data['name']."出发".$seo_describe));
    	$lists_template=$channels_data->lists_template;
    	$lists_template=Util::get_file_name($lists_template);
  
			$this->display($lists_template,array('cssPath'=>$cssPath,'jsPath'=>$jsPath,'name'=>$name,'channel'=>$channel,'channel_parent'=>$parent_id,'category'=>$category,'pattern'=>$channels_data->pattern));
	  }
   }

}
?>