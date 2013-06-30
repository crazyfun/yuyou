<?php
class PayAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_user_page();
        $this->controller->user_tag="index";
        WebConfig::set_seo_content(array(),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action(){
   	  $cssPath=$this->controller->get_css_path();
      $jsPath=$this->controller->get_js_path();
   	  $user_id=Yii::app()->user->id;
   	  $model=new Pays();
   	  $model_name=ucfirst(get_class($model));
   	  if($_POST[$model_name]){
   	  	
   	  	 $model->attributes=$_POST[$model_name];
   	  	 $type=$_REQUEST['type'];
   	  	 $model->type=$type;
   	  	 $pay_config_code="";
				 $pos = strpos($model->type,"kuaiqian_");
				 if ($pos===false){
						$pay_config_code=$model->type;
				 }else{
						$pay_config_code="kuaiqian";
				 }
   	  	$payment=Payment::model();
				$price=$payment->get_real_amount($pay_config_code,$model->price);
   	 	 	$model->id=time();
   	  	$model->user_id=$user_id;
   	  	if(empty($price)){
   	  		$model->price='';
   	  	}else{
   	  		$model->price=$price;
   	  	}
   	  	
   	 	 	$model->status=1;
   	  	$model->comment="在线充值";
   	 	 	$model->create_time=time();
   	  	if($model->validate()){
			  	$result=$model->insert_datas();
			 	  if($result){
			 	 	  $this->controller->redirect($this->controller->createUrl("user/pay2",array('pay_id'=>$model->id)));
			 	  }else{
			 	  	$this->controller->f(CV::PAYVALIDATE);
			 	  }
			 	}else{
			 		$this->controller->f(CV::PAYVALIDATE);
			 	}
   	  }else{
   	  	$price=$_REQUEST['price'];
   	  	$model->price=$price;
   	  }
			$this->display("pay",array('model'=>$model,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
  }

}
?>