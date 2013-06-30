<?php
class NewestOrder extends CWidget
{
	  public $region_id="";
	  public $view="";
	  public $type="";
	  public $limit="";
    public function run(){
    	 $condition=array('(t.status=6 OR t.status=7)','Travel.start_region=:region_id AND t.pay_status=:pay_status');
    	 $params=array(':region_id'=>$this->region_id,':pay_status'=>'2');
    	 if(empty($this->type)){
    	 	  $type="travel";
    	 }
    	 if(empty($this->limit)){
    	   $this->limit=10;	
    	 }
    	 switch($this->type){
    	 	 case 'travel':
    	 	   $travel_order=TravelOrder::model();
    	 	   $contents=$travel_order->with("Travel","User")->findAll(array('condition'=>implode(" AND ",$condition),'params'=>$params,'limit'=>$this->limit,'together'=>true,'order'=>'t.create_time DESC'));
    	 	   break;
    	 	 default:
    	 	   break;
    	 }
       $this->render("/newestorder/".$this->view,array('contents'=>$contents));
    }
}
