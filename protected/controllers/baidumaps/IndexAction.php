<?php
class IndexAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_baidumaps_page();
        return true;
    }
   protected function do_action(){
   	  $address=$_REQUEST['address'];
   	  $ip_convert=IpConvert::get();
   	  $region_address=$ip_convert->init_region();
   	  $region_name=$region_address['name'];
   	  if(empty($address)){
   	  	$address=$region_name;
   	  }
			$this->display("index",array('address'=>$address,'region_name'=>$region_name));
  }

}
?>