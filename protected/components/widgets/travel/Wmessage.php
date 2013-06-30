<?php
session_start();
class Wmessage extends CWidget
{
	  public $view="";
	  public $code="";
  public function run(){
  	$ts = time();
    $code=$_REQUEST['code'];
    if(!empty($code)){
    	$this->code=$code;
    }
    $model=new ContacterMessage();
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
		  $model->attributes=$_POST[$model_name];
		  $imagecode=$_REQUEST['imagecode'];
		  $model->imagecode=$imagecode;
		if(empty($model->title)){
			$model->addError("title","标题不能不空");
		}
		
		if(empty($model->message_type)){
			$model->addError("message_type","类别不能为空");
		}
		
		if(empty($model->contacter)){
			$model->addError("contacter","联系人不能不空");
		}
		
		if(empty($model->contacter_phone)){
			$model->addError("contacter_phone","联系电话不能不空");
		}

		if(empty($model->comment)){
			$model->addError("comment","内容不能为空");
		}
		
		if($this->code=="Y"){
			if(empty($model->imagecode)){
				 	$model->addError("imagecode","验证码不能为空");
			}else{
				$img_code=$_SESSION["__img_code__"];
			  if(md5(strtoupper($model->imagecode))!=$img_code){
				  $model->addError('imagecode','验证码不正确');
				}
			}
		}
		 $errors=$model->getErrors();
		 if(empty($errors)&&$model->validate()){
			  $model->insert_datas();
			  $model->title="";
			  $model->message_type="";
			  $model->contacter="";
			  $model->contacter_phone="";
			  $model->comment="";
			  $imagecode="";
			  $this->controller->f(CV::MESSAGE_SUCCESS);
		 }else{
			  $this->controller->f(CV::FAIL);
		 }
	 }
	 $config_values=ConfigValues::model();
	 $message_type=$config_values->get_ralation_values("6");
   $this->render("/message/".$this->view,array('code'=>$this->code,'message_type'=>$message_type,'model'=>$model,'ts'=>$ts,'imagecode'=>$imagecode));
  }
}
