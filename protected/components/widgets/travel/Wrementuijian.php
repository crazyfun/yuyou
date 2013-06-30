<?php
class Wrementuijian extends CWidget
{
	  public $channel_id="";
	  public $view="";
    public function run(){
    	 $travel=Travel::model();
    	 $remai_travel_datas=$travel->get_travel_datas($this->channel_id,"","f");
    	 $tuijian_travel_datas=$travel->get_travel_datas($this->channel_id,"","c");
       $this->render("/wrementuijian/".$this->view,array("remai_travel_datas"=>$remai_travel_datas,"tuijian_travel_datas"=>$tuijian_travel_datas));
    }
}
