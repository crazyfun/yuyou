<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
  
   $model=Group::model();
  	  //定义搜索条件组合的array
	 $conditions=array();
	 $params=array();
	 $page_params=array();

	   //组合搜索条件
		$keyword=$_REQUEST['keyword'];
		if(!empty($keyword)){
		   array_push($conditions,"(t.title LIKE :keyword OR t.content LIKE :keyword )");
		   $params[':keyword']="%$keyword%";
		   $page_params['keyword']=$keyword;
		}
		
		
		  //组合搜索条件
		$region_id=$_REQUEST['region_id'];
		if(!empty($region_id)){
		   array_push($conditions,"t.region_id =:region_id");
		   $params[':region_id']=$region_id;
		   $page_params['region_id']=$region_id;
		   $page_params['region_id_text']=$_REQUEST['region_id_text'];
		}
		
		
		
			
		  //组合搜索条件
		$end_region_id=$_REQUEST['end_region_id'];
		if(!empty($end_region_id)){
		   array_push($conditions,"t.end_region_id =:end_region_id");
		   $params[':end_region_id']=$end_region_id;
		   $page_params['end_region_id']=$end_region_id;
		   $page_params['end_region_id_text']=$_REQUEST['end_region_id_text'];
		}
		
		  //组合搜索条件
		$company_name=$_REQUEST['company_name'];
		if(!empty($company_name)){
		   array_push($conditions,"Company.company_name LIKE :company_name");
		   $params[':company_name']="%$company_name%";
		   $page_params['company_name']=$company_name;
		}
		
		
		  //组合搜索条件
		$start_date=$_REQUEST['start_date'];
		if(!empty($start_date)){
		   array_push($conditions,"t.start_time >= :start_date ");
		   $params[':start_date']=$start_date;
		   $page_params['start_date']=$start_date;
		}
		
		  //组合搜索条件
		$end_date=$_REQUEST['end_date'];
		if(!empty($end_date)){
		   array_push($conditions,"t.end_time <= :end_date");
		   $params[':end_date']=$end_date;
		   $page_params['end_date']=$end_date;
		}

		 //组合搜索条件
		$channel_id=$_REQUEST['channel_id'];
		if(!empty($channel_id)){
			 $channels=Channels::model();
			 $channel_datas=$channels->get_descendant($channel_id);
		   array_push($conditions,"t.channel_id ".Util::db_create_in($channel_datas));
		   $page_params['channel_id']=$channel_id;
		}

		 //组合搜索条件
		$category_id=$_REQUEST['category_id'];
		if(!empty($category_id)){
			 $channel_category=ChannelCategory::model();
			 $child_datas=$channel_category->get_descendant($category_id);
		   array_push($conditions,"t.category_id ".Util::db_create_in($child_datas));
		   $page_params['category_id']=$category_id;
		}
		
		 //组合搜索条件
		$attr=$_REQUEST['attr'];
		if(!empty($attr)){
		   array_push($conditions,"FIND_IN_SET('".$attr."',t.attr)>0");
		   $page_params['attr']=$attr;
		}
		
		 //组合搜索条件
		$status=$_REQUEST['status'];
		if(!empty($status)){
		   array_push($conditions,"t.status =:status");
		   $params[':status']=$status;
		   $page_params['status']=$status;
		}else{
			 array_push($conditions,"t.status <> :status");
		   $params[':status']='3';
		}
	  	 //组合搜索条件
		$open=$_REQUEST['open'];
		if(!empty($open)){
		   array_push($conditions,"t.open =:open");
		   $params[':open']=$open;
		   $page_params['open']=$open;
		}
	  
	 //定义排序类
	 $sort=new CSort();
  	 $sort->attributes=array();
  	 $sort->defaultOrder="t.channel_id ASC,t.create_time DESC";
  	 $sort->params=$page_params;
  	 //生成ActiveDataProvider对象
	 $criteria=new CDbCriteria;
	 $dataProvider=new CActiveDataProvider($model, array(
		'criteria'=>array(
			'condition'=>implode(' AND ',$conditions),
			'params'=>$params,
			'with'=>array("User","Channels","ChannelCategory","Company"),
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
