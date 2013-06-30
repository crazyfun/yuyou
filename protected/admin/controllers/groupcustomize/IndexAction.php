<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
   $model=GroupCustomize::model();
  	  //定义搜索条件组合的array
	 $conditions=array();
	 $params=array();
	 $page_params=array();
	   //组合搜索条件
		$contact_name=$_REQUEST['contact_name'];
		if(!empty($contact_name)){
		   array_push($conditions,"t.contact_name LIKE :contact_name");
		   $params[':contact_name']="%$contact_name%";
		   $page_params['contact_name']=$contact_name;
		}	
	$company_name=$_REQUEST['company_name'];
		if(!empty($company_name)){
		   array_push($conditions,"t.company_name LIKE :company_name");
		   $params[':company_name']="%$company_name%";
		   $page_params['company_name']=$company_name;
		}	
		$reply_time=$_REQUEST['reply_time'];
		if(!empty($reply_time)){
		   array_push($conditions,"t.reply_time = :reply_time");
		   $params[':reply_time']=$reply_time;
		   $page_params['reply_time']=$reply_time;
		}	
		
		$start_region=$_REQUEST['start_region'];
		if(!empty($start_region)){
		   array_push($conditions,"t.start_region = :start_region");
		   $params[':start_region']=$start_region;
		   $page_params['start_region']=$start_region;
		   $region=Region::model();
		   $region_data=$region->findByPk($start_region);
		   $page_params['start_region_text']=$region_data->region_name;
		}
		
		$end_region=$_REQUEST['end_region'];
		if(!empty($end_region)){
		   array_push($conditions,"t.end_region = :end_region");
		   $params[':end_region']=$end_region;
		   $page_params['end_region']=$end_region;
		   $region=Region::model();
		   $region_data=$region->findByPk($end_region);
		   $page_params['end_region_text']=$region_data->region_name;
		}		
		
		$status=$_REQUEST['status'];
		if(!empty($status)){
		   array_push($conditions,"t.status = :status");
		   $params[':status']=$status;
		   $page_params['status']=$status;
		}
		
		$search_start_time=$_REQUEST['search_start_time'];
		if(!empty($search_start_time)){
		   array_push($conditions,"t.start_time>='$search_start_time'");
		   $page_params['search_start_time']=$search_start_time;
		}
		
		$search_end_time=$_REQUEST['search_end_time'];
		if(!empty($search_end_time)){
		   array_push($conditions,"t.start_time<='$search_end_time'");
		   $page_params['search_end_time']=$search_end_time;
		}
		
	
	 //定义排序类
	 $sort=new CSort();
   $sort->attributes=array();
   $sort->defaultOrder="t.create_time DESC";
   $sort->params=$page_params;
  	 //生成ActiveDataProvider对象
	 $criteria=new CDbCriteria;
	 $dataProvider=new CActiveDataProvider($model, array(
		'criteria'=>array(
			'condition'=>implode(' AND ',$conditions),
			'params'=>$params,
			'with'=>array(),
		),
		'pagination'=>array(
			'pageSize' => '20',
			'params' => $page_params,
		),
		'sort'=>$sort,
	 ));
	 
	 $this->display('index',array('model'=>$model,'page_params'=>$page_params,'dataProvider'=>$dataProvider));
  } 
}
?>
