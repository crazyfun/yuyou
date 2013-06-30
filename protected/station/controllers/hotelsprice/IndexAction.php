<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
   $model=HotelsPrice::model();
  	  //��������������ϵ�array
	 $conditions=array();
	 $params=array();
	 $page_params=array();
	 
	 

		$bed_id=$_REQUEST['bed_id'];
	  array_push($conditions,"t.bed_id = :bed_id");
		$params[':bed_id']=$bed_id;
		$page_params['bed_id']=$bed_id;
		   
	 //����������
	 $sort=new CSort();
  	 $sort->attributes=array();
  	 $sort->defaultOrder="t.id DESC";
  	 $sort->params=$page_params;
  	 //����ActiveDataProvider����
	 $criteria=new CDbCriteria;
	 $dataProvider=new CActiveDataProvider($model, array(
		'criteria'=>array(
			'condition'=>implode(' AND ',$conditions),
			'params'=>$params,
			'with'=>array("Hotels",'HotelsBeds'),
		),
		'pagination'=>array(
			'pageSize' => '20',
			'params' => $page_params,
		),
		'sort'=>$sort,
	 ));
	 
	 $this->display('index',array('model'=>$model,'page_params'=>$page_params,'dataProvider'=>$dataProvider,'bed_id'=>$bed_id));
  } 
}
?>
