<?php

class DefaultController extends Controller
{
	public $tag="region";
	public $breadcrumbs=array();
	public function actionIndex(){
		$this->breadcrumbs=array('切换城市');
     $ip_convert=IpConvert::get();
	  $region_session=$ip_convert->init_region();  	 		 	    
		$region_name=$region_session['name'];
    $this->set_seo('找导游网_导游证_导游词_导游资格考试_导游考试_旅游计调_挂靠旅行社','找'.$region_name.'导游，'.$region_name.'导游证，'.$region_name.'导游词，'.$region_name.'导游资格考试，'.$region_name.'导游考试，挂靠'.$region_name.'旅行社，'.$region_name.'导游报名，'.$region_name.'英文导游，'.$region_name.'中文导游，'.$region_name.'旅行社，'.$region_name.'地接社，'.$region_name.'组团社，'.$region_name.'旅游计调','找导游网-"立火"旅游业之家:是全国最大的导游，导游证，导游词，导游资格考试，导游考试，导游报名，英文导游，中文导游，旅游计调，挂靠旅行社，旅行社，组团社，地接社，景点，酒店和旅游资讯等旅游业资源共享平台。并提供网站线上服务和线下电话沟通交流的服务。"立火"旅游业之家愿和所有业内同仁一起共建一个资源共享与合作的平台，让我们的客户能享受更便利、更亲切、更满意的服务。');
		Util::reset_vars();
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
	 $this->render('index',array('model'=>$model,'region_datas'=>$region_datas,'regions'=>$regions,'current_region'=>$current_region));
	}
	
	public function actionSet(){
		$this->breadcrumbs=array('切换城市');
     $ip_convert=IpConvert::get();
	  $region_session=$ip_convert->init_region();  	 		 	    
		$region_name=$region_session['name'];
    $this->set_seo('找导游网_导游证_导游词_导游资格考试_导游考试_旅游计调_挂靠旅行社','找'.$region_name.'导游，'.$region_name.'导游证，'.$region_name.'导游词，'.$region_name.'导游资格考试，'.$region_name.'导游考试，挂靠'.$region_name.'旅行社，'.$region_name.'导游报名，'.$region_name.'英文导游，'.$region_name.'中文导游，'.$region_name.'旅行社，'.$region_name.'地接社，'.$region_name.'组团社，'.$region_name.'旅游计调','找导游网-"立火"旅游业之家:是全国最大的导游，导游证，导游词，导游资格考试，导游考试，导游报名，英文导游，中文导游，旅游计调，挂靠旅行社，旅行社，组团社，地接社，景点，酒店和旅游资讯等旅游业资源共享平台。并提供网站线上服务和线下电话沟通交流的服务。"立火"旅游业之家愿和所有业内同仁一起共建一个资源共享与合作的平台，让我们的客户能享受更便利、更亲切、更满意的服务。');
		Util::reset_vars();
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
		$this->redirect($this->createUrl("/site/index"));
		
	}
	

	
	public function f($msg_code){ 
     if($msg_code == CV::SUCCESS){
       $this->set_flash("操作成功",$msg_code);
     }
     if($msg_code == CV::FAIL){
     	 $this->set_flash("操作失败",$msg_code);
     }
     
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