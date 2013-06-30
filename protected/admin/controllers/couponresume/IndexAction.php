<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
   $model=CouponResume::model();
  	  //定义搜索条件组合的array
	 $conditions=array();
	 $params=array();
	 $page_params=array();
	   //组合搜索条件
		$user_login=$_REQUEST['user_login'];
		if(!empty($user_login)){
		   array_push($conditions,"User.user_login LIKE :user_login");
		   $params[':user_login']="%$user_login%";
		   $page_params['user_login']=$user_login;
		}
		
		$operate_user=$_REQUEST['operate_user'];
		if(!empty($operate_user)){
		   array_push($conditions,"OperateUser.user_login LIKE :operate_user");
		   $params[':operate_user']="%$operate_user%";
		   $page_params['operate_user']=$operate_user;
		}
		
		$type=$_REQUEST['type'];
		if(!empty($type)){
			array_push($conditions,"t.type = :type");
			$params[':type']=$type;
			$page_params['type']=$type;
		}  
			  //组合搜索条件
		$start_time=$_REQUEST['start_time'];
		if(!empty($start_time)){
		   array_push($conditions,"FROM_UNIXTIME(t.create_time, '%Y-%m-%d')>='$start_time'");
		   $page_params['start_time']=$start_time;
		}
				  //组合搜索条件
		$end_time=$_REQUEST['end_time'];
		if(!empty($end_time)){
		   array_push($conditions,"FROM_UNIXTIME(t.create_time, '%Y-%m-%d')<='$end_time'");
		   $page_params['end_time']=$end_time;
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
			'with'=>array("User","OperateUser"),
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
