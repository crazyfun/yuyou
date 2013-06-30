<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
   $model=TravelAddress::model();
  	  //定义搜索条件组合的array
	 $conditions=array();
	 $params=array();
	 $page_params=array();
	   //组合搜索条件
		$address_id=$_REQUEST['address_id'];
		if(!empty($address_id)){
		   array_push($conditions,"CompanyAddress.address LIKE :address_id");
		   $params[':address_id']="%$address_id%";
		   $page_params['address_id']=$address_id;
		}
		$travel_id=$_REQUEST['travel_id'];
	  array_push($conditions,"t.travel_id = :travel_id");
		$params[':travel_id']=$travel_id;
		$page_params['travel_id']=$travel_id;
		   
	 //定义排序类
	 $sort=new CSort();
  	 $sort->attributes=array();
  	 $sort->defaultOrder="t.id ASC";
  	 $sort->params=$page_params;
  	 //生成ActiveDataProvider对象
	 $criteria=new CDbCriteria;
	 $dataProvider=new CActiveDataProvider($model, array(
		'criteria'=>array(
			'condition'=>implode(' AND ',$conditions),
			'params'=>$params,
			'with'=>array("Travel","CompanyAddress"),
			'together'=>true,
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
