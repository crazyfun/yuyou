<?php
class BZ {
	/*
	 获取网站的导航条
	 @param string $view 导航条的样式
	 @param flag $children 导航条是否包含子导航 y:需要  n:不需要
	 @param string $select 导航条二态的选择样式名
	*/	
	static function  menus($params=""){
		$params=self::splite_params($params);
		$view=$params['view'];
		$children=$params['children']?$params['children']:'n';
		$select=$params['select'];
		if(empty($select)){
			$select="menu_select";
		}
	   Yii::app()->getController()->widget('Menus', array( 
           'view'=>$view, 
           'children'=>$children,
           'select'=>$select,           
     )); 
	}
	
 /*
	 获取网站的模块
	 @param string $pattern 模块的模型
	 @param string $id   模块的ID号
	 @param string $channel 模块的频道号
	 @param string $category 模块的分类号
	 @param string $archive_ids 模块的文档ids号
	 @param string $sort 模块的文档的排序
	 @param string $sort_type 模块的排序方式
	 @param string $limit 模块的数量
	 @param string $attr  文档的属性
	 @param string $tlen  显示内容的数量
	 @param stirng $dott  是否显示...
	 @param string $dlen  简短描述的长度
	 @param string $size  图片的尺寸
	 @param string $cacheid 缓存ID号
	 @param string $cache 缓存时间
	 @param string $view 模块的样式的样式
	*/	
 //BZ::blocks("pattern/archives/channel/9/category/4/archive/5/view/title_date_block/sort/modify_time/sort_type/DESC/limit/10/attr/f/tlen/12/dlen/12/size/400*200/cacheid/home_copanynews/cache/86400");
 static function blocks($params=""){
		$sys_config=SysConfig::model();
		$sys_config_values=$sys_config->get_all_syscfg();
		$sfc_cache=$sys_config_values['sfc_cache'];
		$sfc_cache_time=$sys_config_values['sfc_cache_time'];
		$params=self::splite_params($params);
	  $id=$params['id'];
	  if(!empty($id)){
	  	  $blocks=Blocks::model();
	  	  $block_data=$blocks->findByPk($id);
	  	  $pattern=$block_data['pattern'];
	  	  $channel=$block_data['channel'];
				$category=$block_data['category'];
				$archive=$block_data['archive_ids'];
				$config_values=ConfigValues::model();
				$block_view=$config_values->findByPk($block_data['view']);
        $sort_select=$config_values->findByPk($block_data['sort']);
				$view=$block_view->value;
				$sort=$sort_select->value;
				$block_sort_type=CV::$block_sort_type;
				$sort_type=$block_sort_type[$block_data['sort_type']];
				$limit=$block_data['limit'];
				$attr=$block_data['attr'];
				$tlen=$block_data['tlen'];
				$dott=$block_data['dott'];
				$dlen=$block_data['dlen'];
				$size=$block_data['size'];
				$region_id="";
				$cacheid=$block_data['identification'];
				$cache=$block_data['cache'];
	  }else{
	  	  $pattern=$params['pattern'];
	  	  $channel=$params['channel'];
				$category=$params['category'];
				$archive=$params['archive'];
				$view=$params['view'];
				$sort=$params['sort'];
				$sort_type=$params['sort_type'];
				$limit=$params['limit'];
				$attr=$params['attr'];
				$tlen=$params['tlen'];
				$dott=$params['dott'];
				$dlen=$params['dlen'];
				$size=$params['size'];
				$region_id=$params['region_id'];
				$cacheid=$params['cacheid'];
				$cache=$params['cache'];
	  }
		if($sfc_cache=="N"){
			$cache=0;
		}else{
			if(empty($cache)){
				$cache=$sfc_cache_time;
			}
		}
		if(empty($cacheid)){
			$cacheid="blocks";
		}


	  if(Yii::app()->getController()->beginCache($cacheid, array('duration'=>$cache))){
            Yii::app()->getController()->widget('WBlocks', array( 
               			 'pattern'=>$pattern,
                     'archive'=>$archive,
                     'channel'=>$channel,
                     'category'=>$category,
                     'archive'=>$archive,
                     'view'=>$view,
                     'sort'=>$sort,
                     'sort_type'=>$sort_type,
                     'limit'=>$limit,  
                     'attr'=>$attr,   
                     'tlen'=>$tlen,
                     'dott'=>$dott,
                     'dlen'=>$dlen, 
                     'size'=>$size,
                     'region_id'=>$region_id,     
            )); 
            Yii::app()->getController()->endCache(); 
     }  
	}
	 /*
	 获取更多的链接
	 @param string $pattern 更多的模型
	 @param string $channel 更多的频道号
	 @param string $category 更多的分类号
	 @param string $class    更多的类名
	*/	
	static function more($params=""){
		 $params=self::splite_params($params);
		 $pattern=$params['pattern'];
		 $channel=$params['channel'];
		 $category=$params['category'];
		 $class=$params['class'];
		 switch($pattern){
		 	case 'archives':
		 	  $pattern="mchannels";
		 	  break;
		 	default:
		 	  break;
		 }
		 echo  CHtml::link("更多...",Yii::app()->getController()->createUrl($pattern."/list",array('channel'=>$channel,'category'=>$category)),array('title'=>'查看更多','class'=>$class));
	}
	/*
	 获取文档列表的显示
	 @param string $pattern  列表显示的模型
	 @param string $view 列表显示视图
	 @param string $channel 列表显示的频道号
	 @param string $category 列表显示的分类号
	 @param string $limit    列表的显示条数
	 @param string $sort     列表的排序
	 @param string $sort_type 列表排序方式
	 @param string $size      列表缩略图大小
	*/	
	static function lists($params=""){
		$params=self::splite_params($params);
		if(!empty($params['id'])){
			$channels_model=Channels::model();
			$channel_data=$channels_model->findByPk($params['id']);
			$channel=$channel_data->id;
			$pattern=$channel_data->pattern;
			$category=$params['category']; 
			$config_values=ConfigValues::model();
			$archive_view=$config_values->findByPk($channel_data->list_view);
      $archive_sort=$config_values->findByPk($channel_data->list_sort);
			$list_view=$archive_view->value;
			$list_sort=$archive_sort->value;
			$archive_sort_type=CV::$list_sort_type;
			$list_sort_type=$archive_sort_type[$channel_data->list_sort_type];
			$list_limit=$channel_data->list_limit;
			if(!empty($params['size'])){
				$size=$params['size'];
			}else{
				$explode_size=explode(",",$channel_data->image_size);
				$size=$explode_size[0];
		  }
		  $region_id="";
			$ajaxUpdate=$params['ajaxUpdate']?true:false;
		}else{
			$pattern=$params['pattern'];
			$list_view=$params['view'];
			$channel=$params['channel'];
			$category=$params['category'];
			$list_limit=$params['limit'];
			$list_sort=$params['sort'];
			$list_sort_type=$params['sort_type'];
			$size=$params['size'];
			$region_id=$params['region_id'];
			$ajaxUpdate=$params['ajaxUpdate']?true:false;
	  }
    Yii::app()->getController()->widget('WList', array( 
          'pattern'=>$pattern,
          'view'=>$list_view,
          'channel'=>$channel,
          'category'=>$category,
          'limit'=>$list_limit,
          'sort'=>$list_sort,
          'sort_type'=>$list_sort_type,
          'size'=>$size,
          'region_id'=>$region_id,
          'ajaxUpdate'=>$ajaxUpdate,
    ));       
	}
		/*
	 获取栏目列表的显示
	 @param string $pattern  列表显示的模型
	 @param string $view 列表显示视图
	 @param string $ids 栏目id号
	 @param string $parent 栏目父分类号
	 @param string $show    是否显示的栏目  1 显示  2 不显示
	 @param string $select   选择的class名称 默认channel_select

	*/	
	static function channels($params){
		$params=self::splite_params($params);
		$pattern=$params['pattern'];
		$view=$params['view'];
		$ids=$params['ids'];
		$parent=$params['parent'];
		$show=$params['show'];

	  if(empty($view)){
	  	$view="children_list";
	  }
	  $select=$params['select'];
		if(empty($select)){
			$select="channel_select";
		}
    Yii::app()->getController()->widget('WChannel', array( 
          'pattern'=>$pattern,
          'view'=>$view,
          'ids'=>$ids,
          'parent'=>$parent,
          'show'=>$show,
          'select'=>$select,
                    
    )); 
	}
	
/*
	 获取分类列表的显示
	 @param string $pattern  列表显示的模型
	 @param string $channel  栏目ID
	 @param string $view 列表显示视图
	 @param string $ids 栏目id号
	 @param string $parent 栏目父分类号
	 @param string $select   选择的class名称 category_select
	*/
 	static function category($params){
		$params=self::splite_params($params);
		$pattern=$params['pattern'];
		if(empty($pattern)){
			$pattern="archives";
		}
		$view=$params['view'];
		$channel=$params['channel'];
		$ids=$params['ids'];
		$parent=$params['parent'];
	  if(empty($view)){
	  	$view="children_list";
	  }
	  $select=$params['select'];
		if(empty($select)){
			$select="category_select";
		}
    Yii::app()->getController()->widget('WCategory', array( 
          'pattern'=>$pattern,
          'view'=>$view,
          'channel'=>$channel,
          'ids'=>$ids,
          'parent'=>$parent,  
          'select'=>$select,        
    ));
	}
	/*
	 获取上一篇下一篇的显示
	 @param string $id  文档ID
	 @param string $show  显示类型 v 竖排显示  h 横排显示

	*/
	static function relation($params=""){
		$params=self::splite_params($params);
		$pattern=$params['pattern'];
		$id=$params['id']; 
		$show=$params['show'];
		if(empty($show)){
			$show="v";
		}
		if(empty($pattern)){
    			$pattern="archives";
    }
    $model_name=ucfirst($pattern);
		$model=new $model_name();
    $model_data=$model->findByPk($id);
		$channel_id=$model_data->channel_id;
		
			$first_data=$model->find(array('condition'=>'t.id<:id AND t.channel_id=:channel_id AND t.status=:status','params'=>array(':id'=>$id,':channel_id'=>$channel_id,':status'=>'2'),'order'=>'t.id DESC'));
			$next_data=$model->find(array('condition'=>'t.id>:id AND t.channel_id=:channel_id AND t.status=:status','params'=>array(':id'=>$id,':channel_id'=>$channel_id,':status'=>'2'),'order'=>'t.id ASC'));
	  	$first_href="";
	 		$next_href="";
	 	 	if(empty($first_data)){
	  		$first_href="javascript:void(0);";
	  		$first_text="没有了";
	  	}else{
	  		$first_href=$model->set_channel_link($pattern,$first_data->id);
	  		$first_text=$first_data->title;
	  	}
	  	if(empty($next_data)){
	  		 $next_href="javascript:void(0);";
	  		 $next_text="没有了";
	  	}else{
	  		 $next_href=$model->set_channel_link($pattern,$next_data->id);
	  		 $next_text=$next_data->title;
	 	  }
	 	 	if($show=="v"){
	  	    echo "<p>上一篇：<a href='".$first_href."'>".$first_text."</a></p><p>下一篇：<a href='".$next_href."'>".$next_text."</a></p>";

	  	}else{
	  	    echo  "<span>上一篇：<a href='".$first_href."'>".$first_text."</a></span>&nbsp;&nbsp;<span>下一篇：<a href='".$next_href."'>".$next_text."</a></span>";
	  	}
		

	}
	
	
	
	/*
	 获取顶和踩的显示的显示
	 @param string $id  文档ID
	 @param string $pattern 模型
	 @param string $view    视图

	*/
	static function vot($params=""){
		$params=self::splite_params($params);
		$pattern=$params['pattern'];
		$id=$params['id']; 
		$view=$params['view'];
		if(empty($view)){
			$view="index";
		}
		if(empty($pattern)){
    			$pattern="archives";
    }
		Yii::app()->getController()->widget('WVot', array( 
                 'pattern'=>$pattern, 
                 'id'=>$id,
                 'view'=>$view,
    )); 
	}
	
	
	
	
		/*
	 获取友情链接
	 @param string $type  友情链接类型
	 @param string $view  友情链接视图
	 @param string $limit 显示友情链接的数量

	*/
	static function flink($params=""){
		$sys_config=SysConfig::model();
		$sys_config_values=$sys_config->get_all_syscfg();
		$sfc_cache=$sys_config_values['sfc_cache'];
		$sfc_cache_time=$sys_config_values['sfc_cache_time'];
		$params=self::splite_params($params);
		$type=$params['type'];
		$view=$params['view'];
		if(empty($view)){
			$view="flink_list";
		}
		$limit=$params['limit'];
		if($sfc_cache=="N"){
			$cache=0;
		}else{
			if(empty($cache)){
				$cache=$sfc_cache_time;
			}
		}
		if(empty($cacheid)){
			$cacheid="flink";
		}
		if(Yii::app()->getController()->beginCache($cacheid, array('duration'=>$cache))){
            Yii::app()->getController()->widget('Flink', array( 
                 'type'=>$type,
                 'view'=>$view,  
                 'limit'=>$limit,    
            )); 
            Yii::app()->getController()->endCache(); 
     }  
	}
	
	
	/*
	 获取评论
	 @param string $model  数据库model的名称
	 @param string $archive 文档id号
	 @param string $user 是否允许游客评论 true:会员评论  false:非会员可以评论  
	 @param string $type 输入框的样式Textarea Multitext
	 @param string $level  显示的层级

	*/
	static function comment($params=""){
		$params=self::splite_params($params);
		$pattern=$params['pattern'];
		$content_id=$params['archive'];
		$user_flag=$params['user'];
		$input_type=$params['type'];
		$level=$params['level'];
		if(empty($pattern)){
    		$pattern="archive";
    }
		Yii::app()->getController()->widget('WebComment', array(      
                   'model_id'=>$pattern,
                   'user_flag'=>$user_flag,
                   'content_id'=>$content_id,
                   'input_type'=>$input_type,
                   'level'=>$level,             
    )); 
    
	}
/*
	 获取广告
	 @param string $pattern 模型名称
	 @param string $id      广告id
	 @param string $position广告位置
	 @param string $cacheid 缓存ID
	 @param string $cache   缓存时间
	*/
	static function ad($params=""){
		$sys_config=SysConfig::model();
		$sys_config_values=$sys_config->get_all_syscfg();
		$sfc_cache=$sys_config_values['sfc_cache'];
		$sfc_cache_time=$sys_config_values['sfc_cache_time'];
		$params=self::splite_params($params);
		$pattern=$params['pattern'];
		$id=$params['id'];
		$position=$params['position'];
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
			$cacheid="ad_".$id;
		}

	  if(Yii::app()->getController()->beginCache($cacheid, array('duration'=>$cache))){
	  	switch($pattern){
	  	  case 'travel':
	  	      $model_name="TravelAdvertising";
    				$model=new $model_name();
	  	      if(empty($id)){		
    						$ip_convert=IpConvert::get();
		 						$region_data=$ip_convert->init_region();
    						$region_id=$region_data['id'];
    						$region_name=$region_data['name'];
								$model_data=$model->find("position=:position AND FIND_IN_SET('".$region_id."',t.region_ids)>0",array(':position'=>$position));
					 }else{
					    	$model_data=$model->findByPk($id);
					 }
	  	  		break;	
	  	  default:
	  	      $model_name="Advertising";
						$model=new $model_name();
						$model_data=$model->findByPk($id);
	  	  		break;
	  	}
		  echo $model_data->content;
		  Yii::app()->getController()->endCache();
    }  
	}
	/*
	 获取轮转广告
	 @param string $pattern 模型名称
   @param string $view    flash广告的视图
	 @param string $cacheid 缓存ID
	 @param string $cache   缓存时间
	*/
	static function flash($params=""){
		$sys_config=SysConfig::model();
		$sys_config_values=$sys_config->get_all_syscfg();
		$sfc_cache=$sys_config_values['sfc_cache'];
		$sfc_cache_time=$sys_config_values['sfc_cache_time'];
		$params=self::splite_params($params);
		$pattern=$params['pattern'];
		$view=$params['view'];
		$cacheid=$params['cacheid'];
		$cache=$params['cache'];
		if(empty($view)){
			$view="flash";
		}
		if($sfc_cache=="N"){
			$cache=0;
		}else{
			if(empty($cache)){
				$cache=$sfc_cache_time;
			}
		}
		if(empty($cacheid)){
			$cacheid="flash";
		}
	  if(Yii::app()->getController()->beginCache($cacheid, array('duration'=>$cache))){
            Yii::app()->getController()->widget('Flash', array( 
                     'pattern'=>$pattern,
                     'view'=>$view,            
            )); 
            Yii::app()->getController()->endCache(); 
     }  
	}
  /*
	 获取咨询表单
	 @param string $code    是否有验证码
   @param string $view    咨询的视图

	*/
	static function message($params=""){
		$params=self::splite_params($params);
		$view=$params['view'];
		$code=$params['code'];
		if(empty($view)){
			$view="message";
		}
    Yii::app()->getController()->widget('Wmessage', array( 
           'code'=>$code,
           'view'=>$view,        
    )); 
	}
	 /*
	 获取回复内容
	 @param string $limit   显示数量
   @param string $view    咨询的视图

	*/
	static function reply($params=""){
		$params=self::splite_params($params);
		$view=$params['view'];
		$limit=$params['limit'];
		if(empty($limit)){
			$limit='10';
		}
		if(empty($view)){
			$view="reply_item";
		}
    Yii::app()->getController()->widget('Wreply', array( 
           'view'=>$view,
           'limit'=>$limit,        
    )); 
	}
	/*
	 获取网站地图
   @param string $view    咨询的视图

	*/
	static function webmap($params=""){
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
			$cacheid="webmap";
		}
	  if(Yii::app()->getController()->beginCache($cacheid, array('duration'=>$cache))){
            Yii::app()->getController()->widget('Wwebmap', array( 
                     'view'=>$view,            
            )); 
            Yii::app()->getController()->endCache(); 
     }   
	}
	
		/*
	 获取footer部分的帮助内容
	 @param string $cids 要显示的帮助的分类的id号
   @param string $view  视图

	*/
	static function helpshow($params=""){
		$sys_config=SysConfig::model();
		$sys_config_values=$sys_config->get_all_syscfg();
		$sfc_cache=$sys_config_values['sfc_cache'];
		$sfc_cache_time=$sys_config_values['sfc_cache_time'];
		$params=self::splite_params($params);
		$cids=$params['cids'];
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
			$cacheid="helpshow";
		}
	  if(Yii::app()->getController()->beginCache($cacheid, array('duration'=>$cache))){
            Yii::app()->getController()->widget('Whelpshow', array( 
            				 'cids'=>$cids,
                     'view'=>$view,            
            )); 
            Yii::app()->getController()->endCache(); 
     } 
	}
	/*
	 获取帮助分类
   @param string $view  帮助分类的视图
	*/
	static function helpcategory($params=""){
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
			$cacheid="helpcategory";
		}
	  if(Yii::app()->getController()->beginCache($cacheid, array('duration'=>$cache))){
            Yii::app()->getController()->widget('Whelpcategory', array( 
                     'view'=>$view,            
            )); 
            Yii::app()->getController()->endCache(); 
     }   
		
	}
		/*
	 获取帮助内容
   @param string $view  帮助分类的视图
	*/
	static function helpcontent($params=""){
		$sys_config=SysConfig::model();
		$sys_config_values=$sys_config->get_all_syscfg();
		$sfc_cache=$sys_config_values['sfc_cache'];
		$sfc_cache_time=$sys_config_values['sfc_cache_time'];
		$params=self::splite_params($params);
		$view=$params['view'];
		$cid=$params['cid'];
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
			$cacheid="helpcontent";
		}
				
		
	  if(Yii::app()->getController()->beginCache($cacheid, array('duration'=>$cache))){
            Yii::app()->getController()->widget('Whelpcontent', array( 
                     'view'=>$view,   
                     'cid'=>$cid,         
            )); 
            Yii::app()->getController()->endCache(); 
     }   
	}
	  /*
	 获取显示的图集
	 @param string $id      图集ID
   @param string $view    图集的视图

	*/
	static function galleryshow($params=""){
		$sys_config=SysConfig::model();
		$sys_config_values=$sys_config->get_all_syscfg();
		$sfc_cache=$sys_config_values['sfc_cache'];
		$sfc_cache_time=$sys_config_values['sfc_cache_time'];
		$params=self::splite_params($params);
		$id=$params['id'];
		$view=$params['view'];
		if(empty($view)){
			$view="index";
		}
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
			$cacheid="galleryshow";
		}
		 if(Yii::app()->getController()->beginCache($cacheid, array('duration'=>$cache))){
            Yii::app()->getController()->widget('Wgalleryshow', array( 
                    'id'=>$id,
           					'view'=>$view,        
            )); 
            Yii::app()->getController()->endCache(); 
     }   
	}
	
	
	  /*
	 获取下载列表
	 @param string $id    是否有验证码
   @param string $view    咨询的视图

	*/
	static function server($params=""){
		$params=self::splite_params($params);
		$id=$params['id'];
		$view=$params['view'];
		if(empty($view)){
			$view="index";
		}
    Yii::app()->getController()->widget('Wserver', array( 
           'id'=>$id,
           'view'=>$view,        
    )); 
	}

 /*
	 获取网站的模块
	 @param string $pattern 模块的模型
	 @param string $id   模块的ID号
	 @param string $sort 模块的文档的排序
	 @param string $sort_type 模块的排序方式
	 @param string $limit 模块的数量
	 @param string $attr  文档的属性
	 @param string $tlen  显示内容的数量
	 @param stirng $dott  是否显示...
	 @param string $dlen  简短描述的长度
	 @param string $size  图片的尺寸
	 @param string $cacheid 缓存ID号
	 @param string $cache 缓存时间
	 @param string $view 模块的样式的样式
	*/	
 static function 	interrelated($params=""){
		$sys_config=SysConfig::model();
		$sys_config_values=$sys_config->get_all_syscfg();
		$sfc_cache=$sys_config_values['sfc_cache'];
		$sfc_cache_time=$sys_config_values['sfc_cache_time'];
		$params=self::splite_params($params);
	 
	  $pattern=$params['pattern'];
    $id=$params['id'];
    $region_id=$params['region_id'];
		$view=$params['view'];
		$sort=$params['sort'];
		$sort_type=$params['sort_type'];
	  $limit=$params['limit'];
		$attr=$params['attr'];
		$tlen=$params['tlen'];
		$dott=$params['dott'];
		$dlen=$params['dlen'];
		$size=$params['size'];
		$cacheid=$params['cacheid'];
		$cache=$params['cache'];
		if(empty($view)){
			$view="index";
		}
		if($sfc_cache=="N"){
			$cache=0;
		}else{
			if(empty($cache)){
				$cache=$sfc_cache_time;
			}
		}
		if(empty($cacheid)){
			$cacheid="blocks";
		}


	  if(Yii::app()->getController()->beginCache($cacheid, array('duration'=>$cache))){
            Yii::app()->getController()->widget('Interrelated', array( 
               			 'pattern'=>$pattern,
                     'id'=>$id,
                     'region_id'=>$region_id,
                     'view'=>$view,
                     'sort'=>$sort,
                     'sort_type'=>$sort_type,
                     'limit'=>$limit,  
                     'attr'=>$attr,   
                     'tlen'=>$tlen,
                     'dott'=>$dott,
                     'dlen'=>$dlen, 
                     'size'=>$size,      
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
