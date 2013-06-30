<?php
class Step1Action extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_main_page();
        $sys_config=SysConfig::model();
		    $all_syscfg_values=$sys_config->get_all_syscfg();
        WebConfig::set_seo_content(array('seo_title'=>$all_syscfg_values['sfc_home_title']),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action(){
   	  //初始化页面需要的全局变量
   	  $cssPath=$this->controller->get_css_path();
      $jsPath=$this->controller->get_js_path(); 
      $action=$_REQUEST['action'];
      $model=new TempOrder();
      $travel_id=$_REQUEST['travel_id'];
      $date_id=$_REQUEST['date_id'];
      $travel_date=$_REQUEST['travel_date'];
      $adult_nums=$_REQUEST['adult_nums'];
      $child_nums=$_REQUEST['child_nums'];
      $insurance_ids=$_REQUEST['insurance_ids'];
      $insurance_number=$_REQUEST['insurance_number'];
      $company_id=$_REQUEST['company_id'];
      $travel=Travel::model();
      $travel_data=$travel->findByPk($travel_id);
      if($action=="order"){
      	$agree_order=$_REQUEST['agree_order'];
      	$model->travel_id=$travel_id;
      	$model->travel_date=$travel_date;
      	$model->adult_nums=$adult_nums;
      	$model->child_nums=$child_nums;
      	$travel_date_model=TravelDate::model();
      	$travel_date_data=$travel_date_model->findByPk($date_id);
      	$model->adult_price=$travel_date_data->adult_price;
      	$model->child_price=$travel_date_data->child_price;
      	$model->fa_price=$travel_date_data->fa_price;
      	$model->fc_price=$travel_date_data->fc_price;
      	$model->agree_order=$agree_order;
      	$model->company_id=$company_id;
      	if(empty($adult_nums)){
      		$model->addError('adult_nums','成人数不正确');
      	}
      	$get_errors=$model->getErrors();
      	if(empty($get_errors)&&$model->validate()){
      		$result=$model->insert_datas();
      		if($result){
      			$order_total_price=(floatval($travel_date_data->adult_price)*floatval($adult_nums))+(floatval($travel_date_data->child_price)*floatval($child_nums));
      			$temp_order_insurance=new TempOrderInsurance();
      			$insurance=Insurance::model();
      			foreach((array)$insurance_ids as $key => $value){
      				$temp_order_insurance->id=null;
      				$temp_order_insurance->setIsNewRecord(true);
      				$temp_order_insurance->order_id=$model->id;
      				$temp_order_insurance->insurance_id=$value;
      				$temp_order_insurance->insurance_number=$insurance_number[$key];
      				if($temp_order_insurance->validate()){
      					$temp_order_insurance->insert_datas();
      				}
      				$insurance_data=$insurance->findByPk($value);
      				$order_total_price+=floatval($insurance_data->insurance_price*$insurance_number[$key]);
      			}
      			$model->updateByPk($model->id,array('total_price'=>$order_total_price));
      			$this->controller->redirect($this->controller->createUrl("pay/step2",array('order_id'=>$model->id)));
      			exit();
      		}
      	}else{
      	
      		$this->display("step1",array('model'=>$model,'insurance_number'=>$insurance_number,'travel_data'=>$travel_data,'travel_date'=>$travel_date,'adult_nums'=>$adult_nums,'child_nums'=>$child_nums,'company_id'=>$company_id,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
      	}

      }else{
      	
				$this->display("step1",array('model'=>$model,'insurance_number'=>$insurance_number,'travel_data'=>$travel_data,'travel_date'=>$travel_date,'adult_nums'=>$adult_nums,'child_nums'=>$child_nums,'company_id'=>$company_id,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
      }
     
   }

}
?>