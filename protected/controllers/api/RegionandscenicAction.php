<?php
class RegionandscenicAction extends  BaseAction{
    public function beforeAction(){
    	  if(Yii::app()->request->isAjaxRequest){
    		  Util::reset_vars();
          return true;
        }else{
        	return false;
        }
    }
    protected function do_action(){
	    $query=$_REQUEST['query'];
   		$region=Region::model();
   		$region_datas=$region->findAll(array('select'=>'t.region_id,t.region_name','condition'=>"((t.region_name LIKE :keyword) OR (t.english_name LIKE :keyword))",'params'=>array(':keyword'=>"%".$query."%"),'order'=>'t.region_id ASC','limit'=>'10'));
   		$suggestions=array();
   		$datas=array();
   		foreach($region_datas as $key => $value){
   			$level=$region->get_region_level($value->region_id);
   			if($level>=3){
   			array_push($suggestions,$value->region_name);
   			$tem_array=array();
   			$tem_array['id']=$value->region_id;
   			$tem_array['name']=$value->region_name;
   			$tem_array['type']='region';
   			array_push($datas,$tem_array);
   		 }
   		}
   		
   	$travel_area=TravelArea::model();
   	$search_condition=array('select'=>'distinct(t.travel_area) as travel_area,COUNT(t.travel_area) as count_travel_area','condition'=>'Travel.status=:status AND t.travel_area LIKE :travel_area','params'=>array(':status'=>'2',':travel_area'=>"%".$query."%"),'order'=>'count_travel_area DESC','group'=>'t.travel_area','together'=>true);
		$area_datas=$travel_area->with("Travel")->findAll($search_condition);
		foreach($area_datas as $key => $value){
   			array_push($suggestions,$value->travel_area);
   			$tem_array=array();
   			$tem_array['id']=$value->id;
   			$tem_array['name']=$value->travel_area;
   			$tem_array['type']='scenic';
   			array_push($datas,$tem_array);
   	}
   		$ajax_array=array('query'=>$query,'suggestions'=>$suggestions,'data'=>$datas);
   		echo json_encode($ajax_array);
  } 
}
?>
