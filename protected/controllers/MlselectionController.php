<?php
class MlselectionController extends Controller
{
	public $tag="";
  public function filters() {
		return array(
			//'LoginFilter',
		);
	}
	
 public function actions(){
 	  $controller_path="application.controllers.mlselection.";
		return array(
		  'index'=>$controller_path."IndexAction",
		);
	}
	
	public function f($msg_code){ 
     if($msg_code == CV::SUCCESS){
       $this->set_flash("修改成功",$msg_code);
     }
     if($msg_code == CV::FAIL){
     	 $this->set_flash("修改失败",$msg_code);
     }
     
   }
}
