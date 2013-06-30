<?php
class Flash extends CWidget
{
		public $pattern="";
	  public $view="";
    public function run(){
    	switch($this->pattern){
	  	  case 'travel':
	  	      $model_name="TravelFlashAd";
    				$model=new $model_name();
    				$ip_convert=IpConvert::get();
		 				$region_data=$ip_convert->init_region();
    			  $region_id=$region_data['id'];
    				$region_name=$region_data['name'];
    				$content=$model->get_content($region_id);
	  	  		break;	
	  	  default:
	  	      if(empty($this->pattern)||($this->pattern=="archives")){
	  	      	$model_name="FlashAd";
	  	      }else{
	  	      	$model_name=ucfirst($this->pattern)."FlashAd";
	  	      }
						$model=new $model_name();
						$content=$model->get_content();
	  	  		break;
	  	}
    	 $number=count($content);
       $this->render("/flash/".$this->view,array('content'=>$content,'number'=>$number));
    }
}
