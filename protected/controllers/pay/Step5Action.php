<?php
class Step5Action extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_main_page();
        $sys_config=SysConfig::model();
		    $all_syscfg_values=$sys_config->get_all_syscfg();
        WebConfig::set_seo_content(array('seo_title'=>$all_syscfg_values['sfc_home_title']),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action() {
   	    $cssPath=$this->controller->get_css_path();
     		$jsPath=$this->controller->get_js_path();
        $order_id=$_REQUEST['order_id'];
        $pay_id=$_REQUEST['pay_id'];
   			if(empty($order_id)){
   				$this->controller->redirect($this->controller->createUrl("error/error404"));
   			}
   			$action=$_REQUEST['action'];
   			if($action=="coupon"){
   				$model=TravelOrder::model();
   	  		$model=$model->with("Travel")->findByPk($order_id);
			  	$pay=TravelPays::model();
			  	$pay_data=$pay->findByPk($pay_id);
			  	
			  	if(!Yii::app()->user->isGuest){
			  		   $user=User::model();
   	    			 $user_data=$user->findByPk(Yii::app()->user->id);
			  		   $pay_password=$_REQUEST['pay_password'];
			  		   $user_salt=Util::createSalt($user_data->user_salt);
							 if(Util::hc($pay_password,$user_salt)==$user_data->pay_password){
			  		    if($pay_data->status!='2'&&$model->pay_status!='2'){
   	    					if($user_data->conpon<$model->total_price){
   	    						$this->controller->set_flash("余额不足，请先<a taget='_blank' href='".$this->controller->createUrl("user/pay")."'>充值</a>,充值后请重新刷新页面",CV::FAIL);
   	    					}else{
   	    					 $transaction = Yii::app()->db->beginTransaction();
       					   try {
   	    						$travel_order_contacter=TravelOrderContacter::model();
   	    						$order_contacter_data=$travel_order_contacter->find("t.order_id=:order_id AND t.main=:main",array(':order_id'=>$model->id,':main'=>1));
   	    						$travel_order_serial=TravelOrderSerial::model();
   	    						$order_serial_data=$travel_order_serial->find("t.order_id=:order_id",array(':order_id'=>$model->id));
   	    						$company=Company::model();
            	  		$company_data=$company->findByPk($model->company_id);
            	  		$travel_order_numbers=new TravelOrderNumbers();
            	  		$order_numbers_data=$travel_order_numbers->find("t.travel_id=:travel_id AND t.start_date=:start_date",array(':travel_id'=>$model->travel_id,':start_date'=>$model->travel_date));
            	  		if(empty($order_numbers_data)){
            	  			$travel_order_numbers->id=NULL;
            	  			$travel_order_numbers->travel_id=$model->travel_id;
            	  			$travel_order_numbers->start_date=$model->travel_date;
            	  			$travel_order_numbers->order_numbers=1;
            	  			$travel_order_numbers->setIsNewRecord(true);
            	  			if($travel_order_numbers->validate()){
      										$travel_order_numbers->insert_datas();
      						  	}
            	  		}else{
            	  			$travel_order_numbers->updateByPk($order_numbers_data->id,array('order_numbers'=>($order_numbers_data->order_numbers+1)));
            	  		}
      						  $travel=Travel::model();
      						  $travel_data=$travel->findByPk($model->travel_id);
      						  $travel_data->buy_numbers=$travel_data->buy_numbers+1;
      						  $travel_data->insert_datas();
            	  		$consume_temp=new ConsumeTemp();
		    		        $consume_temp->consume(15,Yii::app()->user->id,'2',$model->total_price,array('title'=>$model->Travel->title,'value'=>$model->total_price)); 
   	    						$send_message=new SendMessage();
   	    						$send_message->send_message(16,$order_contacter_data->contacter_phone,array('order_serial'=>$travel_order_serial->order_serial,'title'=>$model->Travel->title,'travel_date'=>$model->travel_date,'contact_phone'=>$company_data->telephone,'address'=>$company_data->address));
             				 $status=$pay_data->status;
              			 if($status=='1'){
              					$result=$pay_data->updateByPk($pay_data->id,array('status'=>'2','pay_time'=>time()));
              					if($result){
              		  			 $model->updateByPk($model->id,array('pay_status'=>'2','pay_time'=>time()));
              					}
             			   }
		    						$this->controller->set_flash("支付成功，订单号已经通过短信的方式通知您。如果5分钟内未收到短信请联系我们。",CV::SUCCESS);		
   	    					   $transaction->commit();
   	    					  }catch(Exception $e){
                        $transaction->rollBack();   
                    }  
   	    					}
   	    				}else{
                   $this->controller->set_flash("您已经成功购买过该线路，请不要重复支付或刷新页面",CV::SUCCESS);
                }	
             }else{
             	  $this->controller->set_flash("支付密码不正确",CV::FAIL);
             }   
                
   	    		}else{
   	    			   $this->controller->set_flash("请先<a href='javascript:pop_no_pay_login();'>登录</a>后方可使用抵用劵",CV::FAIL);
   	    		}
   			}else{
   				
   				
   				$model=TravelOrder::model();
   	  		$model=$model->with("Travel")->findByPk($order_id);
			  	$pay=TravelPays::model();
			  	$pay_data=$pay->findByPk($pay_id);
			  	
			  	
			  	switch($pay_data->type){
			  		case 'coupon':
			  		   break;
			  		case 'huikuan':
			  		   break;
			  		case 'menshi':
			  		   break;
			  		default:
			  		   	$pay_config_code="";
					$pos = strpos($pay_data->type,"kuaiqian_");
					if ($pos===false){
						$pay_config_code=$pay_data->type;
					}else{
						$pay_config_code="kuaiqian";
					}
			  	$pay_code=ucfirst($pay_data->type);
        	$pay_obj = new $pay_code();
        	$order=array('order_sn'=>$pay_data->id,'subject'=>"在线购买线路：".$model->Travel->title,'order_amount'=>$pay_data->price,'notify_url'=>Yii::app()->homeUrl.'/pay/notifyurl/code/'.$pay_config_code,'return_url'=>Yii::app()->homeUrl.'/pay/returnurl/code/'.$pay_config_code,'add_time'=>time());
        	$pay_config=Util::get_payment($pay_config_code,$model->company_id);
        	$pay_online = $pay_obj->get_code($order,$pay_config);
			  		   break;
			  	}
			  	
   			}
        	$this->display("step5",array('model'=>$model,'banker'=>$pay_data->type,'pay_online'=>$pay_online,'pay_data'=>$pay_data,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
   }
}
?>