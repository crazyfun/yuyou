<?php
class Wtejiatravel extends CWidget
{
	  public $view="";
    public function run(){
       $this->render("/wtejiatravel/".$this->view,array());
    }
}
