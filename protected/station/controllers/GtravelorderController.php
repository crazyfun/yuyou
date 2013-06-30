<?php
class GtravelorderController extends AController
{
	public function filters() {
		return array(
		  'accessControl', // perform access control for CRUD operations
		);
	}

	public function actions()
	{
		$controller_path="application.station.controllers.gtravelorder.";
		return array(
		  'index'=>$controller_path.'IndexAction',
		  'view'=>$controller_path.'ViewAction',
		  'status'=>$controller_path.'StatusAction',
		  'pay'=>$controller_path.'PayAction',
		  'setuser'=>$controller_path.'SetuserAction',
		  'reserved'=>$controller_path.'ReservedAction',
		  'print'=>$controller_path.'PrintAction',
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
