<?php
class WelcomeAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_page();
        return true;
    }
   protected function do_action(){
   
   	$config_values=ConfigValues::model();
    $travel_category=TravelCategory::model();
		$action=$_REQUEST['action'];
		if(empty($action)){
			$action="travel";
		}
		switch($action){
			case 'travel':
			  $model=Travel::model();
        $ip_convert=IpConvert::get();
			  $search_datas=$this->search_travel();
			  $advanced_search=array(
			   'channel_id'=>array('name'=>'类型','items'=>array('131'=>'周边游','132'=>'国内游','133'=>'出境游','134'=>'团队游')),
			   'budget'=>array('name'=>'价格','items'=>$config_values->get_ralation_values("11")),
			  
			  );
			  $advanced_sort=array('time_desc'=>'时间从高到低','time_asc'=>'时间从低到高','price_desc'=>'价格从高到低','price_asc'=>'价格从低到高','buy_desc'=>'订单从高到低','buy_asc'=>'订单从低到高');
			  $this->display('welcome',array('model'=>$model,'dataProvider'=>$search_datas['dataProvider'],'page_params'=>$search_datas['page_params'],'action'=>$action,'advanced_search'=>$advanced_search,'advanced_sort'=>$advanced_sort,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
			  break;
			default:
			  break;
		}
			
  }
 
  public function search_travel(){

  	$region_id=$_REQUEST['region_id'];
    $start_date=$_REQUEST['start_date'];
  	$keywords=$_REQUEST['keywords'];
  	$channel_id=$_REQUEST['channel_id'];
  	$budget=$_REQUEST['budget'];
  	$advanced_sort=$_REQUEST['advanced_sort'];
  	$search_type=$_REQUEST['search_type'];
  	$search_condition=$_REQUEST['search_condition'];
  	$search_text=$_REQUEST['search_text'];
  	$line_type=$_REQUEST['line_type'];
  	$condition=array();
		$params=array();
		$page_params=array();
   if(!empty($search_condition)){
  		array_push($condition,"t.end_region=:end_region");
  		$params[':end_region']=$search_condition;
  		$page_params['search_condition']=$search_condition;
  		$page_params['search_text']=$search_text;
  		$search_type['search_type']=$search_type;
  	}
  
  	if(!empty($keywords)){
  		array_push($condition,'(t.title LIKE :keywords OR t.scontent LIKE :keywords)');
			$params[':keywords']="%".$keywords."%";
			$page_params['keywords']=$keywords;
  	}
  	
  	$company_name=$_REQUEST['company_name'];
  	if(!empty($company_name)){
  		array_push($condition,'(Company.company_name LIKE :company_name )');
			$params[':company_name']="%".$company_name."%";
			$page_params['company_name']=$company_name;
  	}
  	
  	
  	$travel_area=$_REQUEST['travel_area'];
  	if(!empty($travel_area)){
  		array_push($condition,'(TravelArea.travel_area LIKE :travel_area )');
			$params[':travel_area']="%".$travel_area."%";
			$page_params['travel_area']=$travel_area;
  	}
  	
  	
  	if(!empty($keywords)){
  		array_push($condition,'(t.title LIKE :keywords OR t.scontent LIKE :keywords)');
			$params[':keywords']="%".$keywords."%";
			$page_params['keywords']=$keywords;
  	}
  	
  	if(!empty($region_id)){
  		array_push($condition,'t.start_region = :start_region');
			$params[':start_region']=$region_id;
			$page_params['region_id']=$region_id;
  	  $page_params['region_id_text']=$_REQUEST['region_id_text'];
  	  $search_type['region_id_type']=$_REQUEST['region_id_type'];
  	
  	
  	}
  	
  	if(!empty($channel_id)){
  		array_push($condition,'t.channel_id = :channel_id');
			$params[':channel_id']=$channel_id;
			$page_params['channel_id']=$channel_id;
  	}
  	
  	if(!empty($start_date)){
  		array_push($condition,'(TravelDate.travel_date >= :start_date) OR (TravelDate.type_value1<=:start_date AND TravelDate.type_value2>=:start_date)');
			$params[':start_date']=$start_date;
			$page_params['start_date']=$start_date;
  	}
  	
  	if(!empty($budget)){
  		array_push($condition,'t.budget = :budget');
			$params[':budget']=$budget;
			$page_params['budget']=$budget;
  	}
  	if(!empty($line_type)){
  		array_push($condition,"FIND_IN_SET('".$line_type."',t.linetype)>0");
			$page_params['line_type']=$line_type;
			$page_params['line_type_text']=$_REQUEST['line_type_text'];
  	  $search_type['line_type_type']=$_REQUEST['line_type_type'];
  	
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
	  
	  $company_id=$this->controller->company_id;
	  $company=Company::model();
	  $company_data=$company->findByPk($company_id);
	  if($company_data->company_type=="2"){
	  	 
		   array_push($condition,'t.company_id = :company_id');
	     $params[':company_id']=$company_data->id;
	  }
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder=$order_sort;
  	$sort->params=$page_params;
  	$model=new Travel();
  	$page_params['action']='travel';

  	$dataProvider=new CActiveDataProvider($model, array(
				'criteria'=>array(
				'select'=>'t.*,MIN(TravelDate.adult_price) as price',
			  'condition'=>implode(' AND ',$condition),
			  'params'=>$params,
			  'with'=>array('Company','Channels','EndRegion','StartRegion','TravelDate'=>array('group'=>'TravelDate.travel_id'),'TravelArea'),
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