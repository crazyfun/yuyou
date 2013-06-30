<?php
class SsupportAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_user_page();
        $this->controller->user_tag="ssupport";
        WebConfig::set_seo_content(array(),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action(){
   	  $cssPath=$this->controller->get_css_path();
     	$jsPath=$this->controller->get_js_path();
   	  $user_id=Yii::app()->user->id;
   	  $conditions=array();
	 		$params=array();
	 		$page_params=array();
	 		
	 		  //组合搜索条件
		$title=$_REQUEST['title'];
		if(!empty($title)){
		   array_push($conditions,"t.title LIKE :title");
		   $params[':title']="%".$title."%";
		   $page_params['title']=$title;
		}
	
	 //组合搜索条件
		$type=$_REQUEST['type'];
		if(!empty($type)){
		   array_push($conditions,"t.type = :type");
		   $params[':type']=$type;
		   $page_params['type']=$type;
		}
		
		//组合搜索条件
		$status=$_REQUEST['status'];
		if(!empty($status)){
		   array_push($conditions,"t.status = :status");
		   $params[':status']=$status;
		   $page_params['status']=$status;
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
	 	 $conditions[]=" t.create_id=:create_id";
	 	 $params[':create_id']=$user_id;
	 	 $page_params['create_id']=$user_id;
	 	 $model=ServiceSupport::model();
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
			'with'=>array("User","ConfigValues"),
			),
			'pagination'=>array(
			'pageSize' => '20',
			'params' => $page_params,
			),
			'sort'=>$sort,
	 	));
		$this->display("s_support",array('model'=>$model,'dataProvider'=>$dataProvider,'page_params'=>$page_params,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
  }

}
?>