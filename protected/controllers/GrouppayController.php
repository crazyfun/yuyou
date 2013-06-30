<?php
class GrouppayController extends Controller
{
	public $breadcrumbs=array();
  public function filters() {
		return array(

		);
	}

 public function actions(){
 	  $controller_path="application.controllers.grouppay.";
		return array(
		  'step1'=>$controller_path."Step1Action",
		  'step2'=>$controller_path."Step2Action",
		  'step3'=>$controller_path.'Step3Action',
		  'returnurl'=>$controller_path."ReturnurlAction",
		  'notifyurl'=>$controller_path."NotifyurlAction",
		  'paytip'=>$controller_path.'PaytipAction',
		);
	}
	
		public function f($msg_code){ 
     if($msg_code == CV::SUCCESS){
       $this->set_flash("操作成功",$msg_code);
     }
     if($msg_code == CV::FAIL){
     	 $this->set_flash("操作失败",$msg_code);
     }
     if($msg_code == CV::PAYSUCCESS){
     	 $this->set_flash("购买成功",CV::FAIL);
     }
     
     if($msg_code == CV::PAYFAILED){
     	 $this->set_flash("购买失败",CV::FAIL);
     }
    
   }
}
