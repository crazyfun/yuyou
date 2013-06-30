<?php
class SiteController extends Controller
{
	public $breadcrumbs=array();
  public function filters() {
		return array(

		);
	}

 public function actions(){
 	  $controller_path="application.controllers.site.";
		return array(
		  'index'=>$controller_path."IndexAction",
		  'forgotpassword'=>$controller_path."ForgotpasswordAction",
		  'validatepassword'=>$controller_path."ValidatepasswordAction",
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
