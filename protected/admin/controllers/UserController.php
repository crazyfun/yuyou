<?php
class UserController extends AController
{

  public function filters() {
		return array(
		  'accessControl', // perform access control for CRUD operations
		);
	}
	public function actions(){
		$controller_path="application.admin.controllers.user.";
		return array(
		  'index'=>$controller_path.'IndexAction',
		  'add'=>$controller_path.'AddAction',
		  'edit'=>$controller_path.'EditAction',
		  'permission'=>$controller_path."PermissionAction",
		  'delete'=>$controller_path.'DeleteAction',
		  'editpassword'=>$controller_path.'EditpasswordAction',
		  'editpaypassword'=>$controller_path.'EditpaypasswordAction',
		  'editconpon'=>$controller_path.'EditconponAction',
		  'status'=>$controller_path.'StatusAction',
		  'setregion'=>$controller_path.'SetregionAction',
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
