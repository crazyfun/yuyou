<?php
class BaidumapsController extends Controller
{
	public $tag="baidumaps";
	public $breadcrumbs=array();
  public function filters() {
		return array(
			//'LoginFilter',
		);
	}
	
 public function actions(){
 	  $controller_path="application.controllers.baidumaps.";
		return array(
		  'index'=>$controller_path."IndexAction",
		  'show'=>$controller_path."ShowAction",
		);
	}
	
	public function f($msg_code){ 
     if($msg_code == CV::SUCCESS){
       $this->set_flash("操作成功",$msg_code);
     }
     if($msg_code == CV::FAIL){
     	 $this->set_flash("操作失败",$msg_code);
     }
     
   }
}
