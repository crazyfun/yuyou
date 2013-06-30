<?php
//旅游
class TZ {
	/*
	 获取搜素的挂件
   @param string $view  视图

	*/
	static function travelsearch($params=""){
		$sys_config=SysConfig::model();
		$sys_config_values=$sys_config->get_all_syscfg();
		$sfc_cache=$sys_config_values['sfc_cache'];
		$sfc_cache_time=$sys_config_values['sfc_cache_time'];
		$params=self::splite_params($params);
		$view=$params['view'];
		$cacheid=$params['cacheid'];
		$cache=$params['cache'];
		
	  if($sfc_cache=="N"){
			$cache=0;
		}else{
			if(empty($cache)){
				$cache=$sfc_cache_time;
			}
		}
		if(empty($cacheid)){
			$cacheid="travelsearch";
		}
		if(empty($view)){
			$view="index";
		}
	  if(Yii::app()->getController()->beginCache($cacheid, array('duration'=>$cache))){
            Yii::app()->getController()->widget('Wtsearch', array( 
                     'view'=>$view,            
            )); 
            Yii::app()->getController()->endCache(); 
     } 
	}
	
	/*
	 获取各个旅游的搜索的挂件
	 @param string $channel_id 栏目id
   @param string $view  视图

	*/
	static function categorysearch($params=""){
		$sys_config=SysConfig::model();
		$sys_config_values=$sys_config->get_all_syscfg();
		$sfc_cache=$sys_config_values['sfc_cache'];
		$sfc_cache_time=$sys_config_values['sfc_cache_time'];
		$params=self::splite_params($params);
		$channel_id=$params['channel_id'];
		$view=$params['view'];
		$cacheid=$params['cacheid'];
		$cache=$params['cache'];
	  if($sfc_cache=="N"){
			$cache=0;
		}else{
			if(empty($cache)){
				$cache=$sfc_cache_time;
			}
		}
		if(empty($cacheid)){
			$cacheid="categorysearch";
		}
		if(empty($view)){
			$view="index";
		}
	  if(Yii::app()->getController()->beginCache($cacheid, array('duration'=>$cache))){
            Yii::app()->getController()->widget('Wcsearch', array(
                     'channel_id'=>$channel_id, 
                     'view'=>$view,            
            )); 
            Yii::app()->getController()->endCache(); 
     } 
	}
	
	
		/*
	 获取特价线路
	 @param string $channel_id 栏目id
   @param string $view  视图

	*/
	static function tejiatravel($params=""){
		$sys_config=SysConfig::model();
		$sys_config_values=$sys_config->get_all_syscfg();
		$sfc_cache=$sys_config_values['sfc_cache'];
		$sfc_cache_time=$sys_config_values['sfc_cache_time'];
		$params=self::splite_params($params);
		$view=$params['view'];
		$cacheid=$params['cacheid'];
		$cache=$params['cache'];
	  if($sfc_cache=="N"){
			$cache=0;
		}else{
			if(empty($cache)){
				$cache=$sfc_cache_time;
			}
		}
		if(empty($cacheid)){
			$cacheid="tejiatravel";
		}
		if(empty($view)){
			$view="index";
		}
	  if(Yii::app()->getController()->beginCache($cacheid, array('duration'=>$cache))){
            Yii::app()->getController()->widget('Wtejiatravel', array(
                     'view'=>$view,            
            )); 
            Yii::app()->getController()->endCache(); 
     } 
	}
	
	
	/*
	 获取二级页面的精选推荐线路
	 @param string $channel_id 栏目id
   @param string $view  视图
   @param string $attr 属性
   @param string $limit 显示线路的条数
   @param string $sort  排序
   @param string $sort_type 排序方式
   @param string $cacheid 缓存Id
   @param string cache缓存时间

	*/
	static function tuijiantravel($params=""){
		$sys_config=SysConfig::model();
		$sys_config_values=$sys_config->get_all_syscfg();
		$sfc_cache=$sys_config_values['sfc_cache'];
		$sfc_cache_time=$sys_config_values['sfc_cache_time'];
		$params=self::splite_params($params);
		$channel_id=$params['channel_id'];
		$attr=$params['attr'];
		$view=$params['view'];
		$limit=$params['limit'];
		$sort=$params['sort'];
		$sort_type=$params['sort_type'];
		$cacheid=$params['cacheid'];
		$cache=$params['cache'];
	  if($sfc_cache=="N"){
			$cache=0;
		}else{
			if(empty($cache)){
				$cache=$sfc_cache_time;
			}
		}
		if(empty($cacheid)){
			$cacheid="tuijiantravel";
		}
		if(empty($view)){
			$view="index";
		}
		if(empty($limit)){
			$limit=10;
		}
		if(empty($sort)){
			$sort="update_time";
		}
		if(empty($sort_type)){
			$sort_type="DESC";
		}
	  if(Yii::app()->getController()->beginCache($cacheid, array('duration'=>$cache))){
            Yii::app()->getController()->widget('Wtuijiantravel', array(
                     'channel_id'=>$channel_id,
                     'attr'=>$attr,
                     'limit'=>$limit,
                     'sort'=>$sort,
                     'sort_type'=>$sort_type,
                     'view'=>$view,            
            )); 
            Yii::app()->getController()->endCache(); 
    } 
	}
	
			/*
	 获取二级页面的热门推荐线路
	 @param string $channel_id 栏目id
   @param string $view  视图

	*/
	static function rementuijian($params=""){
		$sys_config=SysConfig::model();
		$sys_config_values=$sys_config->get_all_syscfg();
		$sfc_cache=$sys_config_values['sfc_cache'];
		$sfc_cache_time=$sys_config_values['sfc_cache_time'];
		$params=self::splite_params($params);
		$channel_id=$params['channel_id'];
		$view=$params['view'];
		$cacheid=$params['cacheid'];
		$cache=$params['cache'];
	  if($sfc_cache=="N"){
			$cache=0;
		}else{
			if(empty($cache)){
				$cache=$sfc_cache_time;
			}
		}
		if(empty($cacheid)){
			$cacheid="rementuijian";
		}
		if(empty($view)){
			$view="index";
		}
	  if(Yii::app()->getController()->beginCache($cacheid, array('duration'=>$cache))){
            Yii::app()->getController()->widget('Wrementuijian', array(
                     'channel_id'=>$channel_id,
                     'view'=>$view,            
            )); 
            Yii::app()->getController()->endCache(); 
    } 
	}
	
		/*
	 获取二级页面的精选推荐线路
	 @params string $title 精选推荐的title名称
	 @param string $channel_id 栏目id
   @param string $view  视图
   @param string $attr 属性
   @param string $limit 显示线路的条数
   @param string $sort  排序
   @param string $sort_type 排序方式
   @param string $cacheid 缓存Id
   @param string cache缓存时间

	*/
	static function jingxuantuijiantravel($params=""){
		$sys_config=SysConfig::model();
		$sys_config_values=$sys_config->get_all_syscfg();
		$sfc_cache=$sys_config_values['sfc_cache'];
		$sfc_cache_time=$sys_config_values['sfc_cache_time'];
		$params=self::splite_params($params);
		$title=$params['title'];
		$channel_id=$params['channel_id'];
		$attr=$params['attr'];
		$view=$params['view'];
		$limit=$params['limit'];
		$sort=$params['sort'];
		$sort_type=$params['sort_type'];
		$cacheid=$params['cacheid'];
		$cache=$params['cache'];
	  if($sfc_cache=="N"){
			$cache=0;
		}else{
			if(empty($cache)){
				$cache=$sfc_cache_time;
			}
		}
		if(empty($cacheid)){
			$cacheid="jingxuantuijiantravel";
		}
		if(empty($view)){
			$view="index";
		}
		if(empty($limit)){
			$limit=10;
		}
		if(empty($sort)){
			$sort="update_time";
		}
		if(empty($sort_type)){
			$sort_type="DESC";
		}
	  if(Yii::app()->getController()->beginCache($cacheid, array('duration'=>$cache))){
            Yii::app()->getController()->widget('Wjingxuantuijiantravel', array(
                     'title'=>$title,
                     'channel_id'=>$channel_id,
                     'attr'=>$attr,
                     'limit'=>$limit,
                     'sort'=>$sort,
                     'sort_type'=>$sort_type,
                     'view'=>$view,            
            )); 
            Yii::app()->getController()->endCache(); 
    } 
	}
	
			/*
	 获取最新订单
	 @param string $type 订单的类型
	 @param string $view 订单视图
   @param string $limit 订单视图

	*/
	static function newestorder($params=""){
		$sys_config=SysConfig::model();
		$sys_config_values=$sys_config->get_all_syscfg();
		$sfc_cache=$sys_config_values['sfc_cache'];
		$sfc_cache_time=$sys_config_values['sfc_cache_time'];
		$params=self::splite_params($params);
		$view=$params['view'];
		$type=$params['type'];
		$limit=$params['limit'];
		$region_id=$params['region_id'];
		$cacheid=$params['cacheid'];
		$cache=$params['cache'];
	  if($sfc_cache=="N"){
			$cache=0;
		}else{
			if(empty($cache)){
				$cache=$sfc_cache_time;
			}
		}
		if(empty($cacheid)){
			$cacheid="newest_order";
		}
		if(empty($view)){
			$view="index";
		}
	  if(Yii::app()->getController()->beginCache($cacheid, array('duration'=>$cache))){
            Yii::app()->getController()->widget('NewestOrder', array(
             				 'region_id'=>$region_id,
                		 'type'=>$type,
                		 'limit'=>$limit,
                     'view'=>$view,            
            )); 
            Yii::app()->getController()->endCache(); 
     } 
	}

	/*
	 切割传递过来的参数成数组形式
   @param string $view    咨询的视图
	*/
	static function  splite_params($params=""){
		if(empty($params)){
			return null;
		}
		$params_explode=explode("/",$params);
	  $params_count=count($params_explode);
	 
	  if($params_count%2){
	  	return null;
	  }	
	  $return_params=array();
	  for($ii=0; $ii< $params_count; $ii=$ii+2){
	  	$key=$params_explode[$ii];
	  	$return_params[$key]=$params_explode[$ii+1];
	  }
	  return $return_params;
	}
}
?>
