<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
   $model=GroupPays::model();
  	  //��������������ϵ�array
	 $conditions=array();
	 $params=array();
	 $page_params=array();
	 
	 $group_name=$_REQUEST['group_name'];
	 if(!empty($group_name)){
	 	   array_push($conditions,"GroupOrder.group_id IN(SELECT id FROM tr_group WHERE title LIKE :title)");
		   $params[':title']="%$group_name%";
		   $page_params['group_name']=$group_name;  
	 	
	 }
	   //�����������
		$user_login=$_REQUEST['user_login'];
		if(!empty($user_login)){
		   array_push($conditions,"User.user_login LIKE :user_login");
		   $params[':user_login']="%$user_login%";
		   $page_params['user_login']=$user_login;
		}
		$type=$_REQUEST['type'];
		if(!empty($type)){
			array_push($conditions,"t.type = :type");
			$params[':type']=$type;
			$page_params['type']=$type;
		}  
		
	  $outer_serial=$_REQUEST['outer_serial'];
		if(!empty($outer_serial)){
			array_push($conditions,"t.outer_serial LIKE :outer_serial");
			$params[':outer_serial']="%$outer_serial%";
			$page_params['outer_serial']=$outer_serial;
		} 

		$status=$_REQUEST['status'];
		if(!empty($status)){
			array_push($conditions,"t.status = :status");
			$params[':status']=$status;
			$page_params['status']=$status;
		}   
		
			  //�����������
		$start_time=$_REQUEST['start_time'];
		if(!empty($start_time)){
		   array_push($conditions,"FROM_UNIXTIME(t.pay_time, '%Y-%m-%d')>='$start_time'");
		   $page_params['start_time']=$start_time;
		}
				  //�����������
		$end_time=$_REQUEST['end_time'];
		if(!empty($end_time)){
		   array_push($conditions,"FROM_UNIXTIME(t.pay_time, '%Y-%m-%d')<='$end_time'");
		   $page_params['end_time']=$end_time;
		}

		
	 //����������
	 $sort=new CSort();
  	 $sort->attributes=array();
  	 $sort->defaultOrder="t.create_time DESC";
  	 $sort->params=$page_params;
  	 //����ActiveDataProvider����
	 $criteria=new CDbCriteria;
	 $dataProvider=new CActiveDataProvider($model, array(
		'criteria'=>array(
			'condition'=>implode(' AND ',$conditions),
			'params'=>$params,
			'with'=>array("User","GroupOrder"),
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
