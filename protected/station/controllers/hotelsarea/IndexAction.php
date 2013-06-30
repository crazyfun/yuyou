<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
   $model=HotelsArea::model();
  	  //定义搜索条件组合的array
	 $conditions=array();
	 $params=array();
	 $page_params=array();
	 
	   //组合搜索条件
		$area_name=$_REQUEST['area_name'];
		if(!empty($area_name)){
		   array_push($conditions,"t.area_name LIKE :area_name");
		   $params[':area_name']="%$area_name%";
		   $page_params['area_name']=$area_name;
		}


		$hotels_id=$_REQUEST['hotels_id'];
	  array_push($conditions,"t.hotels_id = :hotels_id");
		$params[':hotels_id']=$hotels_id;
		$page_params['hotels_id']=$hotels_id;
		   
	 //定义排序类
	 $sort=new CSort();
  	 $sort->attributes=array();
  	 $sort->defaultOrder="t.sort_order ASC";
  	 $sort->params=$page_params;
  	 //生成ActiveDataProvider对象
	 $criteria=new CDbCriteria;
	 $dataProvider=new CActiveDataProvider($model, array(
		'criteria'=>array(
			'condition'=>implode(' AND ',$conditions),
			'params'=>$params,
			'with'=>array("Hotels"),
		),
		'pagination'=>array(
			'pageSize' => '20',
			'params' => $page_params,
		),
		'sort'=>$sort,
	 ));
	 
	 $this->display('index',array('model'=>$model,'page_params'=>$page_params,'dataProvider'=>$dataProvider,'hotels_id'=>$hotels_id));
  } 
}
?>
