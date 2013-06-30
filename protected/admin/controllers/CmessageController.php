<?php
class CmessageController extends AController
{
	public function filters() {
		return array(
		  'accessControl', // perform access control for CRUD operations
		);
	}

	public function actions()
	{
		$controller_path="application.admin.controllers.cmessage.";
		return array(
		  'index'=>$controller_path.'IndexAction',
		  'reply'=>$controller_path.'ReplyAction',
		  'delete'=>$controller_path.'DeleteAction',
		  'status'=>$controller_path.'StatusAction',
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
