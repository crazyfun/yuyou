<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
   $model=HotelsTran::model();
  	  //定义搜索条件组合的array
	 $conditions=array();
	 $params=array();
	 $page_params=array();
	 
	   //组合搜索条件
		$tran_name=$_REQUEST['tran_name'];
		if(!empty($tran_name)){
		   array_push($conditions,"t.tran_name LIKE :tran_name");
		   $params[':tran_name']="%$tran_name%";
		   $page_params['tran_name']=$tran_name;
		}


		$hotels_id=$_REQUEST['hotels_id'];
	  array_push($conditions,"t.hotels_id = :hotels_id");
		$params[':hotels_id']=$hotels_id;
		$page_params['hotels_id']=$hotels_id;
		   
	 //定义排序类
	 $sort=new CSort();
  	 $sort->attributes=array();
  	 $sort->defaultOrder="t.sort_order ASC";
  	 $sort->params=$page_params;
  	 //生成ActiveDataProvider对象
	 $criteria=new CDbCriteria;
	 $dataProvider=new CActiveDataProvider($model, array(
		'criteria'=>array(
			'condition'=>implode(' AND ',$conditions),
			'params'=>$params,
			'with'=>array("Hotels"),
		),
		'pagination'=>array(
			'pageSize' => '20',
			'params' => $page_params,
		),
		'sort'=>$sort,
	 ));
	 
	 $this->display('index',array('model'=>$model,'page_params'=>$page_params,'dataProvider'=>$dataProvider,'hotels_id'=>$hotels_id));
  } 
}
?>
