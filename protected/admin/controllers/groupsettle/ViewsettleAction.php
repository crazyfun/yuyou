<?php
class ViewsettleAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model=new GroupSettle();
  	$model_name=get_class($model);
  	$group_id=$_REQUEST['group_id'];
  	if(isset($_POST[$model_name])){
  			$model->attributes=$_POST[$model_name];
  			$model->type='1';
  			$model->status='2';
  			if($model->validate()){
  				$result=$model->insert_datas();
  				if($result){
  					$this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
  				}else{
  					$this->controller->f(CV::FAILED_ADMIN_OPERATE);
  				}
  	    }
  	}else{
			$model_data=$model->find("t.group_id = :group_id",array(':group_id'=>$group_id));
			if(!empty($model_data)){
				$model=$model_data;
			}else{
			  $model->group_id=$group_id;
			}
	  }
			$group=Group::model();
			$groud_data=$group->with("Company","GroupSettle")->findByPk($group_id);
	  $this->display('viewsettle',array('groud_data'=>$groud_data,'model'=>$model));
  } 
}
?>
