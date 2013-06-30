<?php
//旅游
class HZ {
	/*
	 获取搜素的挂件
   @param string $view  视图

	*/
	static function hotelssearch($params=""){
		$sys_config=SysConfig::model();
		$sys_config_values=$sys_config->get_all_syscfg();
		$sfc_cache=$sys_config_values['sfc_cache'];
		$sfc_cache_time=$sys_config_values['sfc_cache_time'];
		$params=self::splite_params($params);
		$view=$params['view'];
		$attr=$params['attr'];
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
			$cacheid="hotelssearch";
		}
		if(empty($view)){
			$view="index";
		}
	  if(Yii::app()->getController()->beginCache($cacheid, array('duration'=>$cache))){
            Yii::app()->getController()->widget('Whotelssearch', array( 
                     'view'=>$view,   
                     'attr'=>$attr,         
            )); 
            Yii::app()->getController()->endCache(); 
     } 
	}
		/*
	 获取二级页面的精选推荐线路
   @param string $view  视图
   @param string $attr 属性
   @param string $limit 显示线路的条数
   @param string $sort  排序
   @param string $sort_type 排序方式
   @param string $cacheid 缓存Id
   @param string cache缓存时间

	*/
static function tuijianhotels($params=""){
		$sys_config=SysConfig::model();
		$sys_config_values=$sys_config->get_all_syscfg();
		$sfc_cache=$sys_config_values['sfc_cache'];
		$sfc_cache_time=$sys_config_values['sfc_cache_time'];
		$params=self::splite_params($params);
		$attr=$params['attr'];
		$view=$params['view'];
		$limit=$params['limit'];
		$sort=$params['sort'];
		$brand_id=$params['brand_id'];
		$category=$params['category'];
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
			$cacheid="tuijianhotels";
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
            Yii::app()->getController()->widget('Wtuijianhotels', array(
                     'category'=>$category,
                     'attr'=>$attr,
                     'limit'=>$limit,
                     'sort'=>$sort,
                     'sort_type'=>$sort_type,
                     'view'=>$view,       
                     'brand_id'=>$brand_id, 
                         
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
