<?php

/**
 * This is the model class for table "{{gallery_images}}".
 *
 * The followings are the available columns in table '{{gallery_images}}':
 * @property string $id
 * @property string $gallery_id
 * @property string $image_id
 * @property string $create_id
 * @property string $create_time
 */
class GalleryImages extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GalleryImages the static model class
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
		return '{{gallery_images}}';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  	array('gallery_id,image_id','required','message'=>'{attribute}不能为空'),
			array('gallery_id, image_id, create_id', 'length', 'max'=>11),
			array('create_time', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, gallery_id, image_id, create_id, create_time', 'safe', 'on'=>'search'),
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
			'Gallery'=>array(self::BELONGS_TO,'Gallery','gallery_id'),
			'Images'=>array(self::BELONGS_TO,'Images','image_id'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'gallery_id' => '图集',
			'image_id' => '图片',
			'create_id' => '创建人',
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
		$criteria->compare('gallery_id',$this->gallery_id,true);
		$criteria->compare('image_id',$this->image_id,true);
		$criteria->compare('create_id',$this->create_id,true);
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
			$this->deleteByPk($id,"",array());
			$is_delete=$this->count("gallery_id=:gallery_id AND image_id=:image_id",array(':gallery_id'=>$value->gallery_id,":image_id"=>$value->image_id));
			if(!$is_delete)
		   	$this->delete_relation($value->gallery_id,$value->image_id);
		}
	 }else{
	 	  $id=$table_datas->id;
			$this->deleteByPk($id,"",array());
			$is_delete=$this->count("gallery_id=:gallery_id AND image_id=:image_id",array(':gallery_id'=>$table_datas->gallery_id,":image_id"=>$table_datas->image_id));
			if(!$is_delete)
		   	$this->delete_relation($table_datas->gallery_id,$table_datas->image_id);
	 }
	 return true;
	}
	
	public function delete_relation($gallery_id,$image_id){
		$images=Images::model();
		$images_data=$images->findByPk($image_id);
		$images_name=$images_data->src;
		$gallery=Gallery::model();
		$gallery_data=$gallery->findByPk($gallery_id);
		$channel_id=$gallery_data->channel_id;
		$channels=Channels::model();
  		$channels_data=$channels->findByPk($channel_id);
  		$image_size=$channels_data->image_size;
  		$explode_image_size=explode(",",$image_size);
  		foreach($explode_image_size as $key => $value){
  			$tem_explode=explode("*",$value);
  			$width=$tem_explode[0];
  			$height=$tem_explode[1];
  			$thumb_file_name=Util::rename_thumb_file($width,$height,"",$images_name);
  			Util::deleteFile($thumb_file_name);
  		}	
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
			   $this->create_id=Yii::app()->user->id;
			   $this->create_time=time();
			   $gallery_id=$this->gallery_id;
			   $image_id=$this->image_id;
			   $gallery=Gallery::model();
			   $images=Images::model();
			   $gallery_data=$gallery->findByPk($gallery_id);
			   $images_data=$images->findByPk($image_id);
			   $this->resize_archive_image($gallery_data->channel_id,"",$images_data->src);
			}else{  
			}
			return true;
		}else{
			return false;
		}
	}

	
	function show_attribute($attribute_id){
	 switch($attribute_id){
	 	case 'gallery_id':
	 		return 	$this->Gallery->title;
	 		break;
	  case 'image_id':
	    	return $this->Images->show_attribute("src");
	    	break;
	  case 'create_id':
	    	return $this->User->user_login;
	        break;
	  
	  case 'create_time':
	    	return date("Y-m-d H:i:s",$this->create_time);
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
		  if(Util::is_permission($user_permission_name,"edit"))
		     $return_str.=CHtml::link('修改',array($controller_id."/edit","id"=>$this->id),array('class'=>'operate_green'));
		  if(Util::is_permission($user_permission_name,"delete"))
		     $return_str.=CHtml::link('删除','javascript:void(0);',array('id'=>'delete_'.$this->id,'class'=>'operate_red','onclick'=>"javascript:ajax_delete('".Yii::app()->getController()->createUrl('main/delete')."','".get_class($this)."','".$this->id."');"));
		   $return_str.="</div>";
		  return $return_str;
	}
	//增减线路图片需根据栏目切割图片
function resize_archive_image($channel_id,$save_path,$image){
  	$channels=Channels::model();
  	$channels_data=$channels->findByPk($channel_id);
  	$image_size=$channels_data->image_size;
  	if(!empty($image_size)){
  	$explode_image_size=explode(",",$image_size);
  	foreach($explode_image_size as $key => $value){
  		$tem_explode=explode("*",$value);
  		$width=$tem_explode[0];
  		$height=$tem_explode[1];
  		Util::cut_image($width,$height,$save_path,$image);
  	}	
  }
  }
  
  
}