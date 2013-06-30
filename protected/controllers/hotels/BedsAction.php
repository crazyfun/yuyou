<?php
class BedsAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_ajax_page();
        return true;
    }
   protected function do_action(){
			$hotels_id=$_REQUEST['hotels_id'];
			$start_date=$_REQUEST['start_date'];
			$end_date=$_REQUEST['end_date'];
			$hotels_beds=HotelsBeds::model();
   	  $hotels_beds_datas=$hotels_beds->get_all_beds($hotels_id);
			$result=$this->display("/hotels/beds",array('hotels_beds_datas'=>$hotels_beds_datas,'start_date'=>$start_date,'end_date'=>$end_date),true);
			echo $result;
    
   }

}
?>