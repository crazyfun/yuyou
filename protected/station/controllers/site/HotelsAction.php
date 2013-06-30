<?php
class HotelsAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_page();
        return true;
    }
   protected function do_action(){
		$action=$_REQUEST['action'];
		if(empty($action)){
			$action="hotels";
		}
		switch($action){
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
			  $this->display('hotels',array('model'=>$model,'dataProvider'=>$search_datas['dataProvider'],'page_params'=>$search_datas['page_params'],'action'=>$action,'advanced_search'=>$advanced_search,'advanced_sort'=>$advanced_sort));
			  break;
			default:
			  break;
		}
			
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