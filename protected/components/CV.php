<?php
class CV {
	//qa unlogin
	const SUCCESS_ADMIN_OPERATE=1;
	const FAILED_ADMIN_OPERATE=2;
	const ERROR_ADMIN_DATABASE=3;

	const SUCCESS=1;
	const FAIL=2;
	const TIP=3;
	const REFRASH=20;
	const PAYVALIDATE=4;
	const PAYSUCCESS=5;
	const PAYFAILED=6;
	const MESSAGE_SUCCESS=4;
	const SUPER_USER=1;
	public static $pattern=array('archives'=>'文档','travel'=>'线路','group'=>'团购','hotels'=>'酒店');
	public static $config_value_type=array('1'=>'内容属性','2'=>'模块视图','3'=>'文档来源','4'=>'内容排序','5'=>'栏目列表视图','6'=>'留言类别','10'=>'服务支持','11'=>'价格范围','12'=>'软件类型','13'=>'授权方式','14'=>'界面语言','15'=>'软件等级');
	public static $template_type=array('1'=>'邮件模板','2'=>'消费模板','3'=>'短信模板');
	public static $model_type=array('help'=>'1');
	public static $input_type=array('text'=>'text','number'=>'number','hidden'=>'hidden','password'=>'password','file'=>'file','image'=>'image','textarea'=>'textarea','select'=>'select','multi'=>'multi','check'=>'check','checkbox'=>'checkbox','radio'=>'radio','date'=>'date','multitext'=>'multitext','auto'=>'auto','multiauto'=>'multiauto','ajaxselect'=>'ajaxselect');
	public static $charaters=array('1'=>'A','2'=>'B','3'=>'C','4'=>'D','5'=>'E','6'=>'F','7'=>'G','8'=>'H','9'=>'I','10'=>'J','11'=>'K','12'=>'L','13'=>'M','14'=>'N','15'=>'O','16'=>'P','17'=>'Q','18'=>'R','19'=>'S','20'=>'T','21'=>'U','22'=>'V','23'=>'W','24'=>'X','25'=>'Y','26'=>'Z');
	public static $admin_status=array('1'=>'不是','2'=>'是');
	public static $sex=array('1'=>'男','2'=>'女');
	public static $channels_permission=array('1'=>'开放浏览','2'=>'普通会员');
	public static $channels_link_type=array('1'=>'列表页','2'=>'封面','3'=>'外链');
	public static $channels_is_hidden=array('1'=>'显示','2'=>'隐藏');
	public static $archives_status=array('1'=>'未审核','2'=>'已审核','3'=>'回收站');
	public static $archives_permission=array('1'=>'允许','2'=>'禁止');
	public static $archives_addition_select=array('1'=>'提取第一个图片为缩略图','2'=>'下载远程图片和资源');
	public static $block_sort_type=array('1'=>'DESC','2'=>'ASC');
	public static $block_dott=array('Y'=>'显示','N'=>'不显示');
	public static $list_sort_type=array('1'=>'DESC','2'=>'ASC');
	public static $message_status=array('1'=>'未审核','2'=>'已审核');
	public static $advertising_type=array('1'=>'图片','2'=>'文字','3'=>'flash','4'=>'模块');
	public static $consume_type=array('1'=>'增加','2'=>'减少');
	public static $alipay_pay_method=array(
	//'0'=>'使用标准双接口','1'=>'使用担保交易接口',
	'2'=>'使用即时到帐接口');
  public static $payment_type=array('alipay'=>array('name'=>'支付宝','image'=>'/bank_zfb3.gif'),'kuaiqian'=>array('name'=>'快钱','image'=>'bank_kq.gif'),'kuaiqian_abc'=>array('name'=>'中国农业银行','image'=>'bank_nyyh3.gif'),'kuaiqian_bcom'=>array('name'=>'交通银行','image'=>'bank_jtyh3.gif'),'kuaiqian_boc'=>array('name'=>'中国银行','image'=>'bank_zgyh3.gif'),'kuaiqian_ccb'=>array('name'=>'中国建设银行','image'=>'bank_jsyh3.gif'),'kuaiqian_cmb'=>array('name'=>'招商银行','image'=>'bank_zsyh3.gif'),'kuaiqian_cmbc'=>array('name'=>'中国民生银行','image'=>'bank_msyh3.gif'),'kuaiqian_icbc'=>array('name'=>'中国工商银行','image'=>'bank_gsyh3.gif'),'kuaiqian_sdb'=>array('name'=>'深圳发展银行','image'=>'bank_szfz3.gif'));
  public static $travel_payment_type=array('alipay'=>array('name'=>'支付宝','image'=>'/bank_zfb3.gif'),'kuaiqian'=>array('name'=>'快钱','image'=>'bank_kq.gif'),'kuaiqian_abc'=>array('name'=>'中国农业银行','image'=>'bank_nyyh3.gif'),'kuaiqian_bcom'=>array('name'=>'交通银行','image'=>'bank_jtyh3.gif'),'kuaiqian_boc'=>array('name'=>'中国银行','image'=>'bank_zgyh3.gif'),'kuaiqian_ccb'=>array('name'=>'中国建设银行','image'=>'bank_jsyh3.gif'),'kuaiqian_cmb'=>array('name'=>'招商银行','image'=>'bank_zsyh3.gif'),'kuaiqian_cmbc'=>array('name'=>'中国民生银行','image'=>'bank_msyh3.gif'),'kuaiqian_icbc'=>array('name'=>'中国工商银行','image'=>'bank_gsyh3.gif'),'kuaiqian_sdb'=>array('name'=>'深圳发展银行','image'=>'bank_szfz3.gif'),'coupon'=>array('name'=>'抵用劵','image'=>''),'huikuan'=>array('name'=>'银行汇款','image'=>''),'menshi'=>array('name'=>'门市预定','image'=>''));
  public static $pay_status=array('1'=>'未购买','2'=>'已购买');
  public static $support_status=array('1'=>'未解决','2'=>'解决中','3'=>'已回复','4'=>'已解决');
  public static $travel_status=array('1'=>'未发布','2'=>'已发布','3'=>'回收站');
  public static $regular_month=array(""=>"请选择规律日期",'1'=>'每月','2'=>'一月','3'=>'二月','4'=>'三月','5'=>'四月','6'=>'五月','7'=>'六月','8'=>'七月','9'=>'八月','10'=>'九月','11'=>'十月','12'=>'十一月','13'=>'十二月');
  public static $regular_day=array(""=>"请选择规律日期",'1'=>'天天','2'=>'星期一','3'=>'星期二','4'=>'星期三','5'=>'星期四','6'=>'星期五','7'=>'星期六','8'=>'星期天');
  public static $open_status=array('1'=>'未开通','2'=>'已开通');
  public static $founder=array('1'=>'不是创始人','2'=>'是创始人');
  public static $travel_advertisiong_position=array('0'=>array('name'=>'无','width'=>'0','height'=>'0'),'1'=>array('name'=>'尾部top大横条广告','width'=>'980','height'=>'80'),'2'=>array('name'=>'首页特价路线推荐下面','width'=>'490','height'=>'70'),'3'=>array('name'=>'首页周边旅游推荐下面','width'=>'490','height'=>'70'),'4'=>array('name'=>'首页国内旅游推荐下面','width'=>'490','height'=>'70'),'5'=>array('name'=>'首页出境旅游推荐下面','width'=>'490','height'=>'70'));
  public static $code_type=array("1"=>"身份证","2"=>"护照");
	//搜索的选择项
  public static $search_published_time=array(''=>'不限','7'=>'一周以内','31'=>'一月以内','93'=>'三月以内','186'=>'半年以内');
  public static $travel_order_status=array('1'=>'等待处理','2'=>'已计调确认','3'=>'客服已联系','4'=>'客户已答复','5'=>'已发确认书','6'=>'已转成正式订单','7'=>'已发团通知书','8'=>'取消订单','9'=>'已出游');
  public static $travel_pay_status=array('1'=>'未付款','2'=>'已付款');
  public static $company_type=array('1'=>'组团社','2'=>'地接社','5'=>'团购','6'=>'酒店');
  public static $company_registe_type=array('1'=>'组团社','2'=>'地接社','6'=>'酒店');
  public static $is_group=array('1'=>'未成团','2'=>'已成团');
  
  public static $travel_settle=array('1'=>'未结算','2'=>'已申请结算','3'=>'已结算');
  public static $group_settle=array('1'=>'未结算','2'=>'已申请结算','3'=>'已结算');
  public static $hotels_settle=array('1'=>'未结算','2'=>'已申请结算','3'=>'已结算');
  public static $travel_reserved=array('1'=>'未预留','2'=>'已预留');
  public static $group_open=array('1'=>'准备中','2'=>'正在进行','3'=>'已结束');
  
  public static $group_status=array('1'=>'未使用','2'=>'已使用','3'=>'已取消');
  public static $group_pay_status=array('1'=>'未付款','2'=>'已付款');
  

	static $GROUP_REPLY_TIME=array("1"=>'尽快回复','2'=>'工作时间回复','3'=>'下班回复');

	static $GROUP_TRANSPORT=array("1"=>'汽车','2'=>'火车','3'=>'飞机','4'=>'轮船','5'=>'不需要安排');

	static $GROUP_STAY=array("1"=>'农家乐','2'=>'经济型','3'=>'三星','4'=>'四星','5'=>'五星','6'=>'不需要安排');

	static $GROUP_DINNING=array("1"=>'20元/人标准餐标','2'=>'30元/人餐标','3'=>'更高要求');

	static $GROUP_GUIDE=array("1"=>'中文导游','2'=>'中英文导游','3'=>'其他语言','4'=>'有景点介绍能力','5'=>'只需全程服务人员');

	static $GROUP_SHOPPING=array("1"=>'不需要','2'=>'少量安排','3'=>'正常安排');

	static $GROUP_MEETING=array("1"=>'需要安排','2'=>'不需要安排');
	
	static $GROUP_CUSTOMIZE_STATUS=array('1'=>'未过期','2'=>'已过期');
	
	static $HOTELS_LEVEL=array("1"=>'农家乐','2'=>'经济型','3'=>'三星','4'=>'四星','5'=>'五星');
	static $HOTEL_PRICE_LIMIT=array('1'=>'100以下','2'=>'100-300','3'=>'300-500','4'=>'500-1000','5'=>'1000-2000','6'=>'2000-3000','7'=>'3000以上');
	static $FACILITY=array('1'=>'宽带上网','2'=>'停车场','3'=>'游泳池','4'=>'穿梭机场班车','5'=>'健身房','6'=>'含早餐','7'=>'家庭房');
	static $HOTELS_LINE=array('1'=>'免费','2'=>'收费');
	static $HOTELS_BED=array('1'=>'双床','2'=>'单床');
	static $HOTELS_BREAKFAST=array('1'=>'含早餐','2'=>'不含早餐');
	
	public static $hotels_status=array('1'=>'等待处理','2'=>'已计调确认','3'=>'已转成正式订单','4'=>'取消订单','5'=>'已入住');
  public static $hotels_pay_status=array('1'=>'未付款','2'=>'已付款');
  
  
  public static $is_show_select=array('1'=>'显示','2'=>'隐藏');

  
  
}
?>
