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
      $query=$_REQUEST['query'];
   		$region=new Region();
   		$region_datas=$region->findAll(array('condition'=>"t.region_name LIKE '%$query%'",'params'=>array()));
   		$suggestions=array();
   		$datas=array();
   		foreach($region_datas as $key => $value){
   			$parent_id=$value->parent_id;
   			$parent_data=$region->find('t.region_id=:parent_id',array(':parent_id'=>$parent_id));
   			$region_name=$value->region_name."(".$parent_data->region_name.")";
   			array_push($suggestions,$region_name);
   			$tem_array=array();
   			$tem_array['id']=$value->region_id;
   			$tem_array['name']=$value->region_name;
   			array_push($datas,$tem_array);
   		}
   		$ajax_array=array('query'=>$query,'suggestions'=>$suggestions,'data'=>$datas);
   		echo json_encode($ajax_array);
    } 
}
?>
