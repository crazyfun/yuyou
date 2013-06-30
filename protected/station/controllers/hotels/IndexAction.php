<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){

   $model=Hotels::model();
  	  //定义搜索条件组合的array
	 $conditions=array();
	 $params=array();
	 $page_params=array();

	   //组合搜索条件
		$keyword=$_REQUEST['keyword'];
		if(!empty($keyword)){
		   array_push($conditions,"(t.title LIKE :keyword OR t.content LIKE :keyword OR t.number LIKE :keyword  )");
		   $params[':keyword']="%$keyword%";
		   $page_params['keyword']=$keyword;
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
		$hotel_region=$_REQUEST['hotel_region'];
		if(!empty($hotel_region)){
			 array_push($conditions,"t.hotel_region =:hotel_region");
		   $params[':hotel_region']=$hotel_region;
		   $page_params['hotel_region']=$hotel_region;
		   $region=Region::model();
		   $region_data=$region->findByPk($hotel_region);
		   $page_params['hotel_region_text']=$region_data->region_name;
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
	  array_push($conditions,"t.company_id = :company_id");
		 $params[':company_id']=$this->controller->company_id;
	 //定义排序类
	 $sort=new CSort();
  	 $sort->attributes=array();
  	 $sort->defaultOrder="t.channel_id ASC,t.status ASC";
  	 $sort->params=$page_params;
  	 //生成ActiveDataProvider对象
	 $criteria=new CDbCriteria;
	 $dataProvider=new CActiveDataProvider($model, array(
		'criteria'=>array(
			'condition'=>implode(' AND ',$conditions),
			'params'=>$params,
			'with'=>array("User","Channels","ChannelCategory","Company",'HotelRegion','HotelsBrand','HotelsBeds','HotelsArea','HotelsImages','HotelsTran'),
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
