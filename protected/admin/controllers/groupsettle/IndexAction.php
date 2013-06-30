<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
   $model=Group::model();
  	  //定义搜索条件组合的array
	 $conditions=array();
	 $params=array();
	 $page_params=array();
	 
		$group_title=$_REQUEST['group_title'];
		if(!empty($group_title)){
		   array_push($conditions,"t.title LIKE :group_title");
		   $params[':group_title']="%$group_title%";
		   $page_params['group_title']=$group_title;
		}
	
		 //组合搜索条件
		$company_name=$_REQUEST['company_name'];
		if(!empty($company_name)){
		   array_push($conditions,"Company.company_name LIKE :company_name");
		   $params[':company_name']="%$company_name%";
		   $page_params['company_name']=$company_name;
		}
		
		
		$settle_status=$_REQUEST['settle_status'];
		if(!empty($settle_status)){
			if($settle_status=='1'){
				array_push($conditions,"(GroupSettle.id is null)");
		    $page_params['settle_status']=$settle_status;
			}else{
		   array_push($conditions,"GroupSettle.status = :settle_status");
		   $params[':settle_status']=$settle_status;
		   $page_params['settle_status']=$settle_status;
		  }
		}
		 array_push($conditions,"t.open = :open");
		   $params[':open']='3';
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
			'with'=>array("Company","GroupSettle"),
			'together'=>true,
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
