<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
 
  	$model=Permissions::model();
  	 //定义搜索条件组合的array
		 $conditions=array();
		 $params=array();
		 $page_params=array();
		
		   //组合搜索条件
       $permissions_name=$_REQUEST['permissions_name'];
       if(!empty($permissions_name)){
			   array_push($conditions,"t.permissions_name LIKE :permissions_name");
			   $params[':permissions_name']="%$permissions_name%";
			   $page_params['permissions_name']=$permissions_name;
		   }
		 
		 
		 array_push($conditions,"t.create_id=:create_id");
		 $params[':create_id']=Yii::app()->user->id;
		 //定义排序类
		 $sort=new CSort();
  	 $sort->attributes=array();
  	 $sort->defaultOrder="t.id ASC";
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
