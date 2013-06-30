<?php
class HotelsController extends Controller
{
	public $breadcrumbs=array();
  public function filters() {
		return array(

		);
	}

 public function actions(){
 	  $controller_path="application.controllers.hotels.";
		return array(
		  'index'=>$controller_path."IndexAction",
		  'list'=>$controller_path.'ListAction',
		  'show'=>$controller_path.'ShowAction',
		  'beds'=>$controller_path.'BedsAction',
		);
	}
	
		public function f($msg_code){ 
     if($msg_code == CV::SUCCESS){
       $this->set_flash("操作成功",$msg_code);
     }
     if($msg_code == CV::MESSAGE_SUCCESS){
       $this->set_flash("留言成功，请等待处理",CV::SUCCESS);
    }
     if($msg_code == CV::FAIL){
     	 $this->set_flash("操作失败",$msg_code);
     }
     
   }
}
