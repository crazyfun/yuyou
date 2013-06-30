<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	

  	$model=BackendMenu::model();
  	 //��������������ϵ�array
		 $conditions=array();
		 $params=array();
		 $page_params=array();
		
		   //�����������
       $menu_name=$_REQUEST['menu_name'];
       if(!empty($menu_name)){
			   array_push($conditions,"t.menu_name LIKE :menu_name");
			   $params[':menu_name']="%$menu_name%";
			   $page_params['menu_name']=$menu_name;
		   }
		   
		   
		   $menu_parent=$_REQUEST['menu_parent'];
       if(!empty($menu_parent)){
			   array_push($conditions,"t.menu_parent = :menu_parent OR t.id=:menu_parent");
			   $params[':menu_parent']=$menu_parent;
			   $page_params['menu_parent']=$menu_parent;
		   }

		 //����������
		 $sort=new CSort();
  	 $sort->attributes=array();
  	 $sort->defaultOrder="t.menu_sort ASC";
  	 $sort->params=$page_params;
  	 //����ActiveDataProvider����
		 $criteria=new CDbCriteria;
		 $dataProvider=new CActiveDataProvider($model, array(
			'criteria'=>array(
			    'condition'=>implode(' AND ',$conditions),
			    'params'=>$params,
			    'with'=>array("User","BackendMenu"),
			
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
