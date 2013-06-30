<?php
class Whotelssearch extends CWidget
{
	  public $view="";
	  public $attr="";
    public function run(){
    	 $hotels=Hotels::model();
    	 $region_datas=$hotels->get_end_region("-1",$this->attr);
       $this->render("/whotelssearch/".$this->view,array('region_datas'=>$region_datas));
    }
}
