<?php
class Wwebmap extends CWidget
{
	  public $view="";
    public function run(){
    	 $channels=Channels::model();
    	 $menus=$channels->get_channel_menus("0","1");
    	 foreach($menus as $key => $value){
    	 	  $menus[$key]=$value;
    	 }
       $this->render("/wwebmap/".$this->view,array('content'=>$menus));
    }
}
