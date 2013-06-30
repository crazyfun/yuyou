<?php
class WebConfig {
	
	
	public static $breadcrumbs=array(
	   ''=>array(
	  	 'site'=>array(
	      	'index'=>array('首页'),
	      	'forgotpassword'=>array('找回密码'),
	      	'validatepassword'=>array('找回密码'),
	   	 ),
	   	 'mchannels'=>array(
	         'index'=>array(''),
	         'list'=>array(''),
	         'show'=>array(''),
	         'information'=>array(''),
	      
	     ),
	     
	      'group'=>array(
	         'index'=>array(''),
	         'list'=>array(''),
	         'show'=>array(''),
	      
	     ),
	     
	      'hotels'=>array(
	         'index'=>array(''),
	         'list'=>array(''),
	         'show'=>array(''),
	         'beds'=>array(''),
	      
	     ),
	     
	     	'travel'=>array(
	         'index'=>array(''),
	         'list'=>array(''),
	         'show'=>array(''),
	         'date'=>array(''),
	      
	     	),
	     
	      'grouppay'=>array(
	         'step1'=>array('团购付款第一步'),
	         'step2'=>array('团购付款第二步'),
	         'step3'=>array('团购付款第三步'),
	         'notifyurl'=>array('团购付款通知'),
	         'returnurl'=>array('团购付款跳转页面'),
	         'paytip'=>array('团购付款提示页面'),
	         
	      
	     ),
	     
	      'hotelspay'=>array(
	         'step1'=>array('酒店付款第一步'),
	         'step2'=>array('酒店付款第二步'),
	         'step3'=>array('酒店付款第三步'),
	         'notifyurl'=>array('酒店付款通知'),
	         'returnurl'=>array('酒店付款跳转页面'),
	         'paytip'=>array('酒店付款提示页面'),
	         
	      
	     ),
	     
	     
	      'pay'=>array(
	         'step1'=>array('线路付款第一步'),
	         'step2'=>array('线路付款第二步'),
	         'step3'=>array('线路付款第三步'),
	         'step4'=>array('线路付款第四步'),
	         'step5'=>array('线路付款第五步'),
	         'notifyurl'=>array('线路付款通知'),
	         'returnurl'=>array('线路付款跳转页面'),
	         'paytip'=>array('线路付款提示页面'),
	         'agreement'=>array('线路预定协议'),
	     ),
	     
	     
	     
	     'registe'=>array(
	     	  'index'=>array('注册会员'),
	     	  'registe2'=>array('注册会员第二步'),
	     	  'registe3'=>array('注册会员第三步'),
	     	  'company'=>array('商家注册'),
	     	  'agreement'=>'会员协议',
	     	  'companyagreement'=>'商家协议',
	     	),
	     	
	     	
	     	'search'=>array(
	     	  'index'=>array('产品搜索'),
	     	),
	     	
	     	'login'=>array(
	     	  'index'=>array('会员登录'),
	     	  'logout'=>array('会员退出'),
	     	),
	     	
	     	'error'=>array(
	     	  'error404'=>array('页面错误'),
	     	  
	     	),
	     	
	     	'help'=>array(
	     	  'index'=>array('帮助中心'),
	     	  
	     	),
	     	
	     'region'=>array(
	     	  'index'=>array('设置出发城市'),
	     	  'set'=>array('设置出发城市'),
	     	  
	     	),
	     	
	     	'user'=>array(
	     		 'index'=>array('用户中心'=>"user/index",'个人资料'),	
	     		 'editprofile'=>array('用户中心'=>"user/index",'修改资料'),
	     		 'editemail'=>array('用户中心'=>"user/index",'修改邮箱'),
	     		 'editpassword'=>array('用户中心'=>"user/index",'修改密码'),
	     		 'editpaypassword'=>array('用户中心'=>"user/index",'修改支付密码'),
	     		 'pay'=>array('用户中心'=>"user/index",'在线支付'),
	     		 'pay2'=>array('用户中心'=>"user/index",'在线支付'),
	     		 'returnurl'=>array('用户中心'=>"user/index",'支付状态'),
	     		 'coupon'=>array('用户中心'=>"user/index",'账户明细'),
           'contacter'=>array('用户中心'=>"user/index",'常用联系人'),
	     		 'editcontacter'=>array('用户中心'=>"user/index",'常用联系人'),
	     		 'message'=>array('用户中心'=>"user/index",'站内信'),
	     		 'messageshow'=>array('用户中心'=>"user/index",'站内信'),
	     		 'scheduler'=>array('用户中心'=>"user/index",'我的行程'),
	     		 'travelorder'=>array('用户中心'=>"user/index",'线路订单'),
	     		 'travelorderview'=>array('用户中心'=>"user/index",'查看线路订单'),
	     		 'travelfavorite'=>array('用户中心'=>"user/index",'线路收藏'),
	     		 'grouporder'=>array('用户中心'=>"user/index",'团购订单'),
	     		 'grouporderview'=>array('用户中心'=>"user/index",'查看团购订单'),
	     		 'groupfavorite'=>array('用户中心'=>"user/index",'团购收藏'),
	     		 'hotelsorder'=>array('用户中心'=>"user/index",'酒店订单'),
	     		 'hotelsorderview'=>array('用户中心'=>"user/index",'查看酒店订单'),
	     		 'hotelsfavorite'=>array('用户中心'=>"user/index",'酒店收藏'),
	     	),	
	   ),
	);
	public static $webseo=array(
	   ''=>array(
	     'site'=>array(
         'index'=>array(
            'title'=>'{$seo_title}',
            'keywords'=>'',
            'description'=>'',
         ),
         
         'forgotpassword'=>array(
            'title'=>'找回密码',
            'keywords'=>'',
            'description'=>'',
         ),
         
         'validatepassword'=>array(
            'title'=>'找回密码',
            'keywords'=>'',
            'description'=>'',
         ),
         
         
	     ),
	    
	    'mchannels'=>array(
	          'index'=>array(
	             'title'=>'{$seo_title}',
               'keywords'=>'{$seo_keywords}',
               'description'=>'{$seo_description}',
	          ),
	          
	          'list'=>array(
	             'title'=>'{$seo_title}',
               'keywords'=>'{$seo_keywords}',
               'description'=>'{$seo_description}',
	          ),
	          
	          'show'=>array(
	             'title'=>'{$seo_title}',
               'keywords'=>'{$seo_keywords}',
               'description'=>'{$seo_description}',
	          ),
	          
	           'information'=>array(
	             'title'=>'{$seo_title}',
               'keywords'=>'{$seo_keywords}',
               'description'=>'{$seo_description}',
	          ),
	      ),
	      
	      
	      'group'=>array(
	          'index'=>array(
	             'title'=>'{$seo_title}',
               'keywords'=>'{$seo_keywords}',
               'description'=>'{$seo_description}',
	          ),
	          
	          'list'=>array(
	             'title'=>'{$seo_title}',
               'keywords'=>'{$seo_keywords}',
               'description'=>'{$seo_description}',
	          ),
	          
	          'show'=>array(
	             'title'=>'{$seo_title}',
               'keywords'=>'{$seo_keywords}',
               'description'=>'{$seo_description}',
	          ),
	       ),   
	          
	        'hotels'=>array(
	          'index'=>array(
	             'title'=>'{$seo_title}',
               'keywords'=>'{$seo_keywords}',
               'description'=>'{$seo_description}',
	          ),
	          
	          'list'=>array(
	             'title'=>'{$seo_title}',
               'keywords'=>'{$seo_keywords}',
               'description'=>'{$seo_description}',
	          ),
	          
	          'show'=>array(
	             'title'=>'{$seo_title}',
               'keywords'=>'{$seo_keywords}',
               'description'=>'{$seo_description}',
	          ),
	          
	          
	     ),
	     
	     
	     'grouppay'=>array(
	         'step1'=>array(
	             'title'=>'团购付款第一步',
               'keywords'=>'',
               'description'=>'',),
	         'step2'=>array(
	             'title'=>'团购付款第二步',
               'keywords'=>'',
               'description'=>'',),
	         'step3'=>array(
	             'title'=>'团购付款第三步',
               'keywords'=>'',
               'description'=>'',),
	         'notifyurl'=>array(
	             'title'=>'团购付款通知',
               'keywords'=>'',
               'description'=>'',),
	         'returnurl'=>array(
	             'title'=>'团购付款跳转页面',
               'keywords'=>'',
               'description'=>'',),
	         'paytip'=>array(
	             'title'=>'团购付款提示页面',
               'keywords'=>'',
               'description'=>'',),
	         
	      
	     ),
	     
	     
	     
	     'hotelspay'=>array(
	         'step1'=>array(
	             'title'=>'酒店付款第一步',
               'keywords'=>'',
               'description'=>'',),
	         'step2'=>array(
	             'title'=>'酒店付款第二步',
               'keywords'=>'',
               'description'=>'',),
	         'step3'=>array(
	             'title'=>'酒店付款第三步',
               'keywords'=>'',
               'description'=>'',),
	         'notifyurl'=>array(
	             'title'=>'酒店付款通知',
               'keywords'=>'',
               'description'=>'',),
	         'returnurl'=>array(
	             'title'=>'酒店付款跳转页面',
               'keywords'=>'',
               'description'=>'',),
	         'paytip'=>array(
	             'title'=>'酒店付款提示页面',
               'keywords'=>'',
               'description'=>'',),
	         
	      
	     ),
	     
	     
	     
	     
	     'pay'=>array(
	         'step1'=>array(
	             'title'=>'线路付款第一步',
               'keywords'=>'',
               'description'=>'',),
	         'step2'=>array(
	             'title'=>'线路付款第二步',
               'keywords'=>'',
               'description'=>'',),
	         'step3'=>array(
	             'title'=>'线路付款第三步',
               'keywords'=>'',
               'description'=>'',),
           'step4'=>array(
	             'title'=>'线路付款第四步',
               'keywords'=>'',
               'description'=>'',),
           'step5'=>array(
	             'title'=>'线路付款第五步',
               'keywords'=>'',
               'description'=>'',),
	         'notifyurl'=>array(
	             'title'=>'线路付款通知',
               'keywords'=>'',
               'description'=>'',),
	         'returnurl'=>array(
	             'title'=>'线路付款跳转页面',
               'keywords'=>'',
               'description'=>'',),
	         'paytip'=>array(
	             'title'=>'线路付款提示页面',
               'keywords'=>'',
               'description'=>'',),
           'agreement'=>array(
	             'title'=>'线路预定协议',
               'keywords'=>'',
               'description'=>'',),
	     ),
	     
	     
	     
	     
	     
	     'registe'=>array(
	     	 'index'=>array('title'=>'会员注册第一步',
               'keywords'=>'',
               'description'=>'',),
	     	  'registe2'=>array('title'=>'会员注册第二步',
               'keywords'=>'',
               'description'=>'',),
	     	  'registe3'=>array('title'=>'会员注册第三步',
               'keywords'=>'',
               'description'=>'',),
	     	  'company'=>array('title'=>'商家注册',
               'keywords'=>'',
               'description'=>'',),
	     	  'agreement'=>array('title'=>'会员协议',
               'keywords'=>'',
               'description'=>'',),
	     	  'companyagreement'=>array('title'=>'商家协议',
               'keywords'=>'',
               'description'=>'',),
	     	),
	     	
	     	
	     	'search'=>array(
	     	  'index'=>array('title'=>'相关产品搜索',
               'keywords'=>'',
               'description'=>'',),
	     	),
	     	
	     	
	     	'login'=>array(
	     	  'index'=>array(
	     	       'title'=>'会员登录',
               'keywords'=>'',
               'description'=>'',
	     	  ),
	     	  'logout'=>array(
	     	       'title'=>'会员退出',
               'keywords'=>'',
               'description'=>'',
	     	  
	     	  ),
	     	),
	     
	     'error'=>array(
	     	  'error404'=>array(
	     	       'title'=>'页面错误',
               'keywords'=>'',
               'description'=>'',
	     	  ),
	     	
	     	),
	     	
	     	'help'=>array(
	     	  'index'=>array(
	     	       'title'=>'帮助中心',
               'keywords'=>'',
               'description'=>'',
	     	  ),
	     	),
	     	
	     	'region'=>array(
	     	  'index'=>array(
	     	       'title'=>'设置出发城市',
               'keywords'=>'',
               'description'=>'',
           ),
           
           
           'set'=>array(
	     	       'title'=>'设置出发城市',
               'keywords'=>'',
               'description'=>'',
           ),
	     	  
	     	),
	     	
	     'travel'=>array(
	        'index'=>array(
	             'title'=>'{$seo_title}',
               'keywords'=>'{$seo_keywords}',
               'description'=>'{$seo_description}',
	          ),
	          
	          'list'=>array(
	             'title'=>'{$seo_title}',
               'keywords'=>'{$seo_keywords}',
               'description'=>'{$seo_description}',
	          ),
	          
	          'show'=>array(
	             'title'=>'{$seo_title}',
               'keywords'=>'{$seo_keywords}',
               'description'=>'{$seo_description}',
	          ),
	          
	           'date'=>array(
	             'title'=>'{$seo_title}',
               'keywords'=>'{$seo_keywords}',
               'description'=>'{$seo_description}',
	          ),
	     ),
	     	
	     	
	      'user'=>array(
	     	  'index'=>array(
	     	       'title'=>'个人资料',
               'keywords'=>'',
               'description'=>'',
	     	  ),
	     	  'editprofile'=>array(
	     	       'title'=>'修改资料',
               'keywords'=>'',
               'description'=>'',
	     	  
	     	  ),
	     	  'editemail'=>array(
	     	       'title'=>'修改邮箱',
               'keywords'=>'',
               'description'=>'',
	     	  ),
	     	  
	     	  'editpassword'=>array(
	     	       'title'=>'修改密码',
               'keywords'=>'',
               'description'=>'',
	     	  ),
	     	  
	     	  'pay'=>array(
	     	       'title'=>'在线支付',
               'keywords'=>'',
               'description'=>'',
	     	  ),
	     	  
	     	  'pay2'=>array(
	     	       'title'=>'在线支付',
               'keywords'=>'',
               'description'=>'',
	     	  ),
	     	  
	     	  'returnurl'=>array(
	     	       'title'=>'支付状态',
               'keywords'=>'',
               'description'=>'',
	     	  ),
	     	  
	     	   'coupon'=>array(
	     	       'title'=>'账户明细',
               'keywords'=>'',
               'description'=>'',
	     	  ),
	     	  
	     	  
	     	   'editpaypassword'=>array( 'title'=>'修改支付密码',
               'keywords'=>'',
               'description'=>'',),
	     		 'contacter'=>array( 'title'=>'常用联系人',
               'keywords'=>'',
               'description'=>'',),
	     		 'editcontacter'=>array( 'title'=>'修改常用联系人',
               'keywords'=>'',
               'description'=>'',),
	     		 'message'=>array( 'title'=>'站内信',
               'keywords'=>'',
               'description'=>'',),
	     		 'messageshow'=>array( 'title'=>'站内信',
               'keywords'=>'',
               'description'=>'',),
	     		 'scheduler'=>array( 'title'=>'我的行程',
               'keywords'=>'',
               'description'=>'',),
	     		 'travelorder'=>array( 'title'=>'线路订单',
               'keywords'=>'',
               'description'=>'',),
	     		 'travelorderview'=>array( 'title'=>'查看线路订单',
               'keywords'=>'',
               'description'=>'',),
	     		 'travelfavorite'=>array( 'title'=>'线路收藏',
               'keywords'=>'',
               'description'=>'',),
	     		 'grouporder'=>array( 'title'=>'团购订单',
               'keywords'=>'',
               'description'=>'',),
	     		 'grouporderview'=>array( 'title'=>'查看团购订单',
               'keywords'=>'',
               'description'=>'',),
               
            'groupfavorite'=>array( 'title'=>'团购收藏',
               'keywords'=>'',
               'description'=>'',),
                  
           'hotelsorder'=>array( 'title'=>'酒店订单',
               'keywords'=>'',
               'description'=>'',),
	     		 'hotelsorderview'=>array( 'title'=>'查看酒店订单',
               'keywords'=>'',
               'description'=>'',),
            'hotelsfavorite'=>array( 
            	'title'=>'酒店收藏',
               'keywords'=>'',
               'description'=>'',),   
	     	),
	  ),
	);
	
  public static function set_seo_content($title=array(),$keywords=array(),$description=array()){
  	$controller_id=Yii::app()->getController()->id;
  	$action_id=Yii::app()->getController()->getAction()->id;
  	$module_id=Yii::app()->getController()->getModule()->id;
  	$controller_id=strtolower($controller_id);
  	$action_id=strtolower($action_id);
  	$module_id=strtolower($module_id);
  	$webseo=self::$webseo;
  
  	$seo_title=$webseo[$module_id][$controller_id][$action_id]['title'];
  	$seo_keywords=$webseo[$module_id][$controller_id][$action_id]['keywords'];
  	$seo_description=$webseo[$module_id][$controller_id][$action_id]['description'];
  
  	if(!empty($title)){
  		$seo_title=self::replace_variable($title,$seo_title);
  	}
  	if(!empty($keywords)){

  		$seo_keywords=self::replace_variable($keywords,$seo_keywords);
  	}
  	if(!empty($description)){
  		$seo_description=self::replace_variable($description,$seo_description);
  	}
    $sys_config=SysConfig::model();
		$all_syscfg_values=$sys_config->get_all_syscfg();
		Yii::app()->getController()->pageTitle=empty($seo_title)?($all_syscfg_values['sfc_home_title']."-".$all_syscfg_values['sfc_web_title']):($seo_title."-".$all_syscfg_values['sfc_home_title']."-".$all_syscfg_values['sfc_web_title']);
		Yii::app()->getController()->seo_description=empty($seo_description)?$all_syscfg_values['sfc_web_description']:$seo_description;
		Yii::app()->getController()->seo_keywords=empty($seo_keywords)?$all_syscfg_values['sfc_web_keywords']:$seo_keywords;

  }

 public static function set_breadcrumbs($sbreadcrumbs=array()){
    $controller_id=Yii::app()->getController()->id;
  	$action_id=Yii::app()->getController()->getAction()->id;
  	$module_id=Yii::app()->getController()->getModule()->id;
  	$controller_id=strtolower($controller_id);
  	$action_id=strtolower($action_id);
  	$module_id=strtolower($module_id);
  	$breadcrumbs=self::$breadcrumbs;   
  	$content=$breadcrumbs[$module_id][$controller_id][$action_id];
  	if(!empty($sbreadcrumbs)){
  		Yii::app()->getController()->breadcrumbs=$sbreadcrumbs;
  	}else{
  		
  		Yii::app()->getController()->breadcrumbs=$content;
  	}
 }
  
  
 public static function replace_variable($replace=array(),$content){
	 if(!empty($replace)){
	 	$tem_key=array();
	 	$tem_value=array();
	 	foreach((array)$replace as $key => $value){
	 		$key_name="{"."$".$key."}";
	 		array_push($tem_key,$key_name);
	 		array_push($tem_value,$value);
	 	}
	 	$content=str_replace($tem_key, $tem_value, $content);
	 }
 	 return $content;
 }
}
?>
