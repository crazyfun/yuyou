<?php
class TravelcategoryAction extends  BaseAction{
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
   		$travel_categroy=new TravelCategory();
   		$travel_categroy_datas=$travel_categroy->findAll(array('condition'=>"category_name LIKE '%$query%'",'params'=>array()));
   		$suggestions=array();
   		$datas=array();
   		foreach($travel_categroy_datas as $key => $value){
   			$parent_id=$value->parent_id;
   			$parent_data=$travel_categroy->find('t.category_id=:parent_id',array(':parent_id'=>$parent_id));
   			$category_name=$value->category_name."(".$parent_data->category_name.")";
   			array_push($suggestions,$category_name);
   			$tem_array=array();
   			$tem_array['id']=$value->category_id;
   			$tem_array['name']=$value->category_name;
   			array_push($datas,$tem_array);
   		}
   		$ajax_array=array('query'=>$query,'suggestions'=>$suggestions,'data'=>$datas);
   		echo json_encode($ajax_array);
    } 
}
?>
