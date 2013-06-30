<?php
class SearchregionAction extends  BaseAction{
    public function beforeAction(){
    	  if(Yii::app()->request->isAjaxRequest){
    		  Util::reset_vars();
          return true;
        }else{
        	return false;
        }
    }
    protected function do_action(){
	    $travel=Travel::model();
	    $end_region=$travel->get_search_end_region(-1);
   		$result=Util::combo_ajax_message('1',$end_region,"");
   		echo $result;
  } 
}
?>
