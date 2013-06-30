<?php
class TravelpayController extends AController
{
	public function filters() {
		return array(
		  'accessControl', // perform access control for CRUD operations
		);
	}

	public function actions()
	{
		$controller_path="application.station.controllers.travelpay.";
		return array(
      'step1'=>$controller_path."Step1Action",
		  'step2'=>$controller_path."Step2Action",
		  'step3'=>$controller_path."Step3Action",
		  'step4'=>$controller_path."Step4Action",

		);
	}
	 public function f($msg_code){ 
	 	
     if($msg_code == CV::SUCCESS_ADMIN_OPERATE){
       $this->sf("操作成功");
     }
     if($msg_code == CV::FAILED_ADMIN_OPERATE){
     	 $this->ff("操作失败");
     }
     if($msg_code == CV::ERROR_ADMIN_DATABASE){
     	 $this->ff("操作数据库错误");
     }
    }
}
