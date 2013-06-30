<?php
class StatusAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	 $model=LoginStatus::model();
  	 //定义搜索条件组合的array
		 $conditions=array();
		 $params=array();
		 $page_params=array();
		 if(!empty($_POST['search_submit'])){
		   //组合搜索条件
       $create_id=$_REQUEST['create_id'];
       if(!empty($create_id)){
			   array_push($conditions,"(User.user_login LIKE :user_login) OR (User.id=:uid) ");
			   $params[':user_login']="%$create_id%";
			   $params[':uid']=$create_id;
			   $page_params['create_id']=$create_id;
		   }
		   
		   $login_ip=$_REQUEST['login_ip'];
       if(!empty($login_ip)){
			   array_push($conditions,"t.login_ip LIKE :login_ip");
			   $params[':login_ip']="%$login_ip%";
			   $page_params['login_ip']=$login_ip;
		   }
		   
		   $login_address=$_REQUEST['login_address'];
       if(!empty($login_address)){
			   array_push($conditions,"t.login_address LIKE :login_address");
			   $params[':login_address']="%$login_address%";
			   $page_params['login_address']=$login_address;
		   }
		   
		   
		   $start_date=$_REQUEST['start_date'];
       if(!empty($start_date)){
			   array_push($conditions,"FROM_UNIXTIME(t.login_time,'%Y-%m-%d') >= :start_date");
			   $params[':start_date']=$start_date;
			   $page_params['start_date']=$start_date;
		   }
		   
		   $end_date=$_REQUEST['end_date'];
       if(!empty($end_date)){
			   array_push($conditions,"FROM_UNIXTIME(t.login_time,'%Y-%m-%d') <= :end_date");
			   $params[':end_date']=$end_date;
			   $page_params['end_date']=$end_date;
		   }
		   
		    
		 }
		 //定义排序类
		 $sort=new CSort();
  	 $sort->attributes=array();
  	 $sort->defaultOrder="t.login_time DESC";
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
		
		
		$this->display('status',array('model'=>$model,'page_params'=>$page_params,'dataProvider'=>$dataProvider));
  } 
}
?>
