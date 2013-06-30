<?php
class Whelpcontent extends CWidget
{
	  public $view="";
	  public $cid="";
    public function run(){
    	
    	 $information=Information::model();
    	 $information_datas=$information->get_whelp_information($this->cid);
       $this->render("/whelpcontent/".$this->view,array('model'=>$information,'information_datas'=>$information_datas));
    }
}
