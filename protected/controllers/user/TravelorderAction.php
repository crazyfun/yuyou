<?php
class TravelorderAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_user_page();
        $this->controller->user_tag="travelorder";
        WebConfig::set_seo_content(array(),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action(){
   	  $cssPath=$this->controller->get_css_path();
     	$jsPath=$this->controller->get_js_path();
   	  $user_id=Yii::app()->user->id;
   	  $user=User::model();
   	  $user_data=$user->findByPk($user_id);
   	  $model=TravelOrder::model();
   	  $conditions=array();
	 		$params=array();
	 		$page_params=array();
	 	  $order_status=$_REQUEST['order_status'];
	 	  if(empty($order_status)){
	 	  	$order_status=1;
	 	  }
	 	  $page_params['order_status']=$order_status;
	 	  
	 	  switch($order_status){
	 	  	case '1':
	 	  	   array_push($conditions,"( t.status=1 OR t.status=2 OR t.status=3 OR t.status=4 OR t.status=5 )");
	 	  	  break;
	 	  	case '2':
	 	  	  array_push($conditions,"( t.status=6 OR t.status=7 )");
	 	  	  break;
	 	  	case '3':
	 	  	 array_push($conditions,"( t.status=8 )");
	 	  	  break;
	 	  	default:
	 	  	  break;
	 	  }
	 		  //组合搜索条件
		$title=$_REQUEST['title'];
		if(!empty($title)){
		   array_push($conditions,"Travel.title LIKE :title");
		   $params[':title']="%".$title."%";
		   $page_params['title']=$title;
		}
		
		$pay_status=$_REQUEST['pay_status'];
		if(!empty($pay_status)){
		   array_push($conditions,"t.pay_status = :pay_status");
		   $params[':pay_status']=$pay_status;
		   $page_params['pay_status']=$pay_status;
		}
		
		
			  //组合搜索条件
		$start_time=$_REQUEST['start_time'];
		if(!empty($start_time)){
		   array_push($conditions,"t.travel_date>='$start_time'");
		   $page_params['start_time']=$start_time;
		}
				  //组合搜索条件
		$end_time=$_REQUEST['end_time'];
		if(!empty($end_time)){
		   array_push($conditions,"t.travel_date<='$end_time'");
		   $page_params['end_time']=$end_time;
		}
		
	 	$conditions[]=" t.user_id=:user_id ";
	 	$params[':user_id']=$user_id;
	 	$page_params['user_id']=$user_id;
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
			'with'=>array("Travel","User"),
			),
			'pagination'=>array(
			'pageSize' => '20',
			'params' => $page_params,
			),
			'sort'=>$sort,
	 	));
		$this->display("travel_order",array('model'=>$model,'dataProvider'=>$dataProvider,'user_data'=>$user_data,'page_params'=>$page_params,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
  }

}
?>