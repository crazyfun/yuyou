<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	
  	$model=new Permissions();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
      $model->attributes=$_POST[$model_name];
			$permission_value=$_REQUEST['permission_value'];
			if(!empty($permission_value)){
			  $model->permissions_value=implode(",",$permission_value);
			}
			if($model->validate()){
				if(empty($_POST[$model_name]['id'])){
         $model->permissions_name=Yii::app()->user->getName()."_".$model->permissions_name;
        }
			  $model->insert_datas();
			  $model->set_permissions($model->id,$permission_value);
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
		}else{
			$id=$_REQUEST['id'];
			$model=!empty($id)?$model->get_table_datas($id,array()):$model;
		}
		$this->display('add',array('model'=>$model));
  } 
}
?>
