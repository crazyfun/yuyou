<?php
class Flink extends CWidget
{
	  public $type="";
    public $view=""; 
    public $limit="";
    public function run(){
    	  //初始化页面需要的全局变量
   	   $cssPath=$this->controller->get_css_path();
       $jsPath=$this->controller->get_js_path(); 
       $friend_link=Friendlink::model();
       $friend_link_type=FriendlinkType::model();
       $condition=array();
       $params=array();
       $attributes=array();
       if(!empty($this->type)){
         $condition[]="t.id=:friendlink_type";
         $params[':friendlink_type']=$this->type;
       }
       $friend_link_type_datas=$friend_link_type->findAll($condition,$params);
       foreach($friend_link_type_datas as $key => $value){
       	$search_condition=array('condition'=>'t.friendlink_type=:friendlink_type','params'=>array(':friendlink_type'=>$value->id),'order'=>'t.friendlink_sort ASC');
       	if($limit!=-1){
				  $search_condition['limit']=$this->limit;
			  }
       	$friend_link_datas=$friend_link->findAll($search_condition);
       	$type_attributes=$value->attributes;
       	$link_attributes=array();
       	foreach($friend_link_datas as $key1 => $value1){
			    $link_attributes[]=$value1->attributes;
		    }
       	foreach($link_attributes as $key1 => $value1){
       		$value1['friendlink_img']="/".Util::rename_thumb_file('15','15',"",$value1['friendlink_img']);
       		$link_attributes[$key1]=$value1;
       	}
       	
       	$type_attributes['friendlink']=$link_attributes;
       	$attributes[]=$type_attributes;
       }
       $this->render("/flink/".$this->view,array('content'=>$attributes,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
    }    
}
