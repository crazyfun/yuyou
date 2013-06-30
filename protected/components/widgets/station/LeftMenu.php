<?php
class LeftMenu extends CWidget
{
	public $views='';
	public function run(){
  	$permissions=new Permissions();
  	$user_permissions_value=$permissions->get_user_permissions_value();
		$user_permissions=implode(",",$user_permissions_value);
    $menus=$this->get_top_menus($user_permissions);
    $json_menus=array();
    foreach($menus as $key => $value){
    	$tem_json_menus=array();
    	$tem_json_menus['id']=$key;
    	$tem_json_menus['name']=$value['name'];
    	$tem_json_menus['subitem']=array();
    	$subitem=$value['subitem'];
    	if(!empty($subitem)){
    	foreach($subitem as $key1 => $value1){
    		$tem_subitem=array();
    		$tem_subitem['id']=$value1['id'];
    		$tem_subitem['name']=$value1['name'];
    		$tem_subitem['url']=Yii::app()->getController()->createUrl($value1['menu_controller']."/".$value1['menu_action'],array());
    		array_push($tem_json_menus['subitem'],$tem_subitem);
    	}
     }
     array_push($json_menus,$tem_json_menus);
    }
    $menu_json=json_encode($json_menus);
  	$this->render($this->views,array('menus'=>$menus,'menu_json'=>$menu_json));
	}
  public function get_top_menus($user_permissions){
			$backend_menu=BackendMenu::model();
		  $permissions=$user_permissions;
		  $permissions_datas=$backend_menu->with(array("BackendMenu"=>array('condition'=>'BackendMenu.is_show=:is_show','param'=>array(':is_show'=>'1'))))->findAll(array('select'=>'t.id,t.menu_parent,t.menu_name,t.menu_alias,t.menu_controller,t.menu_action','condition'=>"FIND_IN_SET(t.id,:permissions)>0 AND t.is_show=:is_show",'params'=>array(':permissions'=>$permissions,':is_show'=>'1'),'order'=>'t.menu_parent ASC,t.menu_sort ASC'));
		  $user_permissions=array();
		  foreach($permissions_datas as $key => $value){
		  	$parent_menu_name=$value->BackendMenu->menu_name;
		  	$menu_name=$value->menu_name;
		  	if(empty($user_permissions[$value->BackendMenu->id]))
		  		$user_permissions[$value->BackendMenu->id]=array('id'=>$value->BackendMenu->id,'name'=>$parent_menu_name,'subitem'=>array());
		  	$menu_data=array('id'=>$value->id,'name'=>$menu_name,'menu_controller'=>$value->menu_controller,'menu_action'=>$value->menu_action);
		  	$user_permissions[$value->BackendMenu->id]['subitem'][]=$menu_data;
	   }
	   return $user_permissions;
  }
	
	
}
?>