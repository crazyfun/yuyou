<?php
class Whelpshow extends CWidget
{
	  public $cids="";
	  public $view="";
    public function run(){
    	 $information=Information::model();
    	 $category=InformationCategory::model();
    	 $cids=explode(",",$this->cids);
    	 $return_array=array();
    	 foreach($cids as $key => $value){
    	 	$tem_array=array();
    	 	$category_data=$category->findByPk($value);
				$tem_array['id']=$category_data->id;
				$tem_array['name']=$category_data->name;
				$tem_array['parent_id']=$category_data->parent_id;
				$tem_array['sub_items']=array();
				$information_datas=$information->get_whelp_information($value);
				foreach($information_datas as $key1 => $value1){
					$tem_information=array();
					$tem_information['id']=$value1->id;
					$tem_information['name']=$value1->title;
					$tem_information['type_id']=$value1->type_id;
					$tem_array['sub_items'][]=$tem_information;
				}
				$return_array[]=$tem_array;
    	 	
    	 }

       $this->render("/whelpshow/".$this->view,array('model'=>$information,'information_datas'=>$return_array));
    }
}
