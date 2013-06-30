<?php

/**
 * This is the model class for table "{{hotels}}".
 *
 * The followings are the available columns in table '{{hotels}}':
 * @property string $id
 * @property string $channel_id
 * @property string $category_id
 * @property string $title
 * @property string $stitle
 * @property string $attr
 * @property string $archive_tags
 * @property string $seo_keywords
 * @property string $seo_describe
 * @property string $open_time
 * @property string $hotel_address
 * @property string $hotel_coordinate
 * @property string $hotel_telephone
 * @property string $hotel_level
 * @property string $hotel_region
 * @property string $hotel_price_limit
 * @property string $brand_id
 * @property string $facility
 * @property string $content
 * @property string $scontent
 * @property integer $is_comment
 * @property integer $is_vot
 * @property integer $is_relation
 * @property string $views
 * @property string $vots
 * @property string $goods
 * @property string $bads
 * @property integer $sort
 * @property integer $status
 * @property string $company_id
 * @property string $create_id
 * @property string $modify_time
 * @property string $create_time
 * @property string $update_time
 */
class Hotels extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Hotels the static model class
	 */
	 
	public $href="";
  public $channel_name="";
  public $channel_href="";
  public $category_name="";
  public $category_href="";
  public $create_name="";
  public $price="";
  public $diff_nums="";
  
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{hotels}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('channel_id,title,hotel_level,hotel_region,hotel_price_limit,company_id','required','message'=>'{attribute}不能为空'),
			array('is_comment, is_vot, is_relation, sort, status', 'numerical', 'integerOnly'=>true),
			array('channel_id, category_id, hotel_level, buy_numbers,hotel_region, hotel_price_limit, brand_id, views, vots, goods, bads, company_id, create_id', 'length', 'max'=>11),
			array('title, seo_keywords, seo_describe, hotel_address', 'length', 'max'=>200),
			array('stitle, attr, archive_tags', 'length', 'max'=>100),
			array('number,facility,open_time, hotel_coordinate, hotel_telephone, modify_time', 'length', 'max'=>30),
			array('create_time, update_time', 'length', 'max'=>10),
			array('content, scontent', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, number,channel_id, category_id, title, stitle, buy_numbers,attr, archive_tags, seo_keywords, seo_describe, open_time, hotel_address, hotel_coordinate, hotel_telephone, hotel_level, hotel_region, hotel_price_limit, brand_id, facility, content, scontent, is_comment, is_vot, is_relation, views, vots, goods, bads, sort, status, company_id, create_id, modify_time, create_time, update_time', 'safe', 'on'=>'search'),
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
			'Company'=>array(self::BELONGS_TO,'Company','company_id'),
			'HotelRegion'=>array(self::BELONGS_TO,'Region','hotel_region'),
			'HotelsBrand'=>array(self::BELONGS_TO,'HotelsBrand','brand_id'),
			'HotelsBeds'=>array(self::HAS_MANY,'HotelsBeds','hotels_id'),
			'HotelsArea'=>array(self::HAS_MANY,'HotelsArea','hotels_id'),
			'HotelsImages'=>array(self::HAS_MANY,'HotelsImages','hotels_id'),
			'HotelsTran'=>array(self::HAS_MANY,'HotelsTran','hotels_id'),
			'HotelsPrice'=>array(self::HAS_MANY,'HotelsPrice','hotels_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'number'=>'酒店编号',
			'channel_id' => '栏目',
			'category_id' => '酒店分类',
			'title' => '酒店名称',
			'stitle' => '简短名称',
			'attr' => '酒店属性',
			'archive_tags' => '标签',
			'seo_keywords' => 'Seo关键字',
			'seo_describe' => 'Seo描述',
			'open_time' => '开业时间',
			'hotel_address' => '酒店地址',
			'hotel_coordinate' => '酒店坐标',
			'hotel_telephone' => '酒店座机',
			'hotel_level' => '酒店星级',
			'hotel_region' => '所属区域',
			'hotel_price_limit' => '价格范围',
			'brand_id' => '品牌',
			'facility' => '酒店设施',
			'buy_numbers'=>'购买数量',
			'content' => '酒店描述',
			'scontent' => '简短描述',
			'is_comment' => '是否评论',
			'is_vot' => '是否投票',
			'is_relation' => '是否关联',
			'views' => '查看数',
			'vots' => '投票数',
			'goods' => '赞',
			'bads' => '踩',
			'sort' => '排序',
			'status' => '状态',
			'company_id' => '所属公司',
			'create_id' => '创建人',
			'modify_time' => '修改时间',
			'create_time' => '创建时间',
			'update_time' => '更新时间',
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
		$criteria->compare('stitle',$this->stitle,true);
		$criteria->compare('attr',$this->attr,true);
		$criteria->compare('archive_tags',$this->archive_tags,true);
		$criteria->compare('seo_keywords',$this->seo_keywords,true);
		$criteria->compare('seo_describe',$this->seo_describe,true);
		$criteria->compare('open_time',$this->open_time,true);
		$criteria->compare('hotel_address',$this->hotel_address,true);
		$criteria->compare('hotel_coordinate',$this->hotel_coordinate,true);
		$criteria->compare('hotel_telephone',$this->hotel_telephone,true);
		$criteria->compare('hotel_level',$this->hotel_level,true);
		$criteria->compare('hotel_region',$this->hotel_region,true);
		$criteria->compare('hotel_price_limit',$this->hotel_price_limit,true);
		$criteria->compare('brand_id',$this->brand_id,true);
		$criteria->compare('facility',$this->facility,true);
		$criteria->compare('buy_numbers',$this->buy_numbers,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('scontent',$this->scontent,true);
		$criteria->compare('is_comment',$this->is_comment);
		$criteria->compare('is_vot',$this->is_vot);
		$criteria->compare('is_relation',$this->is_relation);
		$criteria->compare('views',$this->views,true);
		$criteria->compare('vots',$this->vots,true);
		$criteria->compare('goods',$this->goods,true);
		$criteria->compare('bads',$this->bads,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('status',$this->status);
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('create_id',$this->create_id,true);
		$criteria->compare('modify_time',$this->modify_time,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
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
		$condition=array('condition'=>"hotels_id=:hotels_id",'params'=>array(':hotels_id'=>$id));
		$hotels_area=HotelsArea::model();
		$hotels_area->delete_table_datas("",$condition);
		$hotels_beds=HotelsBeds::model();
		$hotels_beds->delete_table_datas("",$condition);
		$hotels_images=HotelsImages::model();
		$hotels_images->delete_table_datas("",$condition);
		$hotels_tran=HotelsTran::model();
		$hotels_tran->delete_table_datas("",$condition);
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
				  $serial_data=$serial->find("serial_name=:serial_name",array(':serial_name'=>'Hotles Number'));
				  $this->number="HTS".$serial_data->serial_value;
           
				  $this->create_id=Yii::app()->user->id;
			    $this->create_time=time();
			    $this->update_time=time();
			    $serial->updateAll(array('serial_value'=>$serial_data->serial_value+1),'serial_name=:serial_name',array(':serial_name'=>'Hotles Number'));
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
	 	case 'hotel_region':
	 		return $this->HotelRegion->region_name;
	 	    break;
	 	case 'hotel_level':
	 		$HOTELS_LEVEL=CV::$HOTELS_LEVEL;
	 		return $HOTELS_LEVEL[$this->hotel_level];
	 		break;
	 	case 'hotel_price_limit':
	 		$HOTEL_PRICE_LIMIT=CV::$HOTEL_PRICE_LIMIT;
	 		return $HOTEL_PRICE_LIMIT[$this->hotel_price_limit];
	 		break;
	  case 'facility':
	 		$FACILITY=CV::$FACILITY;
	 	    $hotel_facility=$this->facility;
	 	    $hotel_facility_explode=explode(",",$hotel_facility);
	 	    $facility_array=array();
	 	    foreach($hotel_facility_explode as $key => $value){
	 	       array_push($facility_array,$FACILITY[$value]);
	 	    }
	 		return implode(",",$facility_array);
	 		break;
	 	case 'brand_id':
	 		return $this->HotelsBrand->brand_name;
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
		  $return_str.=CHtml::link('预览',"javascript:self.parent.parent.location.href='".Yii::app()->homeUrl."/hotels/show/id/".$this->id."'",array('class'=>'operate_green','target'=>'_blank'));
		  if(Util::is_permission($user_permission_name,"status"))
		     $return_str.=CHtml::link('删除',array($controller_id."/status","id"=>$this->id,'status'=>'3'),array('class'=>'operate_green'));
		  }
		  $return_str.="</div>";
		  return $return_str;
	}
	
	
		function get_hotels_operate(){
		  $user=new User();
		  $user_permission_name=$user->get_permissions_name();
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="<div class='operate_button'>";
	
		  
		  if(Util::is_permission($user_permission_name,"edit"))
		     $return_str.=CHtml::link('修改',array($controller_id."/edit","id"=>$this->id),array('class'=>'operate_green'));
		  $return_str.=CHtml::link('预览',"javascript:self.parent.parent.location.href='".Yii::app()->homeUrl."/hotels/show/id/".$this->id."'",array('class'=>'operate_green','target'=>'_blank'));
		 
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
        		case 'hotels':
        			return Yii::app()->getController()->createUrl("hotels/show",array('id'=>$id));
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
	
		//获得线路的出发时间
	function show_hotels_area($hotels_id=""){
		 $hotels_id=empty($hotels_id)?$this->id:$hotels_id;
		 $hotels_area=HotelsArea::model();
		 $hotels_area_number=$hotels_area->count("t.hotels_id=:hotels_id",array(':hotels_id'=>$hotels_id));
		 $return_array=CHtml::link("周边景区(".$hotels_area_number.")",'javascript:void(0);',array('class'=>'operate_green','onclick'=>"javascript:frame_hotels('".Yii::app()->getController()->createUrl('hotelsarea/index')."','周边景区','".$hotels_id."');"));
		 return $return_array;
	}
	
			//获得线路的出发时间
	function show_hotels_beds($hotels_id=""){
		 $hotels_id=empty($hotels_id)?$this->id:$hotels_id;
		 $hotels_beds=HotelsBeds::model();
		 $hotels_beds_number=$hotels_beds->count("t.hotels_id=:hotels_id",array(':hotels_id'=>$hotels_id));
		 $return_array=CHtml::link("酒店房型(".$hotels_beds_number.")",Yii::app()->getController()->createUrl('hotelsbeds/index',array('hotels_id'=>$hotels_id)),array('class'=>'operate_green'));
		 return $return_array;
	}
	
				//获得线路的出发时间
	function show_hotels_images($hotels_id=""){
		 $hotels_id=empty($hotels_id)?$this->id:$hotels_id;
		 $hotels_images=HotelsImages::model();
		 $hotels_images_number=$hotels_images->count("t.hotels_id=:hotels_id",array(':hotels_id'=>$hotels_id));
		 $return_array=CHtml::link("酒店图片(".$hotels_images_number.")",'javascript:void(0);',array('class'=>'operate_green','onclick'=>"javascript:frame_hotels('".Yii::app()->getController()->createUrl('hotelsimages/index')."','酒店图片','".$hotels_id."');"));
		 return $return_array;
	}
	
	
	function show_hotels_tran($hotels_id=""){
		 $hotels_id=empty($hotels_id)?$this->id:$hotels_id;
		 $hotels_tran=HotelsTran::model();
		 $hotels_tran_number=$hotels_tran->count("t.hotels_id=:hotels_id",array(':hotels_id'=>$hotels_id));
		 $return_array=CHtml::link("酒店交通(".$hotels_tran_number.")",'javascript:void(0);',array('class'=>'operate_green','onclick'=>"javascript:frame_hotels('".Yii::app()->getController()->createUrl('hotelstran/index')."','酒店交通','".$hotels_id."');"));
		 return $return_array;
	}
		//获得线路的第一个图片做为封面
	function get_first_image($hotels_id){
		$hotels_image=HotelsImages::model();
		$hotels_image_data=$hotels_image->with("Images")->find(array('select'=>'t.id','condition'=>'t.hotels_id=:hotels_id','params'=>array(':hotels_id'=>$hotels_id),'order'=>' t.id ASC '));
		return $hotels_image_data->Images->src;
	}
		//获取线路的最起步价钱
	function get_hotels_price($hotels_id){
		$hotels_price=HotelsPrice::model();
		$hotels_price_data=$hotels_price->find(array('select'=>'Min(t.price) as price','condition'=>'t.hotels_id=:hotels_id','params'=>array(':hotels_id'=>$hotels_id),'group'=>'t.hotels_id'));
		return $hotels_price_data->price;
	}	
	
	
			//获取线路的原价步价钱
	function get_hotels_o_price($hotels_id){
		$hotels_price=HotelsPrice::model();
		$hotels_price_data=$hotels_price->find(array('select'=>'Min(t.o_price) as o_price','condition'=>'t.hotels_id=:hotels_id','params'=>array(':hotels_id'=>$hotels_id),'group'=>'t.hotels_id'));
		return $hotels_price_data->o_price;
	}	
	
	
	
		//获取不同线路的目的地
	function get_end_region($limit='10',$attr=""){
		  $condition="t.status=:status";
		  $params=array(':status'=>'2');
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
			$search_condition=array('select'=>'DISTINCT(t.hotel_region) as hotel_region,COUNT(t.hotel_region) as count_hotel_region','condition'=>$condition,'params'=>$params,'order'=>'count_hotel_region DESC','group'=>'t.hotel_region','together'=>true);
			if($limit!=-1){
				$search_condition['limit']=$limit;
			}
			$hotels_datas=$this->with("HotelRegion")->findAll($search_condition);
			$region_datas=array();
			foreach($hotels_datas as $key => $value){
				$region_datas[]=$value->HotelRegion;
			}
			$return_region_datas=array();
			$region=Region::model();
			foreach($region_datas as $key => $value){
				$parent_id=$value->parent_id;
				$region_id=$value->region_id;
				$region_name=$value->region_name;
				$parent_datas=$region->findByPk($parent_id);
				$tem_region_keys=array_keys($return_region_datas);
				if(!in_array($parent_id,$tem_region_keys)){
					$tem_child_datas=array();
					$tem_child_datas[$region_id]=$region_name;
					$return_region_datas[$parent_id]=array('name'=>$parent_datas->region_name,'children'=>$tem_child_datas);
				}else{
					$tem_child_datas[$region_id]=$region_name;
					$return_region_datas[$parent_id]['children'][$region_id]=$region_name;
				}
			}
			
		  return $return_region_datas;
	}



		//获取不同线路的目的地
	function get_search_end_region($limit='10',$attr=""){
		  $condition="t.status=:status";
		  $params=array(':status'=>'2');
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
			$search_condition=array('select'=>'DISTINCT(t.hotel_region) as hotel_region,COUNT(t.hotel_region) as count_hotel_region','condition'=>$condition,'params'=>$params,'order'=>'count_hotel_region DESC','group'=>'t.hotel_region','together'=>true);
			if($limit!=-1){
				$search_condition['limit']=$limit;
			}
				$hotels_datas=$this->with("HotelRegion")->findAll($search_condition);
			$region_datas=array();
			foreach($hotels_datas as $key => $value){
				$region_datas[]=$value->HotelRegion;
			}
		  return $region_datas;
			
	}
	
		//获取线路的资料
	function get_hotels_datas($category,$end_region="",$attr="",$limit=10,$sort="update_time",$sort_type="DESC",$brand_id=""){
		$condition=array();
		$params=array();
		
		if(!empty($end_region)){
			$condition[]="t.hotel_region=:hotel_region";
			$params[':hotel_region']=$end_region;
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
		if(!empty($category)){
			$condition[]="t.category_id=:category_id";
			$params[':category_id']=$category_id;
		}
		if(!empty($brand_id)){
			$condition[]="t.brand_id=:brand_id";
			$params[':brand_id']=$brand_id;
		}
		$condition[]="t.status=:status";
		$params[':status']='2';

		$order="t.".$sort." ".$sort_type;
		$search_condition=array('condition'=>implode(" AND ",$condition),'params'=>$params,'order'=>$order);
		if($limit!=-1){
				$search_condition['limit']=$limit;
			}
		$hotels_datas=$this->findAll($search_condition);
		return $hotels_datas;
	}
	
	
	//获取酒店的星级图片
	function get_hotels_level($hotels_id=""){
		if(!empty($hotels_id)){
			$hotels_data=$this->findByPk($hotels_id);
		}else{
			$hotels_data=$this;
		}
		$hotel_level=$hotels_data->hotel_level;
		switch($hotel_level){
			case '1':
			  return '<span class="h_z1">&nbsp;</span>';
			  break;
			case '2':
			  return '<span class="h_z2">&nbsp;</span>';
			  break;
			case '3':
			  return '<span class="h_z3">&nbsp;</span>';
			  break;
			case '4':
			  return '<span class="h_z4">&nbsp;</span>';
			  break;
			case '5':
			  return '<span class="h_z5">&nbsp;</span>';
			  break;
			default:
			  break;
		}
	}
	

	
}