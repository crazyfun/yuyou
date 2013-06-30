<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
  	 
  	 $model=EmailTemplates::model();
  	  //定义搜索条件组合的array
	 $conditions=array();
	 $params=array();
	 $page_params=array();
	 
	   //组合搜索条件
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
	 
		   
		 //定义排序类
	 $sort=new CSort();
  	 $sort->attributes=array();
  	 $sort->defaultOrder="t.create_time ASC";
  	 $sort->params=$page_params;
  	 //生成ActiveDataProvider对象
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
