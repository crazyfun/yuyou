<?php
class Step3Action extends BaseAction{
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
   				$this->controller->redirect($this->controller->createUrl("error/error404"));
   			}
   	    $model=TempOrder::model();
   	    $model=$model->with("Travel")->findByPk($order_id);
   	    if(empty($model)){
   	    	$this->controller->redirect($this->controller->createUrl("error/error404"));
   	    }
   	    $action=$_REQUEST['action'];
   	    if($action=="order"&&!empty($model)){
   	    	$coupon=floatval($_REQUEST['coupon']);
   	    	if(!empty($coupon)){
   	    		  $travel_coupon=$model->Travel->coupon;
   	    		  if($travel_coupon < $coupon){
   	    		  	$this->controller->set_flash("抵用额不能大于线路可抵用额",CV::FAIL);
   	    		  }else{
   	    		   	if(!Yii::app()->user->isGuest){
   	    					$user=User::model();
   	    					$user_data=$user->findByPk(Yii::app()->user->id);
   	    					if($user_data->conpon<$coupon){
   	    						$this->controller->set_flash("余额不足,请先<a taget='_blank' href='".$this->controller->createUrl("user/pay")."'>充值</a>,充值后请重新刷新页面",CV::FAIL);
   	    					}else{
   	    						
   	    						
   	    						$travel_order=TravelOrder::model();
   	    	$travel_order_id=$travel_order->create_travel_order($order_id);
   	    	if($travel_order_id){
   	    		$comment=$_REQUEST['comment'];
   	    		
   	    		$transaction = Yii::app()->db->beginTransaction();
       			try {
   	    				$result=$travel_order->updateByPk($travel_order_id,array('coupon'=>$coupon,'total_price'=>($model->total_price-$coupon),'comment'=>$comment));
   	    				
   	    				$consume_temp=new ConsumeTemp();
		    				$consume_temp->consume(14,Yii::app()->user->id,'2',$coupon,array('title'=>$model->Travel->title,'value'=>$coupon));  
		    						
   	    		    $transaction->commit();      
       		  }catch(Exception $e){
              $transaction->rollBack();   
            }      
   	    		
   	    		$this->controller->redirect($this->controller->createUrl("pay/step4",array('order_id'=>$travel_order_id)));
   	    	}else{
   	    		$this->controller->set_flash("数据库操作错误",CV::FAIL);
   	    	}
   	    }
   	    }else{
   	    		$this->controller->set_flash("请先<a href='javascript:pop_login();'>登录</a>后方可使用抵用劵",CV::FAIL);
   	    }
   	   }
   	    			
   	    	}else{
   	    			$travel_order=TravelOrder::model();
   	    	$travel_order_id=$travel_order->create_travel_order($order_id);
   	    	if($travel_order_id){
   	    		$comment=$_REQUEST['comment'];
   	 
   	    		$result=$travel_order->updateByPk($travel_order_id,array('comment'=>$comment));
   	    		$this->controller->redirect($this->controller->createUrl("pay/step4",array('order_id'=>$travel_order_id)));
   	    	}else{
   	    		$this->controller->set_flash("数据库操作错误",CV::FAIL);
   	    	}
   	    	}
   	    }
				$this->display("step3",array('model'=>$model,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
   }
}
?>