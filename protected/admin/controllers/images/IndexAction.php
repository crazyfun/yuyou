<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
   $model=Images::model();
  	  //��������������ϵ�array
	 $conditions=array();
	 $params=array();
	 $page_params=array();
	   //�����������
		$name=$_REQUEST['name'];
		if(!empty($name)){
		   array_push($conditions,"t.name LIKE :name");
		   $params[':name']="%$name%";
		   $page_params['name']=$name; 
		}
		$category_id=$_REQUEST['category_id'];
		if(!empty($category_id)){
		   array_push($conditions,"t.category_id = :category_id");
		   $params[':category_id']=$category_id;
		   $page_params['category_id']=$category_id;
		}
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
			'with'=>array("ImagesCategory","User"),
		),
		'pagination'=>array(
			'pageSize' => '60',
			'params' => $page_params,
		),
		'sort'=>$sort,
	 ));
	 $this->display('index',array('model'=>$model,'page_params'=>$page_params,'dataProvider'=>$dataProvider));
  } 
}
?>
