<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
   $model=TravelDate::model();
  	  //定义搜索条件组合的array
	 $conditions=array();
	 $params=array();
	 $page_params=array();

	   //组合搜索条件
		$travel_date=$_REQUEST['travel_date'];
		if(!empty($travel_date)){
		   array_push($conditions,"t.travel_date LIKE :travel_date");
		   $params[':travel_date']="%$travel_date%";
		   $page_params['travel_date']=$travel_date;
		}

		 //组合搜索条件
		$date_type=$_REQUEST['date_type'];
		if(!empty($date_type)){
		   array_push($conditions,"t.date_type=:date_type");
		   $params[':date_type']=$date_type;
		   $page_params['date_type']=$date_type;
		}
		
		$travel_id=$_REQUEST['travel_id'];
		array_push($conditions,"t.travel_id=:travel_id");
		$params[':travel_id']=$travel_id;
		$page_params['travel_id']=$travel_id;
	 
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
			'with'=>array("User","Travel"),
		),
		'pagination'=>array(
			'pageSize' => '20',
			'params' => $page_params,
		),
		'sort'=>$sort,
	 ));
	 $this->display('index',array('model'=>$model,'page_params'=>$page_params,'dataProvider'=>$dataProvider,'travel_id'=>$travel_id));
  } 
}
?>
