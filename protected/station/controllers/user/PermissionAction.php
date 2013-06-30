<?php
class PermissionAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
    $user_id=$_REQUEST['user_id'];
    $user=new User();
    $permission=new Permissions();
    if(isset($_POST['button_ok'])){
    	$permission_value=$_POST['permission_value'];
    	if(!empty($permission_value)){
    	   $permission_value=implode(",",$permission_value);
    	}
    	$user->update_table_datas($user_id,array('permissions'=>$permission_value,'admin_status'=>'2'),array());
    	$permission->set_user_permissions($user_id,$_POST['permission_value']);
    	$this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
    }
    $user_permission=$user->get_user_permissions($user_id);
    $permission_datas=$permission->get_user_setpermissions(Yii::app()->user->id);
    $select_permission=explode(",",$user_permission);
    
		$this->display('permission',array('user_id'=>$user_id,'select_permission'=>$select_permission,'permission_datas'=>$permission_datas));
  } 
}
?>
