<?php
class Wcsearch extends CWidget
{
	  public $channel_id="";
	  public $view="";
    public function run(){
       $this->render("/wcsearch/".$this->view,array('channel_id'=>$channel_id));
    }
}
