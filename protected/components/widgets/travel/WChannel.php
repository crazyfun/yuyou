<?php
class WChannel extends CWidget
{
	  public $pattern="";
    public $view="";
    public $ids="";
    public $parent="";
    public $show="";
    public $select="";
    public function run(){
    	 $channel=$_REQUEST['channel'];
    	  //初始化页面需要的全局变量
   	   $cssPath=$this->controller->get_css_path();
       $jsPath=$this->controller->get_js_path(); 
       $channels=Channels::model();
       $content=$channels->get_channel_menus($this->parent,$this->show,$this->ids,$this->pattern);
       $this->render("/channel/".$this->view,array('content'=>$content,'channel'=>$channel,'select'=>$this->select,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
    }    
   
}
