<?php

/**
 * This is the model class for table "{{contacter_message}}".
 *
 * The followings are the available columns in table '{{contacter_message}}':
 * @property string $id
 * @property string $contacter
 * @property string $contacter_sex
 * @property string $contacter_phone
 * @property string $contacter_email
 * @property string $contacter_msn
 * @property string $contacter_qq
 * @property string $contacter_address
 * @property string $contacter_web
 * @property string $comment
 * @property string $replay
 * @property string $create_time
 */
class ContacterMessage extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ContacterMessage the static model class
	 */
	public $imagecode="";
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{contacter_message}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contacter, contacter_sex, contacter_phone, contacter_email, contacter_msn, contacter_qq', 'length', 'max'=>30),
			array('status', 'numerical', 'integerOnly'=>true),
			array('title,contacter_address, contacter_web', 'length', 'max'=>100),
			array('message_type,replay_id,replay_time,create_time', 'length', 'max'=>11),
			array('comment, replay', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('title,message_type,id, contacter, contacter_sex, contacter_phone, contacter_email, contacter_msn, contacter_qq, contacter_address, contacter_web, comment, replay, create_time', 'safe', 'on'=>'search'),
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
		 'ReplayUser'=>array(self::BELONGS_TO,'User','replay_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title'=>'主题',
			'message_type'=>'类别',
			'contacter' => '联系人',
			'contacter_sex' => '性别',
			'contacter_phone' => '联系电话',
			'contacter_email' => '联系邮箱',
			'contacter_msn' => '联系MSN',
			'contacter_qq' => '联系QQ',
			'contacter_address' => '联系地址',
			'contacter_web' => '个人主页',
			'comment' => '详细内容',
			'replay' => '回复',
			'replay_id'=>'回复人',
			'status'=>'审核状况',
			'replay_time'=>'回复时间',
			'create_time' => '留言时间',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('message_type',$this->message_type,true);
		$criteria->compare('contacter',$this->contacter,true);
		$criteria->compare('contacter_sex',$this->contacter_sex,true);
		$criteria->compare('contacter_phone',$this->contacter_phone,true);
		$criteria->compare('contacter_email',$this->contacter_email,true);
		$criteria->compare('contacter_msn',$this->contacter_msn,true);
		$criteria->compare('contacter_qq',$this->contacter_qq,true);
		$criteria->compare('contacter_address',$this->contacter_address,true);
		$criteria->compare('contacter_web',$this->contacter_web,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('replay',$this->replay,true);
		$criteria->compare('replay_id',$this->replay_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('replay_time',$this->replay_time,true);
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
	public function beforeSave(){
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
	
	function show_attribute($attribute_id){
	 switch($attribute_id){
	 	case 'message_type':
	 	  $config_values=ConfigValues::model();
	    $message_type=$config_values->get_ralation_values("6");
	 	  return $message_type[$this->message_type];
	 	case 'replay_id':
	 	  return $this->ReplayUser->user_login;
	 	  break;
	 	case 'contacter_sex':
	 	  $sex=CV::$sex;
	 	  return $sex[$this->contacter_sex];
	 	  break;
	 	case 'status':
	 	  $message_status=CV::$message_status;
	 	  return $message_status[$this->status];
	 	  break;
	 	case 'replay_time':
	 	  return empty($this->replay_time)?"未回复":date('Y-m-d',$this->replay_time);
	 	  break;
	 	case 'create_time':
	 	  return date('Y-m-d',$this->create_time);
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
		  if(Util::is_permission($user_permission_name,"reply"))
		     $return_str.=CHtml::link('回复',array($controller_id."/reply","id"=>$this->id),array('class'=>'operate_green'));
		  if(Util::is_permission($user_permission_name,"status")){
		  	if($this->status=='1'){
		  		$return_str.=CHtml::link('审核',array($controller_id."/status","id"=>$this->id,"status"=>'2'),array('class'=>'operate_green'));
		  	}else{
		  		$return_str.=CHtml::link('未审核',array($controller_id."/status","id"=>$this->id,"status"=>'1'),array('class'=>'operate_green'));
		  	} 
		  }
		  if(Util::is_permission($user_permission_name,"delete"))
		     $return_str.=CHtml::link('删除','javascript:void(0);',array('id'=>'delete_'.$this->id,'class'=>'operate_red','onclick'=>"javascript:ajax_delete('".Yii::app()->getController()->createUrl('main/delete')."','".get_class($this)."','".$this->id."');"));
		  $return_str.="</div>";
		  return $return_str;
	}
}