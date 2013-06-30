<?php
class WList extends CWidget
{ 
	  public $pattern="";
	  public $view="";
    public $channel="";
    public $category="";
    public $limit="";
    public $sort="";
    public $sort_type="";
    public $size="";
    public $region_id="";
    public $ajaxUpdate="";  
    public function run(){
    	  //初始化页面需要的全局变量
   	$cssPath=$this->controller->get_css_path();
    $jsPath=$this->controller->get_js_path(); 
    $model_name=ucfirst($this->pattern);
    $model=new $model_name();
    $condition=array();
		$params=array();
		$page_params=array(); 
		$channel_model=Channels::model();
		if(!empty($this->channel)){
			
      $channel_childrens=$channel_model->get_descendant($this->channel);
			$condition[]="t.channel_id ".Util::db_create_in($channel_childrens);
			$page_params['channel']=$this->channel;
		}
		$channel_category=ChannelCategory::model();
		if(!empty($this->category)){
    	$category_childrens=$channel_category->get_descendant($this->category);
    	$condition[]="t.category_id ".Util::db_create_in($category_childrens);
			$page_params['category']=$this->category;
		}
		   if(!empty($this->sort)){
    		$list_sort="t.".$this->sort;
    	}else{
    		$list_sort="t.create_time";
    	}
    	
    	if(!empty($this->sort_type)){
    		$list_sort_type=$this->sort_type;
    	}else{
    		$list_sort_type="DESC";
    	}
    	
    	if(!empty($this->limit)){
    		$list_limit=$this->limit;
    	}else{
    		$list_limit="20";
    	}
    switch($this->pattern){
						case 'travel':
						  if(empty($this->region_id)){
						  	$ip_convert=IpConvert::get();
		  					$region_data=$ip_convert->init_region();
      					$this->region_id=$region_data['id'];
						  }
						  $condition[]=" t.start_region=:start_region ";
						  $params[':start_region']=$this->region_id;
						  break;
						default:
						  break;
			}	
    if(!empty($this->view)){
    		$list_view=$this->view;
    	}else{
    		$list_view="title_date_list";
    	}
		$condition[]=" t.status=:status ";
    $params[':status']='2';

    //定义排序类
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder=$list_sort." ".$list_sort_type;
  	$sort->params=$page_params;
  	
  	//生成ActiveDataProvider对象
  	$dataProvider=new CActiveDataProvider($model, array(
				'criteria'=>array(
			  	'condition'=>implode(' AND ',$condition),
			 	 	'params'=>$params,
			  	'with'=>array('Channels','User',"ChannelCategory"),
			  	'together'=>true,
		    ),
				'pagination'=>array(
          'pageSize' => $list_limit,
          'params' => $page_params,
      	),
      	'sort'=>$sort,
		));
		$explode_size=explode("*",$this->size);
		$width=$explode_size[0];
		$height=$explode_size[1];
		$dataProvide_data=$dataProvider->getData();
		foreach($dataProvide_data as $key => $value){
			switch($this->pattern){
				case 'travel':
				   $first_image=$model->get_first_image($value['id']);
				   $value['image']="/".Util::rename_thumb_file($width,$height,"",$first_image);
				   break;
				case 'hotels':
				   $first_image=$model->get_first_image($value['id']);
				   $value['image']="/".Util::rename_thumb_file($width,$height,"",$first_image);
				   break;
				default:
				   $value['image']="/".Util::rename_thumb_file($width,$height,"",$value['image']);
				   break;
			}
			switch($this->pattern){
						case 'travel':
             $value['price']=$model->get_travel_price($value['id']);
            break;
            case 'hotels':
             $value['price']=$pattern->get_hotels_price($value['id']);
             break;
            default:
            break;
         }
         
         
			$value['stitle']=empty($value['stitle'])?$value['title']:$value['stitle'];
      $value['scontent']=empty($value['scontent'])?$value['content']:$value['scontent'];
      $value['modify_time']=($this->sort=="modify_time")?date('Y-m-d',strtotime($value['modify_time'])):($this->sort=="create_time")?date('Y-m-d',$value['create_time']):date('Y-m-d',$value['update_time']);
      $value['channel_name']=$value->show_attribute("channel_id");
      $value['channel_href']=$channel_model->set_channel_link($value['channel_id']);
      $value['category_name']=$value->show_attribute("category_id");
      $value['category_href']=$channel_category->set_category_link($this->pattern,$value['category_id'],$value['channel_id']);
      $value['create_name']=$value->show_attribute("create_id");
      $value['href']=$model->set_channel_link($this->pattern,$value['id']);
      $dataProvide_data[$key]=$value;
		}
		$dataProvider->data=$dataProvide_data;
    $this->render("wlist",array('dataProvider'=>$dataProvider,'list_view'=>$list_view,'ajaxUpdate'=>$this->ajaxUpdate,'page_params'=>$page_params,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
  }    
   
}
