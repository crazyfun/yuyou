<?php
class GroupfavoriteAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_user_page();
        $this->controller->user_tag="groupfavorite";
        WebConfig::set_seo_content(array(),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action(){
   	  $cssPath=$this->controller->get_css_path();
     	$jsPath=$this->controller->get_js_path();
   	  $user_id=Yii::app()->user->id;
   	
   	  $model=GroupFavorite::model();
   	  $conditions=array();
	 		$params=array();
	 		$page_params=array();
	 		  //组合搜索条件
		$group_name=$_REQUEST['group_name'];
		if(!empty($group_name)){
		   array_push($conditions,"Group.title LIKE :group_name");
		   $params[':group_name']="%".$group_name."%";
		   $page_params['group_name']=$group_name;
		}
	 	 	$conditions[]=" user_id=:user_id ";
	 	 	$params[':user_id']=$user_id;
	 	 	$page_params['user_id']=$user_id;
			 //定义排序类
		 $sort=new CSort();
  	 $sort->attributes=array();
  	 $sort->defaultOrder="t.id DESC";
  	 $sort->params=$page_params;
  	 //生成ActiveDataProvider对象
	 	$criteria=new CDbCriteria;
	 	$dataProvider=new CActiveDataProvider($model, array(
			'criteria'=>array(
			'condition'=>implode(' AND ',$conditions),
			'params'=>$params,
			'with'=>array("User",'Group'),
			'together'=>true,
			),
			'pagination'=>array(
			'pageSize' => '20',
			'params' => $page_params,
			),
			'sort'=>$sort,
	 	));
		$this->display("group_favorite",array('model'=>$model,'dataProvider'=>$dataProvider,'user_data'=>$user_data,'page_params'=>$page_params,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
  }

}
?>