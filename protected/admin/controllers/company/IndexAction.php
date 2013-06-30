<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
   $model=Company::model();
  	  //定义搜索条件组合的array
	 $conditions=array();
	 $params=array();
	 $page_params=array();
	 
	   //组合搜索条件
		$company_name=$_REQUEST['company_name'];
		if(!empty($company_name)){
		   array_push($conditions,"t.company_name LIKE :company_name");
		   $params[':company_name']="%$company_name%";
		   $page_params['company_name']=$company_name;
		}	
		
	
		$company_type=$_REQUEST['company_type'];
		if(!empty($company_type)){
		   array_push($conditions,"t.company_type = :company_type");
		   $params[':company_type']=$company_type;
		   $page_params['company_type']=$company_type;
		}	
		
		$region_id=$_REQUEST['region_id'];
		if(!empty($region_id)){
		   array_push($conditions,"t.region_id = :region_id");
		   $params[':region_id']=$region_id;
		   $page_params['region_id']=$region_id;
		   $region=Region::model();
		   $region_data=$region->findByPk($region_id);
		   $page_params['region_text']=$region_data->region_name;
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
		   array_push($conditions,"t.end_time<='$search_end_time'");
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
