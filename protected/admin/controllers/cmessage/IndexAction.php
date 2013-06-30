<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
   
   $model=ContacterMessage::model();
  	  //定义搜索条件组合的array
	 $conditions=array();
	 $params=array();
	 $page_params=array();
	   //组合搜索条件
		$title=$_REQUEST['title'];
		if(!empty($title)){
		   array_push($conditions,"t.title LIKE :title");
		   $params[':title']="%$title%";
		   $page_params['title']=$title;
		}
    
    
    $contacter=$_REQUEST['contacter'];
		if(!empty($contacter)){
		   array_push($conditions,"t.contacter LIKE :contacter");
		   $params[':contacter']="%$contacter%";
		   $page_params['contacter']=$contacter;
		}
		
		$message_type=$_REQUEST['message_type'];
		if(!empty($message_type)){
		   array_push($conditions,"t.message_type = :message_type");
		   $params[':message_type']=$message_type;
		   $page_params['message_type']=$message_type;
		}
		
		$status=$_REQUEST['status'];
		if(!empty($status)){
		   array_push($conditions,"t.status = :status");
		   $params[':status']=$status;
		   $page_params['status']=$status;
		}
	
	  //定义排序类
	  $sort=new CSort();
  	 $sort->attributes=array();
  	 $sort->defaultOrder="t.create_time DESC";
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
