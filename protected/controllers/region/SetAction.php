<?php
class SetAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_main_page();
        WebConfig::set_seo_content(array(),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action(){
   	  //初始化页面需要的全局变量
   	  $cssPath=$this->controller->get_css_path();
      $jsPath=$this->controller->get_js_path(); 
       $ip_convert=IpConvert::get();
	  	$region_session=$ip_convert->init_region();  	 		 	    
			$region_name=$region_session['name'];
			
	  $action=$_REQUEST['action'];
		$ip_convert=IpConvert::get();
		switch($action){
			case 'select':
			  $region_id=$_REQUEST['region_id'];
			  $ip_convert->set_region($region_id);
			  break;
			case 'input':
			  $region_name=$_REQUEST['region_name'];
			  $model=Region::model();
				$conditions="INSTR(:region_name,region_name)>0 AND open=:open";
				$params=array(':region_name'=>$region_name,':open'=>'2');
				$region_datas=$model->find($conditions,$params);
				$region_id=$region_datas->region_id;
	      $ip_convert->set_region($region_id);
			  break;
			default:
			  break;
			
		}
		$this->controller->redirect($this->controller->createUrl("site/index"));
   }

}
?>