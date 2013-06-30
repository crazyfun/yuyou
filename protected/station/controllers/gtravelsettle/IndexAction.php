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
   $settle_status=$_REQUEST['settle_status'];
		if(!empty($settle_status)){
			if($settle_status=='1'){
				array_push($conditions,"(TravelSettle.id is null)");
		    $page_params['settle_status']=$settle_status;
			}else{
		   array_push($conditions,"TravelSettle.status = :settle_status");
		   $params[':settle_status']=$settle_status;
		   $page_params['settle_status']=$settle_status;
		  }
		}
		
		
    array_push($conditions,"t.status = :status");
		$params[':status']='9';

    array_push($conditions,"t.company_id = :travel_company_id");
		$params[':travel_company_id']=$this->controller->company_id;
    
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
			'with'=>array("Travel","User",'TravelOrderContacter',"Company",'TravelSettle'),
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
