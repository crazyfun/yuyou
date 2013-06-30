<?php
class CompanyAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_main_page();
        WebConfig::set_seo_content(array(),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
  }
   protected function do_action(){
   	$cssPath=$this->controller->get_css_path();
    $jsPath=$this->controller->get_js_path();
		$model=new Company();
		$model_name=ucfirst(get_class($model));
		if($_POST[$model_name]){
      $model->attributes=$_POST[$model_name];
      if($_POST[$model_name]['region_id']=='0'){
      	$model->region_id="";
      }
			if($model->validate()){
		    	$result=$model->insert_datas();
		    	if($result){
		    		if($model->company_type=="6"){
			  			$hotels=new Hotels();
			  			$hotels_data=$hotels->find("t.company_id=:company_id",array(':company_id'=>$model->id));
			  			$hotels=empty($hotels_data)?$hotels:$hotels_data;
			  			$hotels->channel_id=138;
			  			$hotels->title=$model->company_name;
			  			$hotels->hotel_level=1;
			  			$hotels->hotel_region=$model->region_id;
			  			$hotels->hotel_price_limit=1;
			  			$hotels->company_id=$model->id;
			  			$hotels->hotel_address=$model->address;
			  			$hotels->hotel_coordinate=$model->coordinate;
			  			$hotels->hotel_telephone=$model->telephone;
			  			if($hotels->validate()){
			       		$hotels->insert_datas();
			    		}
			   		}
		    	  $this->display('registecompanysuccess',array('model'=>$model,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
		    	}
		  }else{
		  	  
		  }
		}else{
        
		}
		$this->display('company',array('model'=>$model,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
   }
}
?>