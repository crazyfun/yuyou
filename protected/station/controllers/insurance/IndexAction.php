<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
   $model=Insurance::model();
  	  //��������������ϵ�array
	 $conditions=array();
	 $params=array();
	 $page_params=array();
	 
	   //�����������
		$insurance_name=$_REQUEST['insurance_name'];
		if(!empty($insurance_name)){
		   array_push($conditions,"t.insurance_name LIKE :insurance_name");
		   $params[':insurance_name']="%$insurance_name%";
		   $page_params['insurance_name']=$insurance_name;
		}

		$insurance_company=$_REQUEST['insurance_company'];
		if(!empty($insurance_company)){
			array_push($conditions,"t.insurance_company LIKE :insurance_company");
			$params[':insurance_company']="%$insurance_company%";
			$page_params['insurance_company']=$insurance_company;
		}
	  array_push($conditions,"t.company_id = :company_id");
		$params[':company_id']=$this->controller->company_id;
	 //����������
	 $sort=new CSort();
  	 $sort->attributes=array();
  	 $sort->defaultOrder="t.create_time ASC";
  	 $sort->params=$page_params;
  	 //����ActiveDataProvider����
	 $criteria=new CDbCriteria;
	 $dataProvider=new CActiveDataProvider($model, array(
		'criteria'=>array(
			'condition'=>implode(' AND ',$conditions),
			'params'=>$params,
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
