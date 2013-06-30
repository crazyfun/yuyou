<?php
class IndexAction extends BaseAction{
	  protected function beforeAction(){
        $this->controller->init_main_page();
        $sys_config=SysConfig::model();
		    $all_syscfg_values=$sys_config->get_all_syscfg();
        WebConfig::set_seo_content(array('seo_title'=>$all_syscfg_values['sfc_home_title']),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action(){
   	$cssPath=$this->controller->get_css_path();
    $jsPath=$this->controller->get_js_path();
		$action=$_REQUEST['action'];
		switch($action){
			case 'travel':
			  $config_values=ConfigValues::model();
    $travel_category=TravelCategory::model();
    $day_linetype_datas=$travel_category->get_category_datas(5);
    $day_linetype=array();
    foreach($day_linetype_datas as $key => $value){
    	$day_linetype[$value->category_id]=$value->category_name;
    }
    $teshe_linetype_datas=$travel_category->get_category_datas(32);
    $teshe_linetype=array();
    foreach($teshe_linetype_datas as $key => $value){
    	$teshe_linetype[$value->category_id]=$value->category_name;
    }
    $type_linetype_datas=$travel_category->get_category_datas(16);
    $type_linetype=array();
    foreach($type_linetype_datas as $key => $value){
    	$type_linetype[$value->category_id]=$value->category_name;
    }
    
     $theme_linetype_datas=$travel_category->get_category_datas(24);
    $theme_linetype=array();
    foreach($theme_linetype_datas as $key => $value){
    	$theme_linetype[$value->category_id]=$value->category_name;
    }
			  $model=Travel::model();
			  $search_datas=$this->search_travel();
			  $advanced_search=array(
			   'channel_id'=>array('name'=>'类型','items'=>array('131'=>'周边游','132'=>'国内游','133'=>'出境游','134'=>'团队游')),
			   'budget'=>array('name'=>'价格','items'=>$config_values->get_ralation_values("11")),
			   'day_linetype'=>array('name'=>'天数','items'=>$day_linetype),
			   'type_linetype'=>array('name'=>'方式','items'=>$type_linetype),
			   'theme_linetype'=>array('name'=>'主题','items'=>$theme_linetype),
			   'teshe_linetype'=>array('name'=>'特色','items'=>$teshe_linetype),
			  );
			  $advanced_sort=array('time_desc'=>'时间从高到低','time_asc'=>'时间从低到高','price_desc'=>'价格从高到低','price_asc'=>'价格从低到高');
			  $this->display('index',array('model'=>$model,'dataProvider'=>$search_datas['dataProvider'],'page_params'=>$search_datas['page_params'],'action'=>$action,'advanced_search'=>$advanced_search,'advanced_sort'=>$advanced_sort,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
			  break;
			  
			  case 'hotels':
        $hotels_brand=HotelsBrand::model();
        $hotels_brand_datas=$hotels_brand->get_options_brands();
			  $model=Hotels::model();
			  $search_datas=$this->search_hotels();
			  $advanced_search=array(
			   
			   'hotel_price_limit'=>array('name'=>'价格','items'=>CV::$HOTEL_PRICE_LIMIT),
			   'hotel_level'=>array('name'=>'星级','items'=>CV::$HOTELS_LEVEL),
			   'brand_id'=>array('name'=>'品牌','items'=>$hotels_brand_datas),
			   'facility'=>array('name'=>'设施','items'=>CV::$FACILITY),
			  );
			  $advanced_sort=array('time_desc'=>'时间从高到低','time_asc'=>'时间从低到高','price_desc'=>'价格从高到低','price_asc'=>'价格从低到高','buy_desc'=>'订单从高到低','buy_asc'=>'订单从低到高');
			  $this->display('hotels',array('model'=>$model,'dataProvider'=>$search_datas['dataProvider'],'page_params'=>$search_datas['page_params'],'action'=>$action,'advanced_search'=>$advanced_search,'advanced_sort'=>$advanced_sort,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
			  break;
			default:
			  break;
		}
 }
 
 
 
  public function search_travel(){
  	$region_id=$_REQUEST['region_id'];
  	$keywords=$_REQUEST['keywords'];
  	$channel_id=$_REQUEST['channel_id'];
  	$budget=$_REQUEST['budget'];
  	$day_linetype=$_REQUEST['day_linetype'];
  	$teshe_linetype=$_REQUEST['teshe_linetype'];
  	$type_linetype=$_REQUEST['type_linetype'];
  	$theme_linetype=$_REQUEST['theme_linetype'];
  	$advanced_sort=$_REQUEST['advanced_sort'];
  	$search_type=$_REQUEST['search_type'];
  	$search_condition=$_REQUEST['search_condition'];
  	$search_text=$_REQUEST['search_text'];
  	$line_type=$_REQUEST['line_type'];
  	$condition=array();
		$params=array();
		$page_params=array();
		
	
  	switch($search_type){
  		case 'region':
  		 	array_push($condition,"t.end_region=:end_region");
  		 	$params[':end_region']=$search_condition;
			  
  		  break;
  		case 'scenic':
  		  array_push($condition,"TravelArea.travel_area LIKE :search_text");
  		  $params[':search_text']='%'.$search_text.'%';
  		  break;
  		default:
  		  break;
  		
  	}
  	$page_params['search_condition']=$search_condition;
  	$page_params['search_text']=$search_text;
  	$search_type['search_type']=$search_type;
  	if(!empty($keywords)){
  		array_push($condition,'(t.title LIKE :keywords OR t.scontent LIKE :keywords)');
			$params[':keywords']="%".$keywords."%";
			$page_params['keywords']=$keywords;
  	}
  	
  	if(!empty($region_id)){
  		array_push($condition,'t.start_region = :start_region');
			$params[':start_region']=$region_id;
			$page_params['region_id']=$region_id;
  	}
  	
  	if(!empty($channel_id)){
  		array_push($condition,'t.channel_id = :channel_id');
			$params[':channel_id']=$channel_id;
			$page_params['channel_id']=$channel_id;
  	}
  	
  	if(!empty($budget)){
  		array_push($condition,'t.budget = :budget');
			$params[':budget']=$budget;
			$page_params['budget']=$budget;
  	}
  	if(!empty($line_type)){
  		array_push($condition,"FIND_IN_SET('".$line_type."',t.linetype)>0");
			$page_params['line_type']=$line_type;
  	}
  	if(!empty($day_linetype)){
  		array_push($condition,"FIND_IN_SET('".$day_linetype."',t.linetype)>0");
			$page_params['day_linetype']=$day_linetype;
  	}
  	
  	if(!empty($teshe_linetype)){
  		array_push($condition,"FIND_IN_SET('".$teshe_linetype."',t.linetype)>0");
			$page_params['teshe_linetype']=$teshe_linetype;
  	}
  	
  	if(!empty($type_linetype)){
  		array_push($condition,"FIND_IN_SET('".$type_linetype."',t.linetype)>0");
			$page_params['type_linetype']=$type_linetype;
  	}
  	
  	if(!empty($theme_linetype)){
  		array_push($condition,"FIND_IN_SET('".$theme_linetype."',t.linetype)>0");
			$page_params['theme_linetype']=$theme_linetype;
  	}
  	
  	
  	$order_sort="";
  	if(!empty($advanced_sort)){
  		switch($advanced_sort){
  			case 'price_desc':
  			  $order_sort="price DESC";
  			  break;
  			case 'price_asc':
  			  $order_sort="price ASC";
  			  break;
  			case 'buy_desc':
  			  $order_sort="t.buy_numbers DESC";
  			  break;
  			case 'buy_asc':
  			  $order_sort="t.buy_numbers ASC";
  			  break;
  			case 'time_desc':
  			  $order_sort="t.create_time DESC";
  			  break;
  			case 'time_asc':
  			  $order_sort="t.create_time ASC";
  			  break;
  			default:
  			  $order_sort="t.create_time DESC";
  			  break;
  			
  		}
  	}else{
  		$order_sort="t.create_time DESC";
  	}
  	$page_params['advanced_sort']=$advanced_sort;
		array_push($condition,'t.status = :status');
	  $params[':status']='2';
  	//定义排序类
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder=$order_sort;
  	$sort->params=$page_params;
  	$model=new Travel();
  	$page_params['action']=$_REQUEST['action'];
  	//生成ActiveDataProvider对象
  	$dataProvider=new CActiveDataProvider($model, array(
				'criteria'=>array(
				'select'=>'t.*,MIN(TravelDate.adult_price) as price',
			  'condition'=>implode(' AND ',$condition),
			  'params'=>$params,
			  'with'=>array('Channels','EndRegion','StartRegion','TravelDate'=>array('group'=>'TravelDate.travel_id'),'TravelArea'),
			  'together'=>true,
			  'group'=>'t.id',
		    ),
				'pagination'=>array(
          		'pageSize' => '20',
          		'params' => $page_params,
      	),
      	'sort'=>$sort,
		));
	  				
		return array('dataProvider'=>$dataProvider,'page_params'=>$page_params);				
  
   }
   
   
   
   public function search_hotels(){
  	$hotel_region=$_REQUEST['hotel_region'];
  	$title=$_REQUEST['title'];
  	$hotel_address=$_REQUEST['hotel_address'];
  	$hotel_price_limit=$_REQUEST['hotel_price_limit'];
  	$hotel_level=$_REQUEST['hotel_level'];
  	$brand_id=$_REQUEST['brand_id'];
  	$facility=$_REQUEST['facility'];
  	$advanced_sort=$_REQUEST['advanced_sort'];
  	$start_date=$_REQUEST['start_date'];
  	$end_date=$_REQUEST['end_date'];
  	$start_date=empty($start_data)?date("Y-m-d"):$start_date;
    $end_date=empty($end_date)?(date("Y-m-d",mktime(0, 0, 0, date("m"),date("d")+1, date("Y")))):$end_date;
  	     		 
  	$condition=array();
		$params=array();
		$page_params=array();
		
	  if(!empty($start_date)){
	  	$page_params['start_date']=$start_date;
	  }
	  if(!empty($end_date)){
	  	$page_params['end_date']=$end_date;
	  }

  	if(!empty($title)){
  		array_push($condition,'(t.title LIKE :title OR t.scontent LIKE :title)');
			$params[':title']="%".$title."%";
			$page_params['title']=$title;
  	}
  	
  	if(!empty($hotel_address)){
  		array_push($condition,'(t.hotel_address LIKE :hotel_address )');
			$params[':hotel_address']="%".$hotel_address."%";
			$page_params['hotel_address']=$hotel_address;
  	}
  	
  	
  	
  	if(!empty($hotel_region)){
  		array_push($condition,'t.hotel_region = :hotel_region');
			$params[':hotel_region']=$hotel_region;
			$page_params['hotel_region']=$hotel_region;
			$page_params['hotel_region_text']=$_REQUEST['hotel_region_text'];
			
  	}
  	
  	if(!empty($hotel_price_limit)){
  		array_push($condition,'t.hotel_price_limit = :hotel_price_limit');
			$params[':hotel_price_limit']=$hotel_price_limit;
			$page_params['hotel_price_limit']=$hotel_price_limit;
  	}
  	
  	if(!empty($hotel_level)){
  		array_push($condition,'t.hotel_level = :hotel_level');
			$params[':hotel_level']=$hotel_level;
			$page_params['hotel_level']=$hotel_level;
  	}
  	if(!empty($facility)){
  		array_push($condition,"FIND_IN_SET('".$facility."',t.facility)>0");
			$page_params['facility']=$facility;
  	}
  	
  	if(!empty($brand_id)){
  		array_push($condition,'t.brand_id = :brand_id');
			$params[':brand_id']=$brand_id;
			$page_params['brand_id']=$brand_id;
  	}
  
  
  	
  	
  	$order_sort="";
  	if(!empty($advanced_sort)){
  		switch($advanced_sort){
  			case 'price_desc':
  			  $order_sort="price DESC";
  			  break;
  			case 'price_asc':
  			  $order_sort="price ASC";
  			  break;

  			case 'time_desc':
  			  $order_sort="t.create_time DESC";
  			  break;
  			case 'time_asc':
  			  $order_sort="t.create_time ASC";
  			  break;
  			default:
  			  $order_sort="t.create_time DESC";
  			  break;
  			
  		}
  	}else{
  		$order_sort="t.create_time DESC";
  	}
  	$page_params['advanced_sort']=$advanced_sort;
		array_push($condition,'t.status = :status');
	  $params[':status']='2';
  	//定义排序类
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder=$order_sort;
  	$sort->params=$page_params;
  	$model=new Hotels();
  	$page_params['action']=$_REQUEST['action'];
  	//生成ActiveDataProvider对象
  	$dataProvider=new CActiveDataProvider($model, array(
				'criteria'=>array(
				'select'=>'t.*,MIN(HotelsPrice.price) as price',
			  'condition'=>implode(' AND ',$condition),
			  'params'=>$params,
			  'with'=>array('Channels','ChannelCategory','Company','HotelsBeds'=>array('group'=>'HotelsBeds.hotels_id'),'HotelRegion','HotelsBrand','HotelsArea','HotelsImages','HotelsTran','HotelsPrice'),
			  'together'=>true,
			  'group'=>'t.id',
		    ),
				'pagination'=>array(
          		'pageSize' => '20',
          		'params' => $page_params,
      	),
      	'sort'=>$sort,
		));
	  				
		return array('dataProvider'=>$dataProvider,'page_params'=>$page_params);				
  
   }
   
   
   

}
?>