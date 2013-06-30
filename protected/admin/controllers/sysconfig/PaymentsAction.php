<?php
class PaymentsAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model  = new Payment();
  	//处理表单数据
  	$oldcfg = array();
  	if(isset($_REQUEST['action'])){
       $action=$_REQUEST['action'];
       $pay_id=$_REQUEST['pay_id'];
       $pay_name=$_REQUEST['pay_name'];
       $pay_code=$_REQUEST['pay_code'];
       $pay_desc=$_REQUEST['pay_desc'];
       $pay_fee=$_REQUEST['pay_fee'];
       $config=$_REQUEST['config'];
       $payment_config=array();
       foreach($config as $key => $value){
          $payment_config[]=array('name'=>$key,'value'=>$value,'type'=>''); 	
       }
       $model=empty($pay_id)?$model:$model->findByPk($pay_id);
       $model->pay_name=$pay_name;
       $model->pay_code=$action;
       $model->pay_desc=$pay_desc;
       $model->pay_fee=$pay_fee;
       $model->pay_config=serialize($payment_config);
       $model->enabled='2';

       if($model->validate()){
       	  
           $model->insert_datas();
           $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
        }else{
           $this->controller->f(CV::FAILED_ADMIN_OPERATE);
        }    	
		}
			$alipay=$model->find('pay_code=:pay_code AND t.company_id=:company_id',array(':pay_code'=>'alipay',':company_id'=>'0'));
			$alipay_config=array();
			if(empty($alipay)){
				
			}else{
				$config=$alipay->pay_config;
				$config=unserialize($config);
				foreach($config as $key => $value){
					$alipay_config[$value['name']]=$value['value'];
				}
			}
			$kuaiqian=$model->find('pay_code=:pay_code AND t.company_id=:company_id',array(':pay_code'=>'kuaiqian',':company_id'=>'0'));
			$kuaiqian_config=array();
			if(empty($kuaiqian)){
				
			}else{
				$config=$kuaiqian->pay_config;
				$config=unserialize($config);
				foreach($config as $key => $value){
					$kuaiqian_config[$value['name']]=$value['value'];
				}
			}
		
		$this->display('payments',array('model'=> $model,'alipay'=>$alipay,'kuaiqian'=>$kuaiqian,'alipay_config'=>$alipay_config,'kuaiqian_config'=>$kuaiqian_config));
  }
  
}
?>
