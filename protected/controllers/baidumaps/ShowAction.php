<?php
class ShowAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_baidumaps_page();
        return true;
    }
   protected function do_action(){
   	  $address=$_REQUEST['address'];
   	  $is_edit=$_REQUEST['is_edit'];
   	  $address_explode=explode(",",$address);
   	  $lng=$address_explode[0];
   	  $lat=$address_explode[1];
			$this->display("show",array('is_edit'=>$is_edit,'lng'=>$lng,'lat'=>$lat));
  }

}
?>