<?php
class RouteareaAction extends  BaseAction{
    public function beforeAction(){
    	  if(Yii::app()->request->isAjaxRequest){
    		  Util::reset_vars();
          return true;
        }else{
        	return false;
        }
    }
   protected function do_action(){
    	
    $travel_area=$_REQUEST['travel_area'];
		$travel_id=$_REQUEST['travel_id'];
		$travel_route=$_REQUEST['travel_route'];
		$travel_area_obj=new TravelArea();
		$travel_area_obj->travel_id=$travel_id;
		$travel_area_obj->travel_area=$travel_area;
		if($travel_area_obj->validate()){
			  $result=$travel_area_obj->insert_datas();
			  if($result){
			  	$travel_area_select=$travel_area_obj->get_select($travel_id);
			  	$travel_route_select=explode(",",$travel_route);
			  	$result_str=EHtml::createMulti("travel_route",$travel_route_select,$travel_area_select,array('multiple'=>true,'size'=>'5'));
			  	echo Util::combo_ajax_message('1',array('datas'=>$result_str),"");
			  }else{
			  	echo Util::combo_ajax_message('2',array(),"增加景区失败");
			  }
		}else{
			echo Util::combo_ajax_message('2',array(),"增加景区失败");
		}
		
   } 
}
?>
