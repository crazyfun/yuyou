<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){ 
  	$model=new TravelRoute();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
		  $model->attributes=$_POST[$model_name];
		  $travel_route=$_REQUEST['travel_route'];
		  if(!empty($travel_route)){
		  	$model->travel_route=implode(",",$travel_route);
		  }
			if($model->validate()){
			  $result=$model->insert_datas();
			  if($result){
			     $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
			  }else{
			  	 $this->controller->f(CV::FAILED_ADMIN_OPERATE);
			  }
		  }else{
			  	 $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
	 }else{
		  $id=$_REQUEST['id'];
		  $travel_id=$_REQUEST['travel_id'];
		  $model=!empty($id)?$model->get_table_datas($id,array()):$model; 
		  if(!empty($travel_id))
		  	$model->travel_id=$travel_id;
		  if(!empty($model->travel_route)){
		  	$travel_route=explode(",",$model->travel_route);
		  }
		  $max_route_day=$model->find(array("condition"=>'t.travel_id=:travel_id','params'=>array(':travel_id'=>$model->travel_id),'order'=>'t.route_day DESC'));
		  $model->route_day=$max_route_day->route_day+1;
	 }
	 $this->display('add',array('model'=>$model,'travel_route'=>$travel_route));
  } 
}
?>
