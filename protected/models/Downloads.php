<?php

/**
 * This is the model class for table "{{downloads}}".
 *
 * The followings are the available columns in table '{{downloads}}':
 * @property string $id
 * @property string $channel_id
 * @property string $category_id
 * @property string $title
 * @property string $stitle
 * @property string $image
 * @property string $source
 * @property string $auther
 * @property string $attr
 * @property string $downloads_tags
 * @property string $seo_keywords
 * @property string $seo_describe
 * @property string $content
 * @property string $scontent
 * @property integer $soft_type
 * @property integer $soft_license
 * @property integer $soft_language
 * @property string $soft_size
 * @property string $soft_extension
 * @property string $soft_environment
 * @property integer $soft_level
 * @property string $soft_website
 * @property string $soft_demo
 * @property string $downloads_describe
 * @property string $downloads_times
 * @property integer $is_comment
 * @property integer $is_vot
 * @property integer $is_relation
 * @property string $views
 * @property string $vots
 * @property string $goods
 * @property string $bads
 * @property integer $sort
 * @property integer $status
 * @property string $create_id
 * @property string $modify_time
 * @property string $create_time
 * @property string $update_time
 */
class Downloads extends BaseActive
{
  public $href="";
  public $channel_name="";
  public $channel_href="";
  public $category_name="";
  public $category_href="";
  public $create_name="";
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Downloads the static model class
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
		return '{{downloads}}';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('channel_id,title,content,soft_type,soft_license,soft_language,soft_size,soft_extension,soft_environment,soft_level', 'required','message'=>'{attribute}不能为空'),
			array('soft_type, soft_license, soft_language, soft_level, is_comment, is_vot, is_relation, sort, status', 'numerical', 'integerOnly'=>true),
			array('channel_id, category_id, source, downloads_times, views, vots, goods, bads, create_id', 'length', 'max'=>11),
			array('title, seo_keywords, seo_describe', 'length', 'max'=>200),
			array('stitle, image, attr, downloads_tags, soft_environment', 'length', 'max'=>100),
			array('auther, soft_size, soft_extension, soft_website, soft_demo, modify_time', 'length', 'max'=>30),
			array('create_time, update_time', 'length', 'max'=>10),
			array('content, scontent, downloads_describe', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, channel_id, category_id, title, stitle, image, source, auther, attr, downloads_tags, seo_keywords, seo_describe, content, scontent, soft_type, soft_license, soft_language, soft_size, soft_extension, soft_environment, soft_level, soft_website, soft_demo, downloads_describe, downloads_times, is_comment, is_vot, is_relation, views, vots, goods, bads, sort, status, create_id, modify_time, create_time, update_time', 'safe', 'on'=>'search'),
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
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'channel_id' => '频道ID',
			'category_id' => '分类ID',
			'title' => '软件名称',
			'stitle' => '简短名称',
			'image' => '缩略图',
			'source' => '文章来源',
			'auther' => '作者',
			'attr' => '自定义属性',
			'downloads_tags' => '标签',
			'seo_keywords' => 'Seo关键字',
			'seo_describe' => 'Seo描述',
			'content' => '软件描述',
			'scontent' => '简短描述',
			'soft_type' => '软件类型',
			'soft_license' => '授权方式',
			'soft_language' => '界面语言',
			'soft_size' => '软件大小',
			'soft_extension' => '软件扩展名',
			'soft_environment' => '运行环境',
			'soft_level' => '软件等级',
			'soft_website' => '官方网址',
			'soft_demo' => '演示地址',
			'downloads_describe' => '下载描述',
			'downloads_times' => '下载次数',
			'is_comment' => '允许评论',
			'is_vot' => '允许投票',
			'is_relation' => '允许关联',
			'views' => '查看数',
			'vots' => '投票数',
			'goods' => '赞',
			'bads' => '踩',
			'sort' => '文章排序',
			'status' => '审核状态',
			'create_id' => '发布人',
			'modify_time' => '自定义时间',
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
		$criteria->compare('channel_id',$this->channel_id,true);
		$criteria->compare('category_id',$this->category_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('stitle',$this->stitle,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('source',$this->source,true);
		$criteria->compare('auther',$this->auther,true);
		$criteria->compare('attr',$this->attr,true);
		$criteria->compare('downloads_tags',$this->downloads_tags,true);
		$criteria->compare('seo_keywords',$this->seo_keywords,true);
		$criteria->compare('seo_describe',$this->seo_describe,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('scontent',$this->scontent,true);
		$criteria->compare('soft_type',$this->soft_type);
		$criteria->compare('soft_license',$this->soft_license);
		$criteria->compare('soft_language',$this->soft_language);
		$criteria->compare('soft_size',$this->soft_size,true);
		$criteria->compare('soft_extension',$this->soft_extension,true);
		$criteria->compare('soft_environment',$this->soft_environment,true);
		$criteria->compare('soft_level',$this->soft_level);
		$criteria->compare('soft_website',$this->soft_website,true);
		$criteria->compare('soft_demo',$this->soft_demo,true);
		$criteria->compare('downloads_describe',$this->downloads_describe,true);
		$criteria->compare('downloads_times',$this->downloads_times,true);
		$criteria->compare('is_comment',$this->is_comment);
		$criteria->compare('is_vot',$this->is_vot);
		$criteria->compare('is_relation',$this->is_relation);
		$criteria->compare('views',$this->views,true);
		$criteria->compare('vots',$this->vots,true);
		$criteria->compare('goods',$this->goods,true);
		$criteria->compare('bads',$this->bads,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_id',$this->create_id,true);
		$criteria->compare('modify_time',$this->modify_time,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
  //删除一笔数据
	public function delete_table_datas($pk_id="",$condition=array()){
		$table_datas=$this->get_table_datas($pk_id,$condition);
		$downloads_server=DownloadsServer::model();
		if(is_array($table_datas)){
		foreach($table_datas as $key => $value){
			$id=$value->id;
			$channel_id=$value->channel_id;
			$this->deleteByPk($id,"",array());
			$save_path="upload/downloads/".$channel_id;
			Util::deleteDir($save_path);
			$downloads_server->delete_table_datas("",array('condition'=>'downloads_id=:downloads_id','params'=>array(':downloads_id'=>$id)));
		}
	 }else{
	 	  $id=$table_datas->id;
	 	  $channel_id=$value->channel_id;
			$this->deleteByPk($id,"",array());
			$save_path="upload/downloads/".$channel_id;
			Util::deleteDir($save_path);
			$downloads_server->delete_table_datas("",array('condition'=>'downloads_id=:downloads_id','params'=>array(':downloads_id'=>$id)));
	 }
	 return true;
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
			   $this->create_time=time();
			    $this->update_time=time();
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
	 	case 'channel_id':
	 		return $this->Channels->name;
	 		break;
	 	case 'title':
	 	  $config_values=ConfigValues::model();
      $downloads_att_select=$config_values->findAll("FIND_IN_SET(value,'".$this->attr."')>0 AND type=:type",array(':type'=>'1'));
      $att_name=array();
      foreach($downloads_att_select as $key => $value){
      	$att_name[]=$value->name;
      }
	 	  return $this->title."[<font color='#ff6600'>".implode(",",$att_name)."</font>]";
	 	  break;
	 	  
	 	  case 'soft_type':
	 	    $config_values=ConfigValues::model();
	 	    $soft_type=$config_values->get_ralation_values('12');
	 	    return $soft_type[$this->soft_type];
	 	    break;
	 	  
	 	  case 'soft_license':
	 	    $config_values=ConfigValues::model();
	 	    $soft_license=$config_values->get_ralation_values('13');
	 	    return $soft_license[$this->soft_license];
	 	    break;
	 	    
	 	  case 'soft_language':
	 	    $config_values=ConfigValues::model();
	 	    $soft_language=$config_values->get_ralation_values('14');
	 	    return $soft_language[$this->soft_language];
	 	    break;
	 	    
	 	  case 'soft_level':
	 	    $config_values=ConfigValues::model();
	 	    $soft_level=$config_values->get_ralation_values('15');
	 	    $soft_level_value=$soft_level[$this->soft_level];
	 	    switch($soft_level_value){
	 	    	case '一星':
	 	    	  return '★';
	 	    		break;
	 	    	case '二星':
	 	    	  return '★★';
	 	    	  break;
	 	    	case '三星':
	 	    	  return '★★★';
	 	    	  break;
	 	    	case '四星':
	 	    	  return '★★★★';
	 	    	  break;
	 	    	case '五星':
	 	    	  return '★★★★★';
	 	    	  break;
	 	    	default:
	 	    	  break;
	 	    	
	 	    }
	 	   
	 	    break;

	    case 'category_id':
	      return $this->ChannelCategory->name;
	    	break;
	    case 'create_id':
	      return $this->User->user_login;
	      break;
	    case 'status':
	      $downloads_status=CV::$archives_status;
	      return $downloads_status[$this->status];
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
	function show_channel($id){
		$downloads_data=$this->with("Channels")->findByPk($id);
		return $downloads_data->Channels->name;
	}
	function show_category($id){
		$downloads_data=$this->with("ChannelCategory")->findByPk($id);
		return $downloads_data->ChannelCategory->name;  
	}
	function show_create_id($id){
		$downloads_data=$this->with("User")->findByPk($id);
		return $downloads_data->User->user_login;
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
		  $return_str.=CHtml::link('预览',"javascript:self.parent.parent.location.href='".Yii::app()->homeUrl."/downloads/show/id/".$this->id."'",array('class'=>'operate_green','target'=>'_blank'));
		  if(Util::is_permission($user_permission_name,"status"))
		     $return_str.=CHtml::link('删除',array($controller_id."/status","id"=>$this->id,'status'=>'3'),array('class'=>'operate_green'));
		  }
		  $return_str.="</div>";
		  return $return_str;
	}
	
	function show_download_address($downloads_id=""){
		 $downloads_id=empty($downloads_id)?$this->id:$downloads_id;
		 $downloads_server=DownloadsServer::model();
		 $downloads_server_number=$downloads_server->count("t.downloads_id=:downloads_id",array(':downloads_id'=>$downloads_id));
		 $return_array=CHtml::link("查看或增加软件下载列表(".$downloads_server_number.")",'javascript:void(0);',array('class'=>'operate_green','onclick'=>"javascript:frame_download('".Yii::app()->getController()->createUrl('downloadsserver/index')."','下载列表','".$downloads_id."');"));
		 return $return_array;
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
        		  return  Yii::app()->getController()->createUrl("mchannels/show",array('id'=>$id));	
        		  break;
    }
	
	}
}