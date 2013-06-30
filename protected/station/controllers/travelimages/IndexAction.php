<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
   $model=TravelImages::model();
  	  //��������������ϵ�array
	 $conditions=array();
	 $params=array();
	 $page_params=array();
	 //�����������
		$travel_area=$_REQUEST['travel_area'];
		if(!empty($travel_area)){
		   array_push($conditions,"t.travel_area_id = :travel_area");
		   $params[':travel_area']=$travel_area;
		   $page_params['travel_area']=$travel_area;
		}
		
	 $travel_id=$_REQUEST['travel_id'];
	 array_push($conditions,"t.travel_id=:travel_id");
	 $params[':travel_id']=$travel_id;
	 $page_params['travel_id']=$travel_id;
	 
	 //����������
	 $sort=new CSort();
   $sort->attributes=array();
   $sort->defaultOrder="t.create_time ASC";
   $sort->params=$page_params;
  	 //����ActiveDataProvider����
	 $criteria=new CDbCriteria;
	 $dataProvider=new CActiveDataProvider($model, array(
		'criteria'=>array(
			'condition'=>implode(' AND ',$conditions),
			'params'=>$params,
			'with'=>array("User","Travel","TravelArea","Images"),
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
