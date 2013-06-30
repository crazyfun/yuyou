<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
   $model=GroupOrder::model();
  	  //定义搜索条件组合的array
	 $conditions=array();
	 $params=array();
	 $page_params=array();
	 
	   //组合搜索条件
		$group_title=$_REQUEST['group_title'];
		if(!empty($group_title)){
		   array_push($conditions,"Group.title LIKE :group_title");
		   $params[':group_title']="%$group_title%";
		   $page_params['group_title']=$group_title;
		}
		
		
		$order_serial=$_REQUEST['order_serial'];
		if(!empty($order_serial)){
		   array_push($conditions,"t.order_serial LIKE :order_serial");
		   $params[':order_serial']="%$order_serial%";
		   $page_params['order_serial']=$order_serial;
		}
	

		
		$user_login=$_REQUEST['user_login'];
		if(!empty($user_login)){
				array_push($conditions,"User.user_login LIKE :user_login");
		   $params[':user_login']="%$user_login%";
		   $page_params['user_login']=$user_login;
		   
		}
		
	
		$cell_phone=$_REQUEST['cell_phone'];
		if(!empty($cell_phone)){
		   array_push($conditions,"t.cell_phone LIKE :cell_phone");
		   $params[':cell_phone']="%$cell_phone%";
		   $page_params['cell_phone']=$cell_phone;
		}


		
		$pay_status=$_REQUEST['pay_status'];
		if(!empty($pay_status)){
		   array_push($conditions,"t.pay_status = :pay_status");
		   $params[':pay_status']=$pay_status;
		   $page_params['pay_status']=$pay_status;
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
			   array_push($conditions,"t.status = 1 ");
			   break;
			case '2':
			   array_push($conditions,"t.status = 2 ");
			   break;
			case '3':
			   array_push($conditions,"t.status = 3 ");
			   break;
			default:
			   break;
		}
	  $page_params['travel_status']=$travel_status;
     array_push($conditions,"Group.company_id = :company_id");
		   $params[':company_id']=$this->controller->company_id;
		   
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
			'with'=>array("Group","User"),
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
