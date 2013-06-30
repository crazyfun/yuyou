<?php
class IndexAction extends BaseAction{
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
    	$cover_template=$channels_data->cover_template;
    	$cover_template=Util::get_file_name($cover_template);
			$this->display($cover_template,array('cssPath'=>$cssPath,'jsPath'=>$jsPath,'name'=>$name,'content'=>$channels_data->content,'channel'=>$channel,'channel_parent'=>$parent_id,'pattern'=>$channels_data->pattern));
    }
   }

}
?>