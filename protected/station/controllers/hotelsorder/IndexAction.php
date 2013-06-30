<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
  	
   $model=HotelsOrder::model();
  	  //定义搜索条件组合的array
	 $conditions=array();
	 $params=array();
	 $page_params=array();
	 
	   //组合搜索条件
		$hotels_title=$_REQUEST['hotels_title'];
		if(!empty($hotels_title)){
		   array_push($conditions,"Hotels.title LIKE :hotels_title");
		   $params[':hotels_title']="%$hotels_title%";
		   $page_params['hotels_title']=$hotels_title;
		}
		
	
		 //组合搜索条件
		$company_name=$_REQUEST['company_name'];
		if(!empty($company_name)){
		   array_push($conditions,"Company.company_name LIKE :company_name");
		   $params[':company_name']="%$company_name%";
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
		$hotels_start_date=$_REQUEST['hotels_start_date'];
		if(!empty($hotels_start_date)){
		   array_push($conditions,"t.start_date>='$hotels_start_date'");
		   $page_params['hotels_start_date']=$hotels_start_date;
		}
		
		
				  //组合搜索条件
		$hotels_end_date=$_REQUEST['hotels_end_date'];
		if(!empty($hotels_end_date)){
		   array_push($conditions,"t.start_date<='$hotels_end_date'");
		   $page_params['hotels_end_date']=$hotels_end_date;
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
			   array_push($conditions,"(t.status = 1 OR t.status=2)");
			   break;
			case '2':
			   array_push($conditions,"(t.status = 3 )");
			   break;
			case '3':
			   array_push($conditions,"(t.status = 5 )");
			   break;
			case '4':
			   array_push($conditions,"(t.status = 4 )");
			   break;
			default:
			   break;
			
		}
	  $page_params['travel_status']=$travel_status;
    array_push($conditions,"Hotels.company_id = :hotels_company_id");
		$params[':hotels_company_id']=$this->controller->company_id;
	
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
			'with'=>array("Hotels","User","HotelsBeds","HotelsPrice",'Company'),
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
