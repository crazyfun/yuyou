<?php
class ContacterAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_user_page();
        $this->controller->user_tag="contacter";
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
   	  $model=Contacter::model();
   	  $conditions=array();
	 		$params=array();
	 		$page_params=array();
	 		
	 		  //组合搜索条件
		$contacter=$_REQUEST['contacter'];
		if(!empty($contacter)){
		   array_push($conditions,"t.contacter LIKE :contacter");
		   $params[':contacter']="%".$contacter."%";
		   $page_params['contacter']=$contacter;
		}
	 	 	$conditions[]=" user_id=:user_id ";
	 	 	$params[':user_id']=$user_id;
	 	 	$page_params['user_id']=$user_id;
			 //定义排序类
		 $sort=new CSort();
  	 $sort->attributes=array();
  	 $sort->defaultOrder="t.contacter DESC";
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
		$this->display("contacter",array('model'=>$model,'dataProvider'=>$dataProvider,'user_data'=>$user_data,'page_params'=>$page_params,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
  }

}
?>