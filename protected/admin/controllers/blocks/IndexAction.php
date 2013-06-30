<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
   $model=Blocks::model();
  	  //定义搜索条件组合的array
	 $conditions=array();
	 $params=array();
	 $page_params=array();
	   //组合搜索条件
	   
	   
	   $pattern=$_REQUEST['pattern'];
		if(!empty($pattern)){
		   array_push($conditions,"t.pattern = :pattern");
		   $params[':pattern']=$pattern;
		   $page_params['pattern']=$pattern;
		}
		
		
		$name=$_REQUEST['name'];
		if(!empty($name)){
		   array_push($conditions,"t.name LIKE :name");
		   $params[':name']="%$name%";
		   $page_params['name']=$name;
		}
		
		$identification=$_REQUEST['identification'];
		if(!empty($identification)){
		   array_push($conditions,"t.identification LIKE :identification");
		   $params[':identification']="%$identification%";
		   $page_params['identification']=$identification;
		}
		
		$view=$_REQUEST['view'];
		if(!empty($view)){
		   array_push($conditions,"t.view = :view");
		   $params[':view']=$view;
		   $page_params['view']=$view;
		}
		
		$sort=$_REQUEST['sort'];
		if(!empty($sort)){
		   array_push($conditions,"t.sort = :sort");
		   $params[':sort']=$sort;
		   $page_params['sort']=$sort;
		}

	  //定义排序类
	  $sort=new CSort();
  	 $sort->attributes=array();
  	 $sort->defaultOrder="t.id DESC";
  	 $sort->params=$page_params;
  	 //生成ActiveDataProvider对象
	 $criteria=new CDbCriteria;
	 $dataProvider=new CActiveDataProvider($model, array(
		'criteria'=>array(
			'condition'=>implode(' AND ',$conditions),
			'params'=>$params,
			'with'=>array(),
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
