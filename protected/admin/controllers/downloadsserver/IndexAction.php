<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
   $model=Downloadsserver::model();
  	  //��������������ϵ�array
	 $conditions=array();
	 $params=array();
	 $page_params=array();
	   //�����������
		$server_name=$_REQUEST['server_name'];
		if(!empty($server_name)){
		   array_push($conditions,"t.server_name LIKE :server_name");
		   $params[':server_name']="%$server_name%";
		   $page_params['server_name']=$server_name;
		}
		$downloads_id=$_REQUEST['downloads_id'];
	  array_push($conditions,"t.downloads_id = :downloads_id");
		$params[':downloads_id']=$downloads_id;
		$page_params['downloads_id']=$downloads_id;  
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
			'with'=>array("User","Downloads"),
		),
		'pagination'=>array(
			'pageSize' => '20',
			'params' => $page_params,
		),
		'sort'=>$sort,
	 ));
	 $this->display('index',array('model'=>$model,'page_params'=>$page_params,'dataProvider'=>$dataProvider,'downloads_id'=>$downloads_id));
  } 
}
?>
