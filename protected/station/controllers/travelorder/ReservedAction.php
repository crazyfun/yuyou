<?php
class ReservedAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	$model=new TravelOrder();
  	$model_name=get_class($model);
  	$status=$_REQUEST['status'];
  	switch($status){
  		case '2':
  		  if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
		  $model->attributes=$_POST[$model_name];
		  $model->reserved=$status;
		  
		  if(empty($_POST[$model_name]['reserved_date'])){
		  	
		  	$model->addError('reserved_date',"预留时间不能为空");
		  	$this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }else{
		  	if($_POST[$model_name]['reserved_date']<=date("Y-m-d")){
		  		$model->addError('reserved_date',"预留时间必须大于当前时间");
		  	  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  	}else{
					if($model->validate()){
			  			$result=$model->insert_datas();
			 	 if($result){
			  	        
			  			$this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
			  	}
			  
		  		}else{
			  		$this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  		}
				}
		}
		
		
	 }else{
		  $id=$_REQUEST['id'];
		  $model=!empty($id)?$model->get_table_datas($id,array()):$model;
	 }
	 $this->display('reserved',array('model'=>$model,'status'=>$status));
  		  break;
    case '1':
  		$model=TravelOrder::model();
			$id=$_REQUEST['id'];
			$status=$_REQUEST['status'];
			$model_data=$model->findByPk($id);
	 	 	$model->updateByPk($id,array('reserved'=>$status,'reserved_date'=>''));
			$this->controller->redirect($this->controller->createUrl("index",array()));
  		  break;
  		default:
  		  break;
  	}
  	
  } 
}
?>
