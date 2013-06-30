<?php
class Wtsearch extends CWidget
{
	  public $view="";
    public function run(){
     
       $this->render("/wtsearch/".$this->view,array());
    }
}
