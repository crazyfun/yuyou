<?php

/**
 * This is the model class for table "{{support_content}}".
 *
 * The followings are the available columns in table '{{support_content}}':
 * @property string $id
 * @property string $relation_id
 * @property string $href
 * @property string $content
 * @property string $image
 * @property string $reply_id
 * @property string $reply_content
 * @property string $reply_time
 * @property string $create_time
 */
class SupportContent extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SupportContent the static model class
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
		return '{{support_content}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('relation_id','required','message'=>'{attribute}不能为空'),
			array('relation_id, reply_id, reply_time, create_time', 'length', 'max'=>11),
			array('href, image', 'length', 'max'=>100),
			array('content, reply_content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, relation_id, href, content, image, reply_id, reply_content, reply_time, create_time', 'safe', 'on'=>'search'),
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
		  'ReplyUser'=>array(self::BELONGS_TO,'User','reply_id'),
		  'ServiceSupport'=>array(self::BELONGS_TO,'ServiceSupport','relation_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'relation_id' => '关联ID',
			'href' => '相关链接',
			'content' => '内容',
			'image' => '图片附件',
			'reply_id' => '回复人',
			'reply_content' => '回复内容',
			'reply_time' => '回复时间',
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
		$criteria->compare('relation_id',$this->relation_id,true);
		$criteria->compare('href',$this->href,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('reply_id',$this->reply_id,true);
		$criteria->compare('reply_content',$this->reply_content,true);
		$criteria->compare('reply_time',$this->reply_time,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function insert_datas(){
		if(!$this->hasErrors()){
				$datas=$this->save();
			  return $datas;
		}
	}
	function beforeSave(){
	  if(parent::beforeSave()){
			if($this->isNewRecord){
			   $this->create_time=time();
			}else{
			
			}
			return true;
		}else{
			return false;
		}
	}
	
	
	function show_attribute($attribute_name){
		switch($attribute_name){
			case 'type':
				 return $this->ConfigValues->name;
				break;
			case 'image':
			  return CHtml::image("/".$this->image,$this->title,array());
			  break;
		   case 'reply_id':
				 return $this->ReplyUser->user_login;
				break;
			case 'reply_time':
			   return date("Y-m-d H:i:s",$this->reply_time);
			case 'create_time':
				 return date("Y-m-d H:i:s",$this->create_time);
				break;
			default:
			  return $this->$attribute_name;
			  break;
		}
	}

	function get_operate(){
		  $user=new User();
		  $user_permission_name=$user->get_permissions_name();
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="<div class='operate_button'>";
		  if(Util::is_permission($user_permission_name,"edit"))
		  	$return_str.=CHtml::link('回复',array($controller_id."/reply","id"=>$this->id),array('class'=>'operate_green'));
		  if(Util::is_permission($user_permission_name,"delete")) 	
		   	$return_str.=CHtml::link('删除','javascript:void(0);',array('id'=>'delete_'.$this->id,'class'=>'operate_red','onclick'=>"javascript:ajax_delete('".Yii::app()->getController()->createUrl('main/delete')."','".get_class($this)."','".$this->id."');"));
		  $return_str.="</div>";
		  return $return_str;
	}
	
	
	function get_support_content_datas($relation_id){
		 $contents=$this->with("ReplyUser","ServiceSupport")->findAll(array('condition'=>"t.relation_id = :relation_id",'params'=>array(':relation_id'=>$relation_id),'order'=>'t.create_time ASC'));
		 return $contents;
	}
	
}