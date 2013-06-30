<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
   $model=HotelsImages::model();
  	  //��������������ϵ�array
	 $conditions=array();
	 $params=array();
	 $page_params=array();
	 $hotels_id=$_REQUEST['hotels_id'];
	 array_push($conditions,"t.hotels_id=:hotels_id");
	 $params[':hotels_id']=$hotels_id;
	 $page_params['hotels_id']=$hotels_id;
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
			'with'=>array("User","Hotels","Images"),
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
