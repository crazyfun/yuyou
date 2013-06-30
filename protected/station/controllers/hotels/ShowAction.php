<?php
class ShowAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
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
    $this->display("show",array('archive'=>$archive,'content'=>$archive_data,'cssPath'=>$cssPath,'jsPath'=>$jsPath));

	  
   
  } 
}
?>
