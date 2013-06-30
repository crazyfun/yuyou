<?php

/**
 * This is the model class for table "{{trave}}".
 *
 * The followings are the available columns in table '{{trave}}':
 * @property string $id
 * @property string $number
 * @property string $channel_id
 * @property string $category_id
 * @property string $title
 * @property string $attr
 * @property string $suppliers
 * @property string $suppliers_number
 * @property integer $route_number
 * @property integer $budget
 * @property string $start_region
 * @property string $end_region
 * @property string $linetype
 * @property string $scontent
 * @property string $content
 * @property string $receptionstandards
 * @property string $recommended
 * @property string $tour
 * @property string $notice
 * @property string $tips
 * @property string $transportation
 * @property string $application
 * @property string $default_hotel
 * @property string $coupon
 * @property string $buy_numbers
 * @property integer $status
 * @property integer $is_comment
 * @property integer $is_vot
 * @property string $views
 * @property string $vots
 * @property string $goods
 * @property string $bads
 * @property string $sort
 * @property string $seo_keywords
 * @property string $seo_describe
 * @property string $create_id
 * @property string $modify_time
 * @property string $update_time
 * @property string $create_time
 */
class Travel extends BaseActive
{
	public $href="";
  public $channel_name="";
  public $channel_href="";
  public $category_name="";
  public $category_href="";
  public $create_name="";
  public $price="";
  public $diff_nums="";
  

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Trave the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{travel}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('channel_id,title,end_region','required','message'=>'{attribute}不能为空'),
			array('route_number, budget, status, is_comment, is_vot', 'numerical', 'integerOnly'=>true),
			array('travel_tags,number,modify_time', 'length', 'max'=>30),
			array('channel_id, category_id,start_region,end_region,default_hotel, coupon, buy_numbers, views, vots, goods, bads, sort,company_id,group_number, create_id, update_time, create_time', 'length', 'max'=>11),
			array('title, attr, linetype, mid_region,application', 'length', 'max'=>100),
			array('transportation', 'length', 'max'=>50),
			array('seo_keywords, seo_describe', 'length', 'max'=>200),
			array('scontent, content, receptionstandards, recommended, tour, notice, tips', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, number, channel_id, category_id, title, attr,travel_tags,route_number, budget, start_region,mid_region,end_region, linetype, scontent, content, receptionstandards, recommended, tour, notice, tips, transportation, application, default_hotel, coupon, buy_numbers, status, is_comment, is_vot, views, vots, goods, bads, sort, seo_keywords, seo_describe, company_id,group_number,create_id, modify_time, update_time, create_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'User'=>array(self::BELONGS_TO,'User','create_id'),
			'Channels'=>array(self::BELONGS_TO, 'Channels', 'channel_id'),
			'ChannelCategory'=>array(self::BELONGS_TO,'ChannelCategory','category_id'),
			'Hotels'=>array(self::BELONGS_TO,'Hotels','default_hotel'),
			'EndRegion'=>array(self::BELONGS_TO,'Region','end_region'),
			'StartRegion'=>array(self::BELONGS_TO,'Region','start_region'),
			'TravelDate'=>array(self::HAS_MANY,'TravelDate','travel_id'),
			'TravelArea'=>array(self::HAS_MANY,'TravelArea','travel_id'),
			'Company'=>array(self::BELONGS_TO,'Company','company_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'number' => '线路编号',
			'channel_id' => '栏目名称',
			'category_id' => '分类名称',
			'title' => '线路名称',
			'attr' => '自定义属性',
			'travel_tags'=>'线路tags',
			'route_number' => '出行天数',
			'budget' => '价格范围',
			'start_region' => '始发地',
			'mid_region'=>'途径',
			'end_region' => '目的地',
			'linetype' => '线路分类',
			'scontent' => '简短描述',
			'content' => '线路描述',
			'receptionstandards' => '接待标准',
			'recommended' => '特色推荐',
			'tour' => '自费项目',
			'notice' => '预订通知',
			'tips' => '温馨提示',
			'transportation' => '往返交通',
			'application' => '提前报名',
			'default_hotel' => '默认酒店',
			'coupon' => '抵用劵',
			'buy_numbers' => '购买数量',
			'status' => '状态',
			'is_comment' => '是否评论',
			'is_vot' => '是否投票',
			'views' => '查看数',
			'vots' => '投票数',
			'goods' => '赞',
			'bads' => '踩',
			'sort' => '排序',
			'seo_keywords' => 'SEO关键字',
			'seo_describe' => 'SEO描述',
			'company_id'=>'公司名称',
			'group_number'=>'成团人数',
			'create_id' => '创建用户',
			'modify_time' => '自定义时间',
			'update_time' => '更新时间',
			'create_time' => '创建时间',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('number',$this->number,true);
		$criteria->compare('channel_id',$this->channel_id,true);
		$criteria->compare('category_id',$this->category_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('attr',$this->attr,true);
		$criteria->compare('travel_tags',$this->travel_tags,true);
		$criteria->compare('route_number',$this->route_number);
		$criteria->compare('budget',$this->budget);
		$criteria->compare('start_region',$this->start_region,true);
		$criteria->compare('mid_region',$this->mid_region,true);
		$criteria->compare('end_region',$this->end_region,true);
		$criteria->compare('linetype',$this->linetype,true);
		$criteria->compare('scontent',$this->scontent,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('receptionstandards',$this->receptionstandards,true);
		$criteria->compare('recommended',$this->recommended,true);
		$criteria->compare('tour',$this->tour,true);
		$criteria->compare('notice',$this->notice,true);
		$criteria->compare('tips',$this->tips,true);
		$criteria->compare('transportation',$this->transportation,true);
		$criteria->compare('application',$this->application,true);
		$criteria->compare('default_hotel',$this->default_hotel,true);
		$criteria->compare('coupon',$this->coupon,true);
		$criteria->compare('buy_numbers',$this->buy_numbers,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('is_comment',$this->is_comment);
		$criteria->compare('is_vot',$this->is_vot);
		$criteria->compare('views',$this->views,true);
		$criteria->compare('vots',$this->vots,true);
		$criteria->compare('goods',$this->goods,true);
		$criteria->compare('bads',$this->bads,true);
		$criteria->compare('sort',$this->sort,true);
		$criteria->compare('seo_keywords',$this->seo_keywords,true);
		$criteria->compare('seo_describe',$this->seo_describe,true);
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('group_number',$this->group_number,true);
		$criteria->compare('create_id',$this->create_id,true);
		$criteria->compare('modify_time',$this->modify_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
			//删除一笔数据
public function delete_table_datas($pk_id="",$condition=array()){
	$table_datas=$this->get_table_datas($pk_id,$condition);
	if(is_array($table_datas)){
		foreach($table_datas as $key => $value){
			$id=$value->id;
			$this->delete_relation($id);
			$this->deleteByPk($id,"",array());
		}
	 }else{
	 	  $id=$table_datas->id;
	 	  $this->delete_relation($id);
			$this->deleteByPk($id,"",array());
	 }
	 return true;
	}
	
	public function delete_relation($id){
		$condition=array('condition'=>"travel_id=:travel_id",'params'=>array(':travel_id'=>$id));
		$travel_area=TravelArea::model();
		$travel_area->delete_table_datas("",$condition);
		$travel_date=TravelDate::model();
		$travel_date->delete_table_datas("",$condition);
		$travel_route=TravelRoute::model();
		$travel_route->delete_table_datas("",$condition);
		$travel_images=TravelImages::model();
		$travel_images->delete_table_datas("",$condition);
		
	}
	
	public function insert_datas(){
		if(!$this->hasErrors()){
			$datas=$this->save();
			return $datas;
		}
	}
	public function beforeSave(){
	  if(parent::beforeSave()){
			if($this->isNewRecord){
				  $serial=new Serial();
				  $serial_data=$serial->find("serial_name=:serial_name",array(':serial_name'=>'Trave Number'));
				  $this->number="STS".$serial_data->serial_value;
           
				  $this->create_id=Yii::app()->user->id;
			    $this->create_time=time();
			    $this->update_time=time();
			    $serial->updateAll(array('serial_value'=>$serial_data->serial_value+1),'serial_name=:serial_name',array(':serial_name'=>'Trave Number'));
			}else{
			   $this->update_time=time();
			}
			return true;
		}else{
			return false;
		}
	}
	function show_attribute($attribute_id){
	 switch($attribute_id){
	 	case 'company_id':
	 	  return $this->Company->company_name;
	 	  break;
	 	case 'channel_id':
	 		return $this->Channels->name;
	 		break;
	 	case 'title':
	 	  $config_values=ConfigValues::model();
      	  $archive_att_select=$config_values->findAll("FIND_IN_SET(value,'".$this->attr."')>0 AND type=:type",array(':type'=>'1'));
      	  $att_name=array();
      	  foreach($archive_att_select as $key => $value){
      		$att_name[]=$value->name;
      	  }
	 	  return $this->title."[<font color='#ff6600'>".implode(",",$att_name)."</font>]";
	 	  break;
	 	case 'budget':
	 		$config_values=ConfigValues::model();
	 		$budget=$config_values->get_ralation_values("11");
	 		return $budget[$this->budget];
	 		break;
	 	case 'start_region':
	 		return $this->StartRegion->region_name;
	 	    break;
	 	case 'mid_region':
	 		$region=Region::model();
	 	    $mid_region=empty($this->mid_region)?array():explode(",",$this->mid_region);
	 	    $region_name=array();
	 	    foreach($mid_region as $key => $value){
	 	    	$region_data=$region->findByPk($value);
	 	    	$region_name[]=$region_data->region_name;
	 	    }
	 	    return implode(",",$region_name);
	 	    break;
	    case 'end_region':
	    	return $this->EndRegion->region_name;
	        break;
	   	case 'linetype':
	 		$travel_category=TravelCategory::model();
	 	    $linetype=empty($this->linetype)?array():explode(",",$this->linetype);
	 	    $linetype_name=array();
	 	    foreach($linetype as $key => $value){
	 	    	$travel_category_data=$travel_category->findByPk($value);
	 	    	$linetype_name[]=$travel_category_data->category_name;
	 	    }
	 	    return implode(",",$linetype_name);
	 	    break;
	 	
	    case 'default_hotel':
	    	return $this->Hotels->title;
	    	break;
	    case 'category_id':
	      	return $this->ChannelCategory->name;
	    	break;
	    case 'create_id':
	      return $this->User->user_login;
	      break;
	    case 'status':
	      $travel_status=CV::$travel_status;
	      return $travel_status[$this->status];
	      break;
	    case 'modify_time':
	      return date('Y-m-d H:i:s',$this->modify_time);
	    case 'create_time':
	    	return date('Y-m-d H:i:s',$this->create_time);
	    	break;
	    case 'update_time':
	    	return date('Y-m-d H:i:s',$this->update_time);
	    	break;
		default:
		  return $this->$attribute_id;
			break;
	 }
	}
	
	
	function get_operate(){
		  $user=new User();
		  $user_permission_name=$user->get_permissions_name();
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="<div class='operate_button'>";
		  if($this->status=="3"){
		  	if(Util::is_permission($user_permission_name,"delete"))
		       $return_str.=CHtml::link('彻底删除',array($controller_id."/delete","id"=>$this->id),array('class'=>'operate_green'));
		       
		    if(Util::is_permission($user_permission_name,"status"))
		       $return_str.=CHtml::link('恢复',array($controller_id."/status","id"=>$this->id,'status'=>'1'),array('class'=>'operate_green'));
		  }else{
		  
		  if(Util::is_permission($user_permission_name,"edit"))
		     $return_str.=CHtml::link('修改',array($controller_id."/edit","id"=>$this->id),array('class'=>'operate_green'));
		  if(Util::is_permission($user_permission_name,"status")){
		  	if($this->status=='1'){
		      $return_str.=CHtml::link('审核',array($controller_id."/status","id"=>$this->id,'status'=>'2'),array('class'=>'operate_green'));
		    }else if($this->status=='2'){
		    	$return_str.=CHtml::link('取消审核',array($controller_id."/status","id"=>$this->id,'status'=>'1'),array('class'=>'operate_green'));
		    }else{
		    	
		    }
		  }
		  $return_str.=CHtml::link('预览',"javascript:self.parent.parent.location.href='".Yii::app()->homeUrl."/travel/show/id/".$this->id."'",array('class'=>'operate_green','target'=>'_blank'));
		  if(Util::is_permission($user_permission_name,"status"))
		     $return_str.=CHtml::link('删除',array($controller_id."/status","id"=>$this->id,'status'=>'3'),array('class'=>'operate_green'));
		  }
		  $return_str.="</div>";
		  return $return_str;
	}
	
	
	
		function get_dijie_operate(){
		  $user=new User();
		  $user_permission_name=$user->get_permissions_name();
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="<div class='operate_button'>";
		  if($this->status=="3"){
		  	if(Util::is_permission($user_permission_name,"delete"))
		       $return_str.=CHtml::link('彻底删除',array($controller_id."/delete","id"=>$this->id),array('class'=>'operate_green'));
		       
		    if(Util::is_permission($user_permission_name,"status"))
		       $return_str.=CHtml::link('恢复',array($controller_id."/status","id"=>$this->id,'status'=>'1'),array('class'=>'operate_green'));
		  }else{
		  
		  if(Util::is_permission($user_permission_name,"edit"))
		     $return_str.=CHtml::link('修改',array($controller_id."/edit","id"=>$this->id),array('class'=>'operate_green'));
		  $return_str.=CHtml::link('预览',"javascript:self.parent.parent.location.href='".Yii::app()->homeUrl."/travel/show/id/".$this->id."'",array('class'=>'operate_green','target'=>'_blank'));
		  if(Util::is_permission($user_permission_name,"status"))
		     $return_str.=CHtml::link('删除',array($controller_id."/status","id"=>$this->id,'status'=>'3'),array('class'=>'operate_green'));
		  }
		  $return_str.="</div>";
		  return $return_str;
	}
	//获得线路的属性图片
	function show_attr_attribute($id=""){
		if(!empty($id)){
			$travel_data=$this->findByPk($id);
			$attr=$travel_data->attr;
		}else{
			$attr=$this->attr;
		}
		$return_str="";
		$attr_array=explode(",",$attr);
		if(in_array("p",$attr_array)){
			$return_str.="&nbsp;&nbsp;<img src='/themes/travel/css/images/orderOnLine.gif' width='73' height='15'/>";
		}
		
		if(in_array("t",$attr_array)){
			$return_str.="&nbsp;&nbsp;<img src='/themes/travel/css/images/tejia_img.png' width='44' height='19'/>";
		}
		
		if(in_array("f",$attr_array)){
			$return_str.="&nbsp;&nbsp;<img src='/themes/travel/css/images/remai_img.png' width='44' height='19'/>";
		}
		
		if(in_array("c",$attr_array)){
			$return_str.="&nbsp;&nbsp;<img src='/themes/travel/css/images/tuijian_img.png' width='44' height='19'/>";
		}
		return $return_str;
		
	}
	
		//获得搜索页面线路的属性图片
	function show_search_attr_attribute($id=""){
		if(!empty($id)){
			$travel_data=$this->findByPk($id);
			$attr=$travel_data->attr;
		}else{
			$attr=$this->attr;
		}
		$return_str="";
		$attr_array=explode(",",$attr);
	
		if(in_array("t",$attr_array)){
			$return_str.="<span class='characteristic_img'><img src='/themes/travel/css/images/tejia_img.png' width='44' height='19'/></span>";
		}
		
		if(in_array("f",$attr_array)){
			$return_str.="<span class='characteristic_img'><img src='/themes/travel/css/images/remai_img.png' width='44' height='19'/></span>";
		}
		
		if(in_array("c",$attr_array)){
			$return_str.="<span class='characteristic_img'><img src='/themes/travel/css/images/tuijian_img.png' width='44' height='19'/></span>";
		}
		return $return_str;
		
	}
	
	
	
	//获得线路的出发时间
	function show_travel_date($trave_id=""){
		 $travel_id=empty($travel_id)?$this->id:$travel_id;
		 $travel_date=TravelDate::model();
		 $travel_date_number=$travel_date->count("t.travel_id=:travel_id",array(':travel_id'=>$travel_id));
		 $return_array=CHtml::link("出发时间(".$travel_date_number.")",'javascript:void(0);',array('class'=>'operate_green','onclick'=>"javascript:frame_travel('".Yii::app()->getController()->createUrl('traveldate/index')."','线路开始时间','".$travel_id."');"));
		 return $return_array;
	}
	//获得线路景区
	function show_travel_scenic($trave_id=""){
		 $travel_id=empty($travel_id)?$this->id:$travel_id;
		 $travel_area=TravelArea::model();
		 $travel_area_number=$travel_area->count("t.travel_id=:travel_id",array(':travel_id'=>$travel_id));
		 $return_array=CHtml::link("线路景区(".$travel_area_number.")",'javascript:void(0);',array('class'=>'operate_green','onclick'=>"javascript:frame_travel('".Yii::app()->getController()->createUrl('travelarea/index')."','线路景区','".$travel_id."');"));
		 return $return_array;
	}
	
	//获得线路行程
	function show_travel_route($trave_id=""){
		 $travel_id=empty($travel_id)?$this->id:$travel_id;
		 $travel_route=TravelRoute::model();
		 $travel_route_number=$travel_route->count("t.travel_id=:travel_id",array(':travel_id'=>$travel_id));
		 $return_array=CHtml::link("线路行程(".$travel_route_number.")",'javascript:void(0);',array('class'=>'operate_green','onclick'=>"javascript:frame_travel('".Yii::app()->getController()->createUrl('travelroute/index')."','线路行程','".$travel_id."');"));
		 return $return_array;
	}
	
	//获得景区图片
	function show_travel_images($trave_id=""){
		 $travel_id=empty($travel_id)?$this->id:$travel_id;
		 $travel_images=TravelImages::model();
		 $travel_images_number=$travel_images->count("t.travel_id=:travel_id",array(':travel_id'=>$travel_id));
		 $return_array=CHtml::link("线路图片(".$travel_images_number.")",'javascript:void(0);',array('class'=>'operate_green','onclick'=>"javascript:frame_travel('".Yii::app()->getController()->createUrl('travelimages/index')."','线路图片','".$travel_id."');"));
		 return $return_array;
	}
	
	
		//获得报名地点
	function show_travel_company($trave_id=""){
		 $travel_id=empty($travel_id)?$this->id:$travel_id;
		 $travel_company=TravelCompany::model();
		 $travel_company_number=$travel_company->count("t.travel_id=:travel_id",array(':travel_id'=>$travel_id));
		 $return_array=CHtml::link("报名地点(".$travel_company_number.")",'javascript:void(0);',array('class'=>'operate_green','onclick'=>"javascript:frame_travel('".Yii::app()->getController()->createUrl('travelcompany/index')."','报名地点','".$travel_id."');"));
		 return $return_array;
	}
	
		//获得报名地点
	function show_travel_address($trave_id=""){
		 $travel_id=empty($travel_id)?$this->id:$travel_id;
		 $travel_address=TravelAddress::model();
		 $travel_address_number=$travel_address->count("t.travel_id=:travel_id",array(':travel_id'=>$travel_id));
		 $return_array=CHtml::link("上车地点(".$travel_address_number.")",'javascript:void(0);',array('class'=>'operate_green','onclick'=>"javascript:frame_travel('".Yii::app()->getController()->createUrl('traveladdress/index')."','上车地点','".$travel_id."');"));
		 return $return_array;
	}
	
	function show_company_name(){
		return '<a href="javascript:frame_view(\'/admin.php/company/view\',\'company\',\''.$this->company_id.'\');">'.$this->Company->company_name.'</a>';
	}
	
	
	
	function set_channel_link($pattern,$id){
		switch($pattern){
        		case 'archives':
    	      	return Yii::app()->getController()->createUrl("mchannels/show",array('id'=>$id));	
        		  break;
        		case 'travel':
        		  return Yii::app()->getController()->createUrl("travel/show",array('id'=>$id));
        		  break;
        		case 'downloads':
              return Yii::app()->getController()->createUrl("downloads/show",array('id'=>$id));
        		  break;
        		case 'gallery':
        		   return Yii::app()->getController()->createUrl("gallery/show",array('id'=>$id));
        		  break;
        		default:
        		  return Yii::app()->getController()->createUrl("mchannels/show",array('id'=>$id));	
        		  break;
    }
	
	}
	function show_channel($id){
		$travel_data=$this->with("Channels")->findByPk($id);
		return $travel_data->Channels->name;
	}
	
	function show_category($id){
		$travel_data=$this->with("ChannelCategory")->findByPk($id);
		return $travel_data->ChannelCategory->name;  
	}
	function show_create_id($id){
		$travel_data=$this->with("User")->findByPk($id);
		return $travel_data->User->user_login;
	}
	//获得线路的第一个图片做为封面
	function get_first_image($travel_id){
		$travel_image=TravelImages::model();
		$travel_image_data=$travel_image->with("Images")->find(array('select'=>'t.id','condition'=>'t.travel_id=:travel_id','params'=>array(':travel_id'=>$travel_id),'order'=>' t.id ASC '));
		return $travel_image_data->Images->src;
	}
	
	
	//获取不同线路的目的地
	function get_end_region($channel_id,$region_id="",$limit='10',$attr=""){
		if(empty($region_id)){
			$ip_convert=IpConvert::get();
		  $region_data=$ip_convert->init_region();
      $region_id=$region_data['id'];			
		}
		$condition="t.channel_id=:channel_id AND t.start_region=:start_region AND t.status=:status";
		$params=array(':channel_id'=>$channel_id,':start_region'=>$region_id,':status'=>'2');
		if(!empty($attr)){
			$attr=explode(",",$attr);
			if(is_array($attr)){
				foreach($attr as $key => $value){
					$condition.=" AND FIND_IN_SET('".$value."',t.attr)>0";
				}
			}else{
				$condition.=" AND FIND_IN_SET('".$attr."',t.attr)>0";
			}
		}
			$search_condition=array('select'=>'DISTINCT(t.end_region) as end_region,COUNT(t.end_region) as count_end_region','condition'=>$condition,'params'=>$params,'order'=>'count_end_region DESC','group'=>'t.end_region','together'=>true);
			if($limit!=-1){
				$search_condition['limit']=$limit;
			}
			$travel_datas=$this->with("EndRegion")->findAll($search_condition);
			$region_datas=array();
			foreach($travel_datas as $key => $value){
				$region_datas[]=$value->EndRegion;
			}
		  return $region_datas;
	}
	
	
		//获取搜索时的线路的目的地
	function get_search_end_region($limit='10'){
			$search_condition=array('select'=>'DISTINCT(t.end_region) as end_region,COUNT(t.end_region) as count_end_region','condition'=>" t.status=:status",'params'=>array(':status'=>'2'),'order'=>'count_end_region DESC','group'=>'t.end_region','together'=>true);
			if($limit!=-1){
				$search_condition['limit']=$limit;
			}
			$travel_datas=$this->with("EndRegion")->findAll($search_condition);
			$region_datas=array();
			foreach($travel_datas as $key => $value){
				$tem_array=array();
				$tem_array['id']=$value->EndRegion->region_id;
				$tem_array['name']=$value->EndRegion->region_name;
				$region_datas[]=$tem_array;
			}
		  return $region_datas;
	}
	
	
	//获取线路的资料
	function get_travel_datas($channel_id,$end_region="",$attr="",$linetype="",$limit=10,$sort="update_time",$sort_type="DESC"){
		$condition=array();
		$params=array();
		if(!empty($channel_id)){
			$condition[]="t.channel_id=:channel_id";
			$params[':channel_id']=$channel_id;
		}
		if(!empty($end_region)){
			$condition[]="t.end_region=:end_region";
			$params[':end_region']=$end_region;
		}
		if(!empty($attr)){
			$attr=explode(",",$attr);
			if(is_array($attr)){
				foreach($attr as $key => $value){
					$condition[]="FIND_IN_SET('".$value."',t.attr)>0";
				}
			}else{
				$condition[]="FIND_IN_SET('".$attr."',t.attr)>0";
			}
		}
	 if(!empty($linetype)){
			$linetype=explode(",",$linetype);
			if(is_array($linetype)){
				foreach($linetype as $key => $value){
					$condition[]="FIND_IN_SET('".$value."',t.linetype)>0";
				}
			}else{
				$condition[]="FIND_IN_SET('".$linetype."',t.linetype)>0";
			}
		}
		$condition[]="t.status=:status";
		$params[':status']='2';
		
	  $ip_convert=IpConvert::get();
		$region_data=$ip_convert->init_region();
    $region_id=$region_data['id'];
    $condition[]="t.start_region=:start_region";
    $params[':start_region']=$region_id;
    
		$order="t.".$sort." ".$sort_type;
		$search_condition=array('condition'=>implode(" AND ",$condition),'params'=>$params,'order'=>$order);
		if($limit!=-1){
				$search_condition['limit']=$limit;
			}
		$travel_datas=$this->findAll($search_condition);
		return $travel_datas;
	}
	
	//获取线路的最起步价钱
	function get_travel_price($travel_id){
	
		$travel_date=TravelDate::model();
		$travel_date_data=$travel_date->find(array('select'=>'Min(t.adult_price) as adult_price','condition'=>'t.travel_id=:travel_id','params'=>array(':travel_id'=>$travel_id),'group'=>'t.travel_id'));
		
		return $travel_date_data->adult_price;
	}
	
	function get_jiesuan_travel_price($travel_id){
	
		$travel_date=TravelDate::model();
		$travel_date_data=$travel_date->find(array('select'=>'Min(t.fa_price) as fa_price','condition'=>'t.travel_id=:travel_id','params'=>array(':travel_id'=>$travel_id),'group'=>'t.travel_id'));
		
		return $travel_date_data->fa_price;
	}
	
	function get_child_price($travel_id){
	
		$travel_date=TravelDate::model();
		$travel_date_data=$travel_date->find(array('select'=>'Min(t.child_price) as child_price','condition'=>'t.travel_id=:travel_id','params'=>array(':travel_id'=>$travel_id),'group'=>'t.travel_id'));
		
		return $travel_date_data->child_price;
	}
	
	function get_jiesuan_child_price($travel_id){
	
		$travel_date=TravelDate::model();
		$travel_date_data=$travel_date->find(array('select'=>'Min(t.fc_price) as fc_price','condition'=>'t.travel_id=:travel_id','params'=>array(':travel_id'=>$travel_id),'group'=>'t.travel_id'));
		
		return $travel_date_data->fc_price;
	}
	
	
	function get_travel_date($travel_id){
		$travel_date=TravelDate::model();
		$travel_date_data=$travel_date->findAll(array('condition'=>'t.travel_id=:travel_id','params'=>array(':travel_id'=>$travel_id)));
		$travel_date_array=array();
		$regular_month=CV::$regular_month;
		$regular_day=CV::$regular_day;
		foreach($travel_date_data as $key => $value){
			switch($value->date_type){
				case '1':
				  $travel_date_array[]=$value->travel_date."出发(".$regular_month[$value->type_value1].$regular_day[$value->type_value2].")";
				  break;
				case '2':
				 $travel_date_array[]=$value->travel_date."出发(".$value->type_value1."到".$value->type_value2.")";
				  break;
				default:
				  break;
				
			}
		}
		return implode(",<br/>",$travel_date_array);
	}
	
	function get_date_select($trave_id=""){
		    $travel_date_model=TravelDate::model();
		    $current_date=date("Y-m-d");
		    $current_month=date("m");
		    $current_day=date("d");
        $travel_date_datas=$travel_date_model->findAll("t.travel_id=:travel_id AND ((t.date_type=1) OR (t.date_type=2 AND t.type_value2>='".$current_date."') )",array(':travel_id'=>$trave_id));
        $mix_date=array();
        foreach($travel_date_datas as $key => $value){
        	$id=$value->id;
        	$travel_id=$value->travel_id;
        	$return_array=array();
        	$date_type=$value->date_type;
        	$type_value1=$value->type_value1;
        	$type_value2=$value->type_value2;
        	$travel_date=$value->travel_date;
        	$seats=$value->seats;
        	$adult_price=$value->adult_price;
        	$child_price=$value->child_price;
          $date_year=date("Y",strtotime($travel_date));
          $date_month=date("m",strtotime($travel_date));
        	switch($date_type){
        		case '1':
        		  switch($type_value1){
        		  	case '1':
        		  	   switch($type_value2){
        		  	   	 case '1':
        		  	   	   $current_year=date("Y");
        		  	   	   if($current_year>$date_year){
        		  	   	   	 $date_year=$current_year;
        		  	   	   }
        		  	   	   $return_array=$travel_date_model->get_month_days(mktime(0,0,0,$current_month,1,$date_year));
        		  	   	   $next_array=$travel_date_model->get_month_days(mktime(0,0,0,$current_month+1,1,$date_year));
        		  	   	   break;
        		  	   	 default:
        		  	   	   $current_year=date("Y");
        		  	   	   if($current_year>$date_year){
        		  	   	   	 $date_year=$current_year;
        		  	   	   }
        		  	   	   $return_array=$travel_date_model->get_month_weekly(mktime(0,0,0,$current_month,1,$date_year),$type_value2);
        		  	   	   $next_array=$travel_date_model->get_month_weekly(mktime(0,0,0,$current_month+1,1,$date_year),$type_value2);
        		  	   	  
        		  	   	   break;
        		  	   }
        		  	  break;
        		  	default:

        		  	  switch($type_value2){
        		  	   	 case '1':
        		  	   	   $current_year=date("Y");
        		  	   	   if($current_year>$date_year){
        		  	   	   	 $date_year=$current_year;
        		  	   	   }
        		  	   	   $cul_month=$type_value1-1;
        		  	   	   if(($cul_month < $current_month)&&((12-$current_month+$cul_month) <= 3)){
        		  	   	   	 $date_year=$date_year+1;
        		  	   	   }
        		  	   	   $return_array=$travel_date_model->get_month_days(mktime(0,0,0,$cul_month,1,$date_year));
        		  	   	   break;
        		  	   	 default:
        		  	   	   $current_year=date("Y");
        		  	   	   if($current_year>$date_year){
        		  	   	   	 $date_year=$current_year;
        		  	   	   }
        		  	   	   $cul_month=$type_value1-1;
        		  	   	   if(($cul_month < $current_month)&&((12-$current_month+$cul_month) < 3)){
        		  	   	   	 $date_year=$date_year+1;
        		  	   	   }
        		  	   	   $return_array=$travel_date_model->get_month_weekly(mktime(0,0,0,$cul_month,1,$date_year),$type_value2);
        		  	   	   break;
        		  	   }
        		  	  break;
        		  }
        		  break;
        		case '2':
        		    if(strtotime($type_value1) < strtotime($current_date)){
        		    	 $type_value1=$current_date;
        		    }
        		    $return_array=$travel_date_model->get_period_date($type_value1,$type_value2);
        		    
        		  break;
        		default:
        		  break;
        	}
        	$return_array=array_merge($return_array,(array)$next_array);
        	if(!in_array($travel_date,$return_array)){
        			$return_array[]=$travel_date;
        	}
        	
        	foreach($return_array as $key => $value){
        		$show_array=array();
        		if(strtotime($value)>strtotime($current_date)){
        			$show_array['id']=$id;
        			$show_array['travel_id']=$travel_id;
        			$show_array['date']=$value;
        		  $show_array['seats']=$seats;
        			$show_array['price']=$adult_price;
        			$show_array['child_price']=$child_price;
        			array_push($mix_date,$show_array);
        		}
        	}
        }
        $mix_date=$travel_date_model->date_unique($mix_date);
        usort($mix_date, "date_cmp");//对时间排序
        $return_str="<select name='travel_date' class='play_select' id='travel_date_select'>";
        foreach($mix_date as $key => $value){
        	$return_str.="<option class='travel_date_option' value='".$value['date']."' seats='".$value['seats']."' travel_id='".$value['travel_id']."' date_id='".$value['id']."' price='".$value['price']."' child_price='".$value['child_price']."'>".$value['date'].",成人价:￥".$value['price'].",儿童价:￥".$value['child_price'];
        	$return_str.="</option>";
        }
        $return_str.="</select>";
    	  return $return_str;
		
	}
	function get_admin_date_select($trave_id=""){
		    $travel_date_model=TravelDate::model();
		    $current_date=date("Y-m-d");
		    $current_month=date("m");
		    $current_day=date("d");
        $travel_date_datas=$travel_date_model->findAll("t.travel_id=:travel_id AND ((t.date_type=1) OR (t.date_type=2 AND t.type_value2>='".$current_date."') )",array(':travel_id'=>$trave_id));
        $mix_date=array();
        foreach($travel_date_datas as $key => $value){
        	$id=$value->id;
        	$travel_id=$value->travel_id;
        	$return_array=array();
        	$date_type=$value->date_type;
        	$type_value1=$value->type_value1;
        	$type_value2=$value->type_value2;
        	$travel_date=$value->travel_date;
        	$seats=$value->seats;
        	$adult_price=$value->adult_price;
        	$child_price=$value->child_price;
        	$fa_price=$value->fa_price;
        	$fc_price=$value->fc_price;
          $date_year=date("Y",strtotime($travel_date));
          $date_month=date("m",strtotime($travel_date));
        	switch($date_type){
        		case '1':
        		  switch($type_value1){
        		  	case '1':
        		  	   switch($type_value2){
        		  	   	 case '1':
        		  	   	    $current_year=date("Y");
        		  	   	   if($current_year>$date_year){
        		  	   	   	 $date_year=$current_year;
        		  	   	   }
        		  	   	   $return_array=$travel_date_model->get_month_days(mktime(0,0,0,$current_month,1,$date_year));
        		  	   	   $next_array=$travel_date_model->get_month_days(mktime(0,0,0,$current_month+1,1,$date_year));
        		  	   	   break;
        		  	   	 default:
        		  	   	    $current_year=date("Y");
        		  	   	   if($current_year>$date_year){
        		  	   	   	 $date_year=$current_year;
        		  	   	   }
        		  	   	   $return_array=$travel_date_model->get_month_weekly(mktime(0,0,0,$current_month,1,$date_year),$type_value2);
        		  	   	   $next_array=$travel_date_model->get_month_weekly(mktime(0,0,0,$current_month+1,1,$date_year),$type_value2);
        		  	   	  
        		  	   	   break;
        		  	   }
        		  	  break;
        		  	default:

        		  	  switch($type_value2){
        		  	   	 case '1':
        		  	   	    $current_year=date("Y");
        		  	   	   if($current_year>$date_year){
        		  	   	   	 $date_year=$current_year;
        		  	   	   }
        		  	   	   $cul_month=$type_value1-1;
        		  	   	   if(($cul_month < $current_month)&&((12-$current_month+$cul_month) <= 3)){
        		  	   	   	 $date_year=$date_year+1;
        		  	   	   }
        		  	   	   $return_array=$travel_date_model->get_month_days(mktime(0,0,0,$cul_month,1,$date_year));
        		  	   	   break;
        		  	   	 default:
        		  	   	    $current_year=date("Y");
        		  	   	   if($current_year>$date_year){
        		  	   	   	 $date_year=$current_year;
        		  	   	   }
        		  	   	   $cul_month=$type_value1-1;
        		  	   	   if(($cul_month < $current_month)&&((12-$current_month+$cul_month) < 3)){
        		  	   	   	 $date_year=$date_year+1;
        		  	   	   }
        		  	   	   $return_array=$travel_date_model->get_month_weekly(mktime(0,0,0,$cul_month,1,$date_year),$type_value2);
        		  	   	   break;
        		  	   }
        		  	  break;
        		  }
        		  break;
        		case '2':
        		    if(strtotime($type_value1) < strtotime($current_date)){
        		    	 $type_value1=$current_date;
        		    }
        		    $return_array=$travel_date_model->get_period_date($type_value1,$type_value2);
        		    
        		  break;
        		default:
        		  break;
        	}
        	$return_array=array_merge($return_array,(array)$next_array);
        	if(!in_array($travel_date,$return_array)){
        			$return_array[]=$travel_date;
        	}
        	foreach($return_array as $key => $value){
        		$show_array=array();
        		if(strtotime($value)>strtotime($current_date)){
        			$show_array['id']=$id;
        			$show_array['travel_id']=$travel_id;
        			$show_array['date']=$value;
        		  $show_array['seats']=$seats;
        			$show_array['price']=$adult_price;
        			$show_array['child_price']=$child_price;
        			$show_array['fa_price']=$fa_price;
        			$show_array['fc_price']=$fc_price;
        			array_push($mix_date,$show_array);
        		}
        	}
        }
        $mix_date=$travel_date_model->date_unique($mix_date);
        usort($mix_date, "date_cmp");//对时间排序
        $return_str="<select name='travel_date' class='play_select' id='travel_date_select'>";
        foreach($mix_date as $key => $value){
        	$return_str.="<option class='travel_date_option' value='".$value['date']."' seats='".$value['seats']."' travel_id='".$value['travel_id']."' date_id='".$value['id']."' price='".$value['price']."' child_price='".$value['child_price']."'>".$value['date'].",成人价:".$value['price'].",结算价:".$value['fa_price'].",儿童价:".$value['child_price'].",结算价:".$value['fc_price'];
        	$return_str.="</option>";
        }
        $return_str.="</select>";
    	  return $return_str;
		
	}
	function get_admin_search_date_select($trave_id=""){
		    $travel_date_model=TravelDate::model();
		    $current_date=date("Y-m-d");
		    $current_month=date("m");
		    $current_day=date("d");
        $travel_date_datas=$travel_date_model->findAll("t.travel_id=:travel_id AND ((t.date_type=1) OR (t.date_type=2 AND t.type_value2>='".$current_date."') )",array(':travel_id'=>$trave_id));
        $mix_date=array();
        foreach($travel_date_datas as $key => $value){
        	$id=$value->id;
        	$travel_id=$value->travel_id;
        	$return_array=array();
        	$date_type=$value->date_type;
        	$type_value1=$value->type_value1;
        	$type_value2=$value->type_value2;
        	$travel_date=$value->travel_date;
        	$seats=$value->seats;
        	$group=$value->group;
        	$adult_price=$value->adult_price;
        	$child_price=$value->child_price;
        	$fa_price=$value->fa_price;
        	$fc_price=$value->fc_price;
        	
          $date_year=date("Y",strtotime($travel_date));
          $date_month=date("m",strtotime($travel_date));
        	switch($date_type){
        		case '1':
        		  switch($type_value1){
        		  	case '1':
        		  	   switch($type_value2){
        		  	   	 case '1':
        		  	   	    $current_year=date("Y");
        		  	   	   if($current_year>$date_year){
        		  	   	   	 $date_year=$current_year;
        		  	   	   }
        		  	   	   $return_array=$travel_date_model->get_month_days(mktime(0,0,0,$current_month,1,$date_year));
        		  	   	   $next_array=$travel_date_model->get_month_days(mktime(0,0,0,$current_month+1,1,$date_year));
        		  	   	   break;
        		  	   	 default:
        		  	   	    $current_year=date("Y");
        		  	   	   if($current_year>$date_year){
        		  	   	   	 $date_year=$current_year;
        		  	   	   }
        		  	   	   $return_array=$travel_date_model->get_month_weekly(mktime(0,0,0,$current_month,1,$date_year),$type_value2);
        		  	   	   $next_array=$travel_date_model->get_month_weekly(mktime(0,0,0,$current_month+1,1,$date_year),$type_value2);
        		  	   	  
        		  	   	   break;
        		  	   }
        		  	  break;
        		  	default:

        		  	  switch($type_value2){
        		  	   	 case '1':
        		  	   	    $current_year=date("Y");
        		  	   	   if($current_year>$date_year){
        		  	   	   	 $date_year=$current_year;
        		  	   	   }
        		  	   	   $cul_month=$type_value1-1;
        		  	   	   if(($cul_month < $current_month)&&((12-$current_month+$cul_month) <= 3)){
        		  	   	   	 $date_year=$date_year+1;
        		  	   	   }
        		  	   	   $return_array=$travel_date_model->get_month_days(mktime(0,0,0,$cul_month,1,$date_year));
        		  	   	   break;
        		  	   	 default:
        		  	   	    $current_year=date("Y");
        		  	   	   if($current_year>$date_year){
        		  	   	   	 $date_year=$current_year;
        		  	   	   }
        		  	   	   $cul_month=$type_value1-1;
        		  	   	   if(($cul_month < $current_month)&&((12-$current_month+$cul_month) < 3)){
        		  	   	   	 $date_year=$date_year+1;
        		  	   	   }
        		  	   	   $return_array=$travel_date_model->get_month_weekly(mktime(0,0,0,$cul_month,1,$date_year),$type_value2);
        		  	   	   break;
        		  	   }
        		  	  break;
        		  }
        		  break;
        		case '2':
        		    if(strtotime($type_value1) < strtotime($current_date)){
        		    	 $type_value1=$current_date;
        		    }
        		    $return_array=$travel_date_model->get_period_date($type_value1,$type_value2);
        		    
        		  break;
        		default:
        		  break;
        	}
        	$return_array=array_merge($return_array,(array)$next_array);
        	if(!in_array($travel_date,$return_array)){
        			$return_array[]=$travel_date;
        	}
        	foreach($return_array as $key => $value){
        		$show_array=array();
        		if(strtotime($value)>strtotime($current_date)){
        			$travel_order_numbers=TravelOrderNumbers::model();
            	$order_numbers_data=$travel_order_numbers->find("t.travel_id=:travel_id AND t.start_date=:start_date",array(':travel_id'=>$travel_id,':start_date'=>$value));
        			
        			$show_array['id']=$id;
        			$show_array['travel_id']=$travel_id;
        			$show_array['date']=$value;
        			$show_array['buy_numbers']=$order_numbers_data->order_numbers;
        		  $show_array['seats']=$seats;
        		  $show_array['group']=$group;
        			$show_array['price']=$adult_price;
        			$show_array['child_price']=$child_price;
        			$show_array['fa_price']=$fa_price;
        			$show_array['fc_price']=$fc_price;
        			array_push($mix_date,$show_array);
        		}
        	}
        }
        $mix_date=$travel_date_model->date_unique($mix_date);
        usort($mix_date, "date_cmp");//对时间排序
        $return_str="<select name='travel_date' class='admin_play_select' id='travel_date_select'>";
        foreach($mix_date as $key => $value){
        	$return_str.="<option class='travel_date_option' buy_numbers='".$value['buy_numbers']."' value='".$value['date']."' seats='".$value['seats']."' group='".$value['group']."' travel_id='".$value['travel_id']."' date_id='".$value['id']."' price='".$value['price']."' fa_price='".$value['fa_price']."' child_price='".$value['child_price']."' fc_price='".$value['fc_price']."'>".$value['date'];
        	$return_str.="</option>";
        }
        $return_str.="</select>";
    	  return $return_str;
	}
}




function date_cmp($a, $b)
{
    if ($a['date'] == $b['date']) {
        return 0;
    }
    return ($a['date'] < $b['date']) ? -1 : 1;
}