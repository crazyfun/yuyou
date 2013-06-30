<?php

/**
 * This is the model class for table "{{friendlink}}".
 *
 * The followings are the available columns in table '{{friendlink}}':
 * @property string $id
 * @property string $friendlink_img
 * @property string $friendlink_name
 * @property string $friendlink_href
 * @property integer $friendlink_type
 * @property integer $friendlink_sort
 * @property string $friendlink_desc
 * @property string $create_id
 * @property string $create_time
 */
class Friendlink extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Friendlink the static model class
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
		return '{{friendlink}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('friendlink_type, friendlink_sort, friendlink_desc', 'required','message'=>'{attribute}不能为空'),
			array('friendlink_type, friendlink_sort', 'numerical', 'integerOnly'=>true),
			array('friendlink_img', 'length', 'max'=>100),
			array('friendlink_name', 'length', 'max'=>30),
			array('friendlink_href', 'length', 'max'=>200),
			array('create_id, create_time', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, friendlink_img, friendlink_name, friendlink_href, friendlink_type, friendlink_sort, friendlink_desc, create_id, create_time', 'safe', 'on'=>'search'),
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
			'Type'=>array(self::BELONGS_TO,'FriendlinkType','friendlink_type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'friendlink_img' => '网站LOGO',
			'friendlink_name' => '链接名称',
			'friendlink_href' => '链接地址',
			'friendlink_type' => '网站类型',
			'friendlink_sort' => '链接排序',
			'friendlink_desc' => '网站简介',
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
		$criteria->compare('friendlink_img',$this->friendlink_img,true);
		$criteria->compare('friendlink_name',$this->friendlink_name,true);
		$criteria->compare('friendlink_href',$this->friendlink_href,true);
		$criteria->compare('friendlink_type',$this->friendlink_type);
		$criteria->compare('friendlink_sort',$this->friendlink_sort);
		$criteria->compare('friendlink_desc',$this->friendlink_desc,true);
		$criteria->compare('create_id',$this->create_id,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

//删除一笔数据
	public function delete_table_datas($pk_id="",$condition=array()){
		if(!empty($pk_id)){
			$model_datas=$this->get_table_datas($pk_id);
			if(!empty($model_datas->friendlink_img)){
				 Util::deleteFile($model_datas->friendlink_img);
				 $thumb_15_file=Util::rename_thumb_file(15,15,'',$model_datas->friendlink_img);
				 Util::deleteFile($thumb_15_file);
			}
			$datas=$this->deleteByPk($pk_id,"",array());
		}else{
			 $model_datas=$this->get_table_datas("",$condition);
			 foreach($model_datas as $key => $value){
			 	if(!empty($value->friendlink_img)){
				   Util::deleteFile($value->friendlink_img);
				   $thumb_15_file=Util::rename_thumb_file(15,15,'',$value->friendlink_img);
				   Util::deleteFile($thumb_15_file);
			   }
			 }
       $datas=$this->deleteAll($condition);
		}
		return $datas;
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
				$this->create_time=Util::current_time('timestamp');
			}else{
				$this->create_id=Yii::app()->user->id;
				$this->create_time=Util::current_time('timestamp');
			}
			return true;
		}else{
			return false;
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
	
	function format_create_time(){
		return date("Y-m-d H:i:s",$this->create_time);
	}
  /*
	* 获取友情连接的分类
	* @return array 友情连接分类数组array('101'=>'计算机')
	* @auther lxf
	* @version 1.0.0
	*/
	public function get_friendlink_type(){
	   $friendlink_type_datas=FriendlinkType::model()->findAll(array('select'=>'id,type_name','order'=>'id ASC'));
	   $return_types=array();
	   foreach($friendlink_type_datas as $key => $value){
	     $return_types[$value->id]=$value->type_name;	
	  }
	  return $return_types;
	}
	/*
	* 获取友情链接的图片
	* @return string 友情链接的图片
	* @auther lxf
	* @version 1.0.0
	*/
	public function show_friendlink_img(){
		return CHtml::image("/".$this->friendlink_img,"",array("width"=>'15','height'=>'15'));
	}
	

}