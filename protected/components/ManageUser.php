<?php

class ManageUser{
 private static $static_class=null;
 public static function get()
 {
   if (self::$static_class == null){
      self::$static_class =  new ManageUser();
   }
    return self::$static_class;
  }
  public  function __construct()
  {
    
  }
  
  public function get_menus(){
  	$menus=array(
  	'default'=>array('name'=>'用户中心','class'=>'user_default','url'=>'','menus'=>array(
  	  
  	  'index'=>array(
  	   'name'=>'个人资料',
  	   'url'=>'user/index',
  	   'class'=>'user_index',
  	  ),
 
  	  'editprofile'=>array(
  	    'name'=>'修改资料',
  	    'url'=>'user/editprofile',
  	    'class'=>'user_editprofile',
  	  ),
  	  'editemail'=>array(
  	  	'name'=>'修改邮箱',
  	  	'url'=>'user/editemail',
  	  	'class'=>'user_editemail'
  	  ),
  	  'editpassword'=>array(
  	    'name'=>'修改密码',
  	    'url'=>'user/editpassword',
  	    'class'=>'user_editpassword'
  	  ),
  	  
  	  'editpaypassword'=>array(
  	    'name'=>'修改支付密码',
  	    'url'=>'user/editpaypassword',
  	    'class'=>'user_editpaypassword'
  	  ),
  	  
  	 'coupon'=>array(
  	    'name'=>'积分明细',
  	    'url'=>'user/coupon',
  	    'class'=>'user_coupon'
  	  ),
  	  'scheduler'=>array(
  	    'name'=>'我的行程',
  	    'url'=>'user/scheduler',
  	    'class'=>'user_scheduler'
  	  ),
  	  'message'=>array(
  	    'name'=>'站内消息',
  	    'url'=>'user/message',
  	    'class'=>'user_message'
  	  ),
  	  
  	  'contacter'=>array(
  	    'name'=>'常用联系人',
  	    'url'=>'user/contacter',
  	    'class'=>'user_contacter'
  	  ),
  	  
  	  
  	  
  	  
  	 
  	  

  	)),
  	
  	
  'travel'=>array('name'=>'我的线路','class'=>'user_travel','url'=>'','menus'=>array(
  	'travelorder'=>array(
  	   'name'=>'线路订单',
  	   'url'=>'user/travelorder',
  	   'class'=>'user_travelorder',
  	  ),
  	  
  	  'travelfavorite'=>array(
  	   'name'=>'线路收藏',
  	   'url'=>'user/travelfavorite',
  	   'class'=>'user_travelfavorite',
  	  ),
  	 
  	)),
  	'hotels'=>array('name'=>'我的酒店','class'=>'user_hotels','url'=>'','menus'=>array(
  	'hotelsorder'=>array(
  	   'name'=>'酒店订单',
  	   'url'=>'user/hotelsorder',
  	   'class'=>'user_hotelsorder',
  	  ),
  	'hotelsfavorite'=>array(
  	   'name'=>'酒店收藏',
  	   'url'=>'user/hotelsfavorite',
  	   'class'=>'user_hotelsfavorite',
  	  ),
  	 
  	 
  	)),
  	
  	'group'=>array('name'=>'我的团购','class'=>'user_group','url'=>'','menus'=>array(
  	'grouporder'=>array(
  	   'name'=>'团购订单',
  	   'url'=>'user/grouporder',
  	   'class'=>'user_grouporder',
  	  ),
  	  
  	  'groupfavorite'=>array(
  	   'name'=>'团购收藏',
  	   'url'=>'user/groupfavorite',
  	   'class'=>'user_groupfavorite',
  	  ),
  	  
  	 
  	 
  	)),
  	
  	

  	
  	
  	
  	);
  	return $menus;
  }
  
  public function get_user_menus($user_id=""){
  	$user_id=empty($user_id)?Yii::app()->user->id:$user_id;
  	$user_type=UserType::model();
  	$type=$user_type->get_user_type($user_id);
  	$menus=$this->get_menus();
  	$return_menus=array();
  	switch($type){
  		case '1':
  		    $return_menus['default']=$menus['default'];
  		    $return_menus['travel']=$menus['travel'];
  		    $return_menus['hotels']=$menus['hotels'];
  		    $return_menus['group']=$menus['group'];
  				break;
  		default:
  		    break;
  	}
  	return $return_menus;
  }

}
?>
