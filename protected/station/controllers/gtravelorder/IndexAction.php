<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
   $model=TravelOrder::model();
  	  //定义搜索条件组合的array
	 $conditions=array();
	 $params=array();
	 $page_params=array();
	 
	   //组合搜索条件
		$travel_title=$_REQUEST['travel_title'];
		if(!empty($travel_title)){
		   array_push($conditions,"Travel.title LIKE :travel_title");
		   $params[':travel_title']="%$travel_title%";
		   $page_params['travel_title']=$travel_title;
		}
		
		 $reserved=$_REQUEST['reserved'];
		if(!empty($reserved)){
		   array_push($conditions,"t.reserved = :reserved");
		   $params[':reserved']=$reserved;
		   $page_params['reserved']=$reserved;
		}
		 //组合搜索条件
		$company_name=$_REQUEST['company_name'];
		if(!empty($company_name)){
		   array_push($conditions,"Travel.company_id IN(SELECT id FROM tr_company WHERE company_name LIKE :travel_company_name)");
		   $params[':travel_company_name']="%$company_name%";
		   $page_params['company_name']=$company_name;
		}
		
		$user_login=$_REQUEST['user_login'];
		if(!empty($user_login)){
			if($user_login=="游客"){
				array_push($conditions,"t.user_id = '0'");
		   $page_params['user_login']=$user_login;
			}else{
				array_push($conditions,"User.user_login LIKE :user_login");
		   $params[':user_login']="%$user_login%";
		   $page_params['user_login']=$user_login;
			}
		   
		}
		
		$relation_operate_id=$_REQUEST['relation_operate_id'];
		if(!empty($relation_operate_id)){
			 array_push($conditions,"t.goperate_id = :relation_operate_id");
		   $params[':relation_operate_id']=$relation_operate_id;
		   $page_params['relation_operate_id']=$relation_operate_id;
		}
		

		$status=$_REQUEST['status'];
		if(!empty($status)){
		   array_push($conditions,"t.status = :status");
		   $params[':status']=$status;
		   $page_params['status']=$status;
		}
		
		$pay_status=$_REQUEST['pay_status'];
		if(!empty($pay_status)){
		   array_push($conditions,"t.pay_status = :pay_status");
		   $params[':pay_status']=$pay_status;
		   $page_params['pay_status']=$pay_status;
		}
		
		
		
				  //组合搜索条件
		$travel_start_date=$_REQUEST['travel_start_date'];
		if(!empty($travel_start_date)){
		   array_push($conditions,"t.travel_date>='$travel_start_date'");
		   $page_params['travel_start_date']=$travel_start_date;
		}
		
		
				  //组合搜索条件
		$travel_end_date=$_REQUEST['travel_end_date'];
		if(!empty($travel_end_date)){
		   array_push($conditions,"t.travel_date<='$travel_end_date'");
		   $page_params['travel_end_date']=$travel_end_date;
		}
		
		
		$create_start_date=$_REQUEST['create_start_date'];
		if(!empty($create_start_date)){
		   array_push($conditions,"FROM_UNIXTIME(t.create_time, '%Y-%m-%d')>='$create_start_date'");
		   $page_params['create_start_date']=$create_start_date;
		}
		
		
				  //组合搜索条件
		$create_end_date=$_REQUEST['create_end_date'];
		if(!empty($create_end_date)){
		   array_push($conditions,"FROM_UNIXTIME(t.create_time, '%Y-%m-%d')<='$create_end_date'");
		   $page_params['create_end_date']=$create_end_date;
		}
		
		$travel_status=$_REQUEST['travel_status'];
		switch($travel_status){
			case '1':
			   array_push($conditions,"(t.status = 1 OR t.status=2 OR t.status=3 OR t.status=4 OR t.status=5)");
			   break;
			case '2':
			   array_push($conditions,"(t.status = 6 OR t.status=7 )");
			   break;
			case '3':
			   array_push($conditions,"(t.status = 9 )");
			   break;
			case '4':
			   array_push($conditions,"(t.status = 8 )");
			   break;
			default:
			   break;
			
		}
	  $page_params['travel_status']=$travel_status;
    array_push($conditions,"t.company_id = :travel_company_id");
		$params[':travel_company_id']=$this->controller->company_id;
		
		$user=new User();
		$user_permission_name=$user->get_permissions_name();
    if(Util::is_permission($user_permission_name,"setuser")){
     	   
    }else{
    	array_push($conditions,"t.goperate_id = :operate_id");
		  $params[':operate_id']=Yii::app()->user->id;    	
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
			'with'=>array("Travel","User","Company"),
			'together'=>true,
			'group'=>'t.id',
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
