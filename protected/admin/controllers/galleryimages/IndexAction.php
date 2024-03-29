<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
   $model=GalleryImages::model();
  	  //定义搜索条件组合的array
	 $conditions=array();
	 $params=array();
	 $page_params=array();
	 //组合搜索条件
		$image_name=$_REQUEST['image_name'];
		if(!empty($image_name)){
		   array_push($conditions,"Images.name Like :image_name");
		   $params[':image_name']="%".$image_name."%";
		   $page_params['image_name']=$image_name;
		}
		
	 $gallery_id=$_REQUEST['gallery_id'];
	 array_push($conditions,"t.gallery_id=:gallery_id");
	 $params[':gallery_id']=$gallery_id;
	 $page_params['gallery_id']=$gallery_id;
	 
	 //定义排序类
	 $sort=new CSort();
   $sort->attributes=array();
   $sort->defaultOrder="t.create_time ASC";
   $sort->params=$page_params;
  	 //生成ActiveDataProvider对象
	 $criteria=new CDbCriteria;
	 $dataProvider=new CActiveDataProvider($model, array(
		'criteria'=>array(
			'condition'=>implode(' AND ',$conditions),
			'params'=>$params,
			'with'=>array("User","Gallery","Images"),
		),
		'pagination'=>array(
			'pageSize' => '20',
			'params' => $page_params,
		),
		'sort'=>$sort,
	 ));
	 $this->display('index',array('model'=>$model,'page_params'=>$page_params,'dataProvider'=>$dataProvider,'gallery_id'=>$gallery_id));
  } 
}
?>
