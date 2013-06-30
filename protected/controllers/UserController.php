<?php
class UserController extends Controller
{
	public $breadcrumbs=array();
	public $user_tag="";
  public function filters() {
		return array(
			'LoginFilter-notifyurl',
		);
	}
	public function FilterLoginFilter($filterChain) {
		if(Yii::app()->user->isGuest){
			$this->redirect($this->createUrl("login/index"));
	  }
		$filterChain->run();
	}
 public function actions(){
 	  $controller_path="application.controllers.user.";
		return array(
		  'index'=>$controller_path."IndexAction",
		  'editprofile'=>$controller_path."EditprofileAction",
		  'editemail'=>$controller_path."EditemailAction",
		  'editpassword'=>$controller_path."EditpasswordAction",
		  'editpaypassword'=>$controller_path."EditpaypasswordAction",
		  'coupon'=>$controller_path.'CouponAction',
		  'message'=>$controller_path.'MessageAction',
		  'messageshow'=>$controller_path.'MessageshowAction',
		  'returnurl'=>$controller_path.'ReturnurlAction',
		  'notifyurl'=>$controller_path.'NotifyurlAction',
		  'pay'=>$controller_path.'PayAction',
		  'pay2'=>$controller_path.'Pay2Action',
		  'scheduler'=>$controller_path.'SchedulerAction',
		  'contacter'=>$controller_path.'ContacterAction',
		  'editcontacter'=>$controller_path.'EditcontacterAction',
		  'deletecontacter'=>$controller_path.'DeletecontacterAction',
		  'paytip'=>$controller_path.'PaytipAction',
		  'travelorder'=>$controller_path.'TravelorderAction',
		  'travelorderstatus'=>$controller_path.'TravelorderstatusAction',
		  'travelorderview'=>$controller_path.'TravelorderviewAction',
		  'travelorderserial'=>$controller_path.'TravelorderserialAction',
		  'travelfavorite'=>$controller_path.'TravelfavoriteAction',
		  'deletetravelfavorite'=>$controller_path.'DeletetravelfavoriteAction',
		  
		  
		  
		  
		  'grouporder'=>$controller_path.'GrouporderAction',
		  'grouporderstatus'=>$controller_path.'GrouporderstatusAction',
		  'grouporderserial'=>$controller_path.'GrouporderserialAction',
		  'grouporderview'=>$controller_path.'GrouporderviewAction',
		  'groupfavorite'=>$controller_path.'GroupfavoriteAction',
		  'deletegroupfavorite'=>$controller_path.'DeletegroupfavoriteAction',
		  
		  
		  'hotelsorder'=>$controller_path.'HotelsorderAction',
		  'hotelsorderstatus'=>$controller_path.'HotelsorderstatusAction',
		  'hotelsorderview'=>$controller_path.'HotelsorderviewAction',
		  'hotelsorderserial'=>$controller_path.'HotelsorderserialAction',
		  'hotelsfavorite'=>$controller_path.'HotelsfavoriteAction',
		  'deletehotelsfavorite'=>$controller_path.'DeletehotelsfavoriteAction',
		  
		  
		  
		);
	}
	
	public function f($msg_code){ 
     if($msg_code == CV::SUCCESS){
       $this->set_flash("操作成功",$msg_code);
     }
     if($msg_code == CV::FAIL){
     	 $this->set_flash("操作失败",$msg_code);
     }
     if($msg_code == CV::REFRASH){
     	$this->set_flash("请勿刷新页面",CV::FAIL);
    }
      if($msg_code == CV::PAYVALIDATE){
     	 $this->set_flash("您支付的数据错了，请重新支付或联系我们。",CV::FAIL);
     }
     
     if($msg_code == CV::PAYSUCCESS){
     	 $this->set_flash("充值成功",CV::FAIL);
     }
     
     if($msg_code == CV::PAYFAILED){
     	 $this->set_flash("充值失败",CV::FAIL);
     }
     
     
     
   }
}
