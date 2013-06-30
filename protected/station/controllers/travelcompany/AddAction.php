<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	
  $model=new TravelCompany();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$company_id=$_REQUEST['company_id'];
  		$model->attributes=$_POST[$model_name];
  		foreach($company_id as $key => $value){
  			$old_data=$model->find("travel_id=:travel_id AND company_id=:company_id",array(':travel_id'=>$_POST[$model_name]['travel_id'],':company_id'=>$value));
  			if(empty($old_data)){
  				  $model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
		        $model->id=null;
			  		$model->setIsNewRecord(true);
		        $model->company_id=$value;
			      if($model->validate()){
			          $model->insert_datas();
		         }
  			}
  		} 
  		$this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
	 }else{
	 	  
		  $id=$_REQUEST['id'];
		  $travel_id=$_REQUEST['travel_id'];
		  $model=!empty($id)?$model->get_table_datas($id,array()):$model;
		  if(!empty($travel_id)){
		  	$model->travel_id=$travel_id;
		  }
	 }
	 
	 $travel=Travel::model();
	 $travel_data=$travel->findByPk($model->travel_id);
	 $company=Company::model();
  	  //定义搜索条件组合的array
	 $conditions=array();
	 $params=array();
	 $page_params=array();
	   //组合搜索条件
		$company_name=$_REQUEST['company_name'];
		if(!empty($company_name)){
		   array_push($conditions,"(t.company_name LIKE :company_name) OR (t.address LIKE :company_name)");
		   $params[':company_name']="%$company_name%";
		   $page_params['company_name']=$company_name; 
		}
		$region_id=$_REQUEST['region_id'];
		if(!empty($region_id)){
		   array_push($conditions,"t.region_id = :region_id");
		   $params[':region_id']=$region_id;
		   $page_params['region_id']=$region_id;
		   $region=Region::model();
		   $region_data=$region->findByPk($region_id);
		   $page_params['region_id_text']=$region_data->region_name;
		}
		array_push($conditions,"t.company_type = :company_type");
		$params[':company_type']='1';
		$page_params['travel_id']=$model->travel_id;
	 //定义排序类
	   $sort=new CSort();
  	 $sort->attributes=array();
  	 $sort->defaultOrder="t.create_time ASC";
  	 $sort->params=$page_params;
  	 //生成ActiveDataProvider对象
	 $criteria=new CDbCriteria;
	 $dataProvider=new CActiveDataProvider($company, array(
		'criteria'=>array(
			'condition'=>implode(' AND ',$conditions),
			'params'=>$params,
			'with'=>array("Region"),
		),
		'pagination'=>array(
			'pageSize' => '40',
			'params' => $page_params,
		),
		'sort'=>$sort,
	 ));
	 
	 
	 
	 
	 $this->display('add',array('model'=>$model,'company'=>$company,'page_params'=>$page_params,'dataProvider'=>$dataProvider));
  } 
}
?>
