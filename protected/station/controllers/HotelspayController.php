<?php
class HotelspayController extends AController
{

  public function filters(){
		return array(
		  'accessControl', // perform access control for CRUD operations
		);
	}

 public function actions(){
 	  $controller_path="application.station.controllers.hotelspay.";
		return array(
		  'step1'=>$controller_path."Step1Action",
		  'step2'=>$controller_path."Step2Action",
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
