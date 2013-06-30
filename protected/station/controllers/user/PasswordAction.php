<?php
class PasswordAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	 $model=User::model();
  	 //定义搜索条件组合的array
		 $conditions=array();
		 $params=array();
		 $page_params=array();
		 if(!empty($_POST['search_submit'])){
		   //组合搜索条件
       $user_login=$_REQUEST['user_login'];
       if(!empty($user_login)){
			   array_push($conditions,"(t.user_login LIKE :user_login) OR (t.id=:uid) ");
			   $params[':user_login']="%$user_login%";
			   $params[':uid']=$user_login;
			   $page_params['user_login']=$user_login;
		   }
		   
		   
		   $real_name=$_REQUEST['real_name'];
       if(!empty($real_name)){
			   array_push($conditions,"t.real_name = :real_name");
			   $params[':real_name']=$real_name;
			   $page_params['real_name']=$real_name;
		   }
		   
		   
		   
		   $user_email=$_REQUEST['user_email'];
       if(!empty($user_email)){
			   array_push($conditions,"t.user_email = :user_email");
			   $params[':user_email']=$user_email;
			   $page_params['user_email']=$user_email;
		   }
		   
		   
		   
		   $cell_phone=$_REQUEST['cell_phone'];
       if(!empty($cell_phone)){
			   array_push($conditions,"t.cell_phone = :cell_phone");
			   $params[':cell_phone']=$cell_phone;
			   $page_params['cell_phone']=$cell_phone;
		   }
		   
		   
		   
		   $admin_status=$_REQUEST['admin_status'];
       if(!empty($admin_status)){
			   array_push($conditions,"t.admin_status = :admin_status");
			   $params[':admin_status']=$admin_status;
			   $page_params['admin_status']=$admin_status;
		   }
		   
		   
		   $station_id=$_REQUEST['station_id'];
       if(strlen($station_id)){
			   array_push($conditions,"t.station_id = :station_id");
			   $params[':station_id']=$station_id;
			   $page_params['station_id']=$station_id;
		   }
		   
		    
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
			    'with'=>array("User","Station"),
			
			),
			'pagination'=>array(
          'pageSize' => '20',
          'params' => $page_params,
      ),
      'sort'=>$sort,
		));
		
		
		$this->display('password',array('model'=>$model,'page_params'=>$page_params,'dataProvider'=>$dataProvider));
  } 
}
?>
