<?php
class SearchscenicAction extends  BaseAction{
    public function beforeAction(){
    	  if(Yii::app()->request->isAjaxRequest){
    		  Util::reset_vars();
          return true;
        }else{
        	return false;
        }
    }
    protected function do_action(){
	    $travel_area=TravelArea::model();
	    $area_datas=$travel_area->get_seach_travel_areas(100);
   		$result=Util::combo_ajax_message('1',$area_datas,"");
   		echo $result;
  } 
}
?>
