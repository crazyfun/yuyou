<?php
class RegionAction extends  BaseAction{
    public function beforeAction(){
    	  if(Yii::app()->request->isAjaxRequest){
    		  Util::reset_vars();
          return true;
        }else{
        	return false;
        }
    }
    protected function do_action(){
	    $region=Region::model();
	    $parent=$_REQUEST['parent'];
	    if(empty($parent)){
	    	$parent=0;
	    }
	    $region_datas=$region->get_options($parent);
	    $result_array=array();
	    foreach($region_datas as $key => $value){
	    	$tem['id']=$key;
	    	$tem['name']=$value;
	    	$result_array[]=$tem;
	    }
   		$result=Util::combo_ajax_message('1',$result_array,"");
   		echo $result;
  } 
}
?>
