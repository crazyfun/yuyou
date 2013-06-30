<?php
class Pay2Action extends BaseAction{
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
   	  		$model=User::model();
   	  		$model=empty($user_id)?$model:$model->findByPk($user_id);
			  	$pay_id=$_REQUEST['pay_id'];
			  	$pay=Pays::model();
			  	$pay_data=$pay->findByPk($pay_id);
			  	$pay_config_code="";
					$pos = strpos($pay_data->type,"kuaiqian_");
					if ($pos===false){
						$pay_config_code=$pay_data->type;
					}else{
						$pay_config_code="kuaiqian";
					}
			  	$pay_code=ucfirst($pay_data->type);
        	$pay_obj    = new $pay_code();
        	$order=array('order_sn'=>$pay_data->id,'subject'=>Yii::app()->name."会员在线充值",'order_amount'=>$pay_data->price,'notify_url'=>Yii::app()->homeUrl.'/user/notifyurl/code/'.$pay_config_code,'return_url'=>Yii::app()->homeUrl.'/user/returnurl/code/'.$pay_config_code,'add_time'=>time());
        	$pay_config=Util::get_payment($pay_config_code);
        	$pay_online = $pay_obj->get_code($order,$pay_config);
        	$this->display("pay2",array('model'=>$model,'price'=>$pay_data->price,'banker'=>$pay_data->type,'pay_online'=>$pay_online,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
     
  }

}
?>