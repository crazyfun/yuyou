<?php
class ViewsettleAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model=GroupSettle::model();
  	$model_name=get_class($model);
  	$group_id=$_REQUEST['group_id'];
  	if(isset($_POST[$model_name])){
  		  
  			$model->updateByPk($_POST[$model_name]['id'],array('status'=>'3'));
  			$this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
  	}
			$model_data=$model->find("t.group_id = :group_id",array(':group_id'=>$group_id));
			if(!empty($model_data)){
				$model=$model_data;
			}else{
			  $model->group_id=$group_id;
			}

		$group=Group::model();
		$group_data=$group->with("Company","GroupSettle")->findByPk($group_id);
	  $this->display('viewsettle',array('group_data'=>$group_data,'model'=>$model));
  } 
}
?>
