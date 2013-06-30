<?php
class ListAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_group_page();
        return true;
    }
   protected function do_action(){
   	$cssPath=$this->controller->get_css_path();
    $jsPath=$this->controller->get_js_path();
		$channel=$_REQUEST['channel'];
		if(empty($channel)){
			$this->controller->redirect("/error/error404");
		}
		
    $channels=Channels::model();
    $channels_data=$channels->findByPk($channel);
    $parent_id=$channels_data->parent_id;
    $name=$channels_data->name;
    WebConfig::set_breadcrumbs(array($name));
    $seo_title=$channels_data->seo_title;
    $seo_keywords=$channels_data->seo_keywords;
    $seo_describe=$channels_data->seo_describe;
   	WebConfig::set_seo_content(array('seo_title'=>$seo_title),array('seo_keywords'=>$seo_keywords),array('seo_description'=>$seo_describe));
    $lists_template=$channels_data->lists_template;
    $lists_template=Util::get_file_name($lists_template);
    
    $region_id=$_REQUEST['region_id'];
    $category=$_REQUEST['category'];
    $end_region_id=$_REQUEST['end_region_id'];
    $condition=array();
		$params=array();
		$page_params=array();
		
	  if(!empty($region_id)){
  		array_push($condition,'t.region_id = :region_id');
			$params[':region_id']=$region_id;
			$page_params['region_id']=$region_id;
  	}
  	
  	if(!empty($category)){
  		array_push($condition,'t.category_id = :category');
			$params[':category']=$category;
			$page_params['category']=$category;
  	}
  	
  	if(!empty($end_region_id)){
  		array_push($condition,'t.end_region_id = :end_region_id');
			$params[':end_region_id']=$end_region_id;
			$page_params['end_region_id']=$end_region_id;
  	}
  	
  	
  	$advanced_sort=$_REQUEST['advanced_sort'];
  	$advanced_sort_type=$_REQUEST['advanced_sort_type'];
  	$order_sort="";
  	if(!empty($advanced_sort)){
  		$order_sort="t.".$advanced_sort;
  	}else{
  		$advanced_sort="create_time";
  		$order_sort="t.create_time";
  	}
  	if(!empty($advanced_sort_type)){
  		$order_sort.=" ".$advanced_sort_type;
  	}else{
  		$order_sort.=" DESC ";
  		$advanced_sort_type='DESC';
  	}
  	$page_params['advanced_sort']=$advanced_sort;
  	$page_params['advanced_sort_type']=$advanced_sort_type;
  	
  	array_push($condition,'t.open = :open');
	  $params[':open']='2';
	  array_push($condition,'t.status = :status');
	  $params[':status']='2';
	  
	  array_push($condition,"t.start_time <= '".date("Y-m-d H:i:s")."'");
	  array_push($condition,"t.end_time >= '".date("Y-m-d H:i:s")."'");

			
			
  	$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder=$order_sort;
  	$sort->params=$page_params;
  	$model=new Group();
  	$page_params['action']=$_REQUEST['action'];
  	$page_params['channel']=$channel;
  	
  	$dataProvider=new CActiveDataProvider($model, array(
				'criteria'=>array(
				'select'=>'t.*',
			  'condition'=>implode(' AND ',$condition),
			  'params'=>$params,
			  'with'=>array('User','Channels','ChannelCategory','Company','Region','EndRegion'),
			  'together'=>true,
		    ),
				'pagination'=>array(
          		'pageSize' => '20',
          		'params' => $page_params,
      	),
      	'sort'=>$sort,
		));
		  $channel_category=ChannelCategory::model();
		  $category_select_datas=$channel_category->findAll("t.parent_id=:parent_id",array(':parent_id'=>'55'));
		  $category_select=array();
		  foreach($category_select_datas as $key => $value){
		  	$category_select[$value->id]=$value->name;
		  }
      $advanced_search=array(
			   'region_id'=>array('name'=>'出发地','items'=>$model->get_search_region_id(-1)),
			   'end_region_id'=>array('name'=>'目的地','items'=>$model->get_search_end_region(-1)),
			   'category'=>array('name'=>'类型','items'=>$category_select),
			  );
			 $advanced_sort=array('create_time'=>'时间','views'=>'热门','price'=>'价格');
		$this->display($lists_template,array('cssPath'=>$cssPath,'jsPath'=>$jsPath,'name'=>$name,'channel'=>$channel,'channel_parent'=>$parent_id,'category'=>$category,'pattern'=>$channels_data->pattern,'dataProvider'=>$dataProvider,'advanced_search'=>$advanced_search,'advanced_sort'=>$advanced_sort,'page_params'=>$page_params));
	  
   }

}
?>