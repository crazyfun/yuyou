<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
   $model=ArchiveTags::model();
  	  //��������������ϵ�array
	 $conditions=array();
	 $params=array();
	 $page_params=array();
	   //�����������
		$tag_name=$_REQUEST['tag_name'];
		if(!empty($tag_name)){
		   array_push($conditions,"t.tag_name LIKE :tag_name");
		   $params[':tag_name']="%$tag_name%";
		   $page_params['tag_name']=$tag_name;
		}
	  //����������
	  $sort=new CSort();
  	 $sort->attributes=array();
  	 $sort->defaultOrder="t.id DESC";
  	 $sort->params=$page_params;
  	 //����ActiveDataProvider����
	 $criteria=new CDbCriteria;
	 $dataProvider=new CActiveDataProvider($model, array(
		'criteria'=>array(
			'condition'=>implode(' AND ',$conditions),
			'params'=>$params,
			'with'=>array(),
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
