<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
  	 $model=Friendlink::model();
  	  //定义搜索条件组合的array
	 $conditions=array();
	 $params=array();
	 $page_params=array();
	 
	   //组合搜索条件
		$friendlink_name=$_REQUEST['friendlink_name'];
		if(!empty($friendlink_name)){
		   array_push($conditions,"t.friendlink_name LIKE :friendlink_name");
		   $params[':friendlink_name']="%$friendlink_name%";
		   $page_params['friendlink_name']=$friendlink_name;
		}

		$friendlink_href=$_REQUEST['friendlink_href'];
		if(!empty($friendlink_href)){
			array_push($conditions,"t.friendlink_href LIKE :friendlink_href");
			$params[':friendlink_href']="%$friendlink_href%";
			$page_params['friendlink_href']=$friendlink_href;
		}

		$friendlink_type=$_REQUEST['friendlink_type'];
		if(!empty($friendlink_type)){
			array_push($conditions,"t.friendlink_type = :friendlink_type");
			$params[':friendlink_type']=$friendlink_type;
			$page_params['friendlink_type']=$friendlink_type;
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
