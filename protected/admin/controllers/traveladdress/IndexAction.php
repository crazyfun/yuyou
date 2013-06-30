<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
   $model=TravelAddress::model();
  	  //��������������ϵ�array
	 $conditions=array();
	 $params=array();
	 $page_params=array();
	   //�����������
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
		   
	 //����������
	 $sort=new CSort();
  	 $sort->attributes=array();
  	 $sort->defaultOrder="t.id ASC";
  	 $sort->params=$page_params;
  	 //����ActiveDataProvider����
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
