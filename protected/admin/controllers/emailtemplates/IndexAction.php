<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
  	 
  	 $model=EmailTemplates::model();
  	  //��������������ϵ�array
	 $conditions=array();
	 $params=array();
	 $page_params=array();
	 
	   //�����������
		$templates_name=$_REQUEST['templates_name'];
		if(!empty($templates_name)){
		   array_push($conditions,"t.templates_name LIKE :templates_name");
		   $params[':templates_name']="%$templates_name%";
		   $page_params['templates_name']=$templates_name;
		}
		
		$type=$_REQUEST['type'];
		if(!empty($type)){
		   array_push($conditions,"t.type = :type");
		   $params[':type']=$type;
		   $page_params['type']=$type;
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
			    'with'=>array("User"),
			
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
