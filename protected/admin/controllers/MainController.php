<?php
class MainController extends AController
{
	public function actions()
	{
		$base_path="application.admin.controllers.main";
		return array(
		 'message'=>$base_path.'.MessageAction',
		 'delete'=>$base_path.'.DeleteAction',
		 'permissiond'=>$base_path.'.PermissiondAction',
		 'crop'=>$base_path.".CropAction",
		 'filltree'=>$base_path.".FilltreeAction",
		 'channelcategory'=>$base_path.".ChannelcategoryAction",
		 'searchuser'=>$base_path.".SearchuserAction",
		 'suppliers'=>$base_path.".SuppliersAction",
		 'region'=>$base_path.".RegionAction",
		 'travelcategory'=>$base_path.".TravelcategoryAction",
		 'hotels'=>$base_path.".HotelsAction",
		 'routearea'=>$base_path.".RouteareaAction",
		 'company'=>$base_path.".CompanyAction",
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
