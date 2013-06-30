<?php
class Step4Action extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_main_page();
        $sys_config=SysConfig::model();
		    $all_syscfg_values=$sys_config->get_all_syscfg();
        WebConfig::set_seo_content(array('seo_title'=>$all_syscfg_values['sfc_home_title']),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action(){
   	    $cssPath=$this->controller->get_css_path();
      	$jsPath=$this->controller->get_js_path(); 
   			$order_id=$_REQUEST['order_id'];
   			if(empty($order_id)){
   				$this->controller->redirect("error/error404");
   			}
   			$model=TravelOrder::model();
   			$model=$model->with("Travel")->findByPk($order_id);
   			$action=$_REQUEST['action'];
   			if($action=="order"){
   			 $pay_model=new TravelPays();
   			 $tem_payment_data=$pay_model->find("t.order_id=:order_id",array(':order_id'=>$order_id));
   			 if(!empty($tem_payment_data)){
   			 	 $pay_model->attributes=$tem_payment_data->attributes;
   			 	 $pay_model->id=$tem_payment_data->id;
   			 	 $pay_model->setIsNewRecord(false);
   			}else{
   				$pay_model->id=time();
   			}
   	  	 $type=$_REQUEST['type'];
   	  	 if(!empty($type)){
   	  	 $pay_model->type=$type;
   	  	 $pay_model->price=$model->total_price;
   	  	 $pay_model->order_id=$model->id;
   	  	 $pay_config_code="";
				 $pos = strpos($pay_model->type,"kuaiqian_");
				 if ($pos===false){
						$pay_config_code=$pay_model->type;
				 }else{
						$pay_config_code="kuaiqian";
				 }
   	  	$payment=Payment::model();
				$price=$payment->get_real_amount($pay_config_code,$pay_model->price,$model->company_id);
   	  	$pay_model->user_id=Yii::app()->user->id;
   	  	if(empty($price)){
   	  		$pay_model->price='';
   	  	}else{
   	  		$pay_model->price=$price;
   	  	}
   	 	 	$pay_model->status=1;
   	  	$pay_model->comment="购买线路:".$model->Travel->title;
   	 	 	$pay_model->create_time=time();
   	  	if($pay_model->validate()){
   	  		
			  	$result=$pay_model->insert_datas();
			 	  if($result){
			 	 	  $this->controller->redirect($this->controller->createUrl("pay/step5",array('pay_id'=>$pay_model->id,'order_id'=>$model->id)));
			 	  }else{
			 	  	$this->controller->set_flash("您支付的数据错了，请重新支付或联系我们。",CV::FAIL);
			 	  }
			 	}else{
			 		$this->controller->set_flash("您支付的数据错了，请重新支付或联系我们。",CV::FAIL);
			 	}
       }else{
       	$this->controller->set_flash("请选择支付方式",CV::FAIL);
       }
   			}
   			
				$this->display("step4",array('model'=>$model,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
   }
}
?>