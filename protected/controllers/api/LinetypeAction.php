<?php
class LinetypeAction extends  BaseAction{
    public function beforeAction(){
    	  if(Yii::app()->request->isAjaxRequest){
    		  Util::reset_vars();
          return true;
        }else{
        	return false;
        }
    }
    protected function do_action(){
	    $travel_category=TravelCategory::model();
	    $parent=$_REQUEST['parent'];
	    if(empty($parent)){
	    	$parent=0;
	    }
	    $travel_category_datas=$travel_category->get_options($parent);
	    $result_array=array();
	    foreach($travel_category_datas as $key => $value){
	    	$tem['id']=$key;
	    	$tem['name']=$value;
	    	$result_array[]=$tem;
	    }
   		$result=Util::combo_ajax_message('1',$result_array,"");
   		echo $result;
  } 
}
?>
