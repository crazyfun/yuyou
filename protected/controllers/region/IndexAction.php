<?php
class IndexAction extends BaseAction{
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
	  	$model=Region::model();
	  	$cache_id="SelectRegions";
	  	$region_datas=Yii::app()->cache2->get($cache_id);
    	if($region_datas===false)
    	{
   		 	$region_datas=$model->get_select_regions();
     		Yii::app()->cache2->set($cache_id, $region_datas);
    	}
   		$regions=$this->get_regions();
   		$ip_convert=IpConvert::get();
   		$current_region=$ip_convert->init_region();
	 		$this->display('index',array('model'=>$model,'region_datas'=>$region_datas,'regions'=>$regions,'current_region'=>$current_region));
   }

    function get_regions()
    {
        $model_region = Region::model();
        $regions = $model_region->get_list(0);
        if ($regions)
        {
            $tmp  = array();
            foreach ($regions as $key => $value)
            {
                $tmp[$value['region_id']] = $value['region_name'];
            }
            $regions = $tmp;
        }
       
        return $regions;
    }  
}
?>