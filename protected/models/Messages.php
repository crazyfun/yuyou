<?php

/**
 * This is the model class for table "{{messages}}".
 *
 * The followings are the available columns in table '{{messages}}':
 * @property string $id
 * @property string $user_id
 * @property integer $is_all
 * @property string $title
 * @property string $content
 * @property integer $status
 * @property string $create_id
 * @property string $create_time
 */
class Messages extends BaseActive{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Messages the static model class
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
		return '{{messages}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title,content,status,user_id','required','message'=>'{attribute}不能为空','on'=>'WebSend'),
			array('title,content,status','required','message'=>'{attribute}不能为空','on'=>'AdminSend'),
			array('is_all, status', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>200),
			array('user_id,create_id, create_time', 'length', 'max'=>11),
			array('content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, is_all, title, content, status, create_id, create_time', 'safe', 'on'=>'search'),
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
			'User'=>array(self::BELONGS_TO, 'User', 'create_id'),
			'SendUser'=>array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => '收件人',
			'is_all' => '全部',
			'title' => '标题',
			'content' => '内容',
			'status' => '状态',
			'create_id' => '发送人',
			'create_time' => '发送时间',
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('is_all',$this->is_all);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_id',$this->create_id,true);
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
				$this->create_id=Yii::app()->user->id;
				$this->create_time=Util::current_time('timestamp');
			}else{
			}
			return true;
		}else{
			return false;
		}
	}
	
	function get_pre_message($type,$id,$user_id=""){
		if(empty($user_id)){
			$user_id=Yii::app()->user->id;
		}
		if($type=='2'){
		   $message_data=$this->find(array('select'=>'id','condition'=>"id < :id AND t.user_id=:user_id",'params'=>array(':id'=>$id,':user_id'=>$user_id),'order'=>'t.id DESC'));
		}
		if($type=="3"){
			 $message_data=$this->find(array('select'=>'id','condition'=>"id < :id AND t.create_id=:user_id",'params'=>array(':id'=>$id,':user_id'=>$user_id),'order'=>'t.id DESC'));
		}
		if(empty($message_data->id)){
			return '<div class="bnta1"><a href="javascript:void();">没有了</a></div>';
		}else{
			return '<div class="bnta1"><a href="'.Yii::app()->getController()->createUrl("user/messageshow",array('id'=>$message_data->id,'type'=>$type)).'">上一封</a></div>';
		}
	}
	
	function get_next_message($type,$id,$user_id=""){
		if(empty($user_id)){
			$user_id=Yii::app()->user->id;
		}
		if($type=='2'){
		   $message_data=$this->find(array('select'=>'id','condition'=>"id > :id AND t.user_id=:user_id",'params'=>array(':id'=>$id,':user_id'=>$user_id),'order'=>'t.id ASC'));
		}
		if($type=="3"){
			 $message_data=$this->find(array('select'=>'id','condition'=>"id > :id AND t.create_id=:user_id",'params'=>array(':id'=>$id,':user_id'=>$user_id),'order'=>'t.id ASC'));
		}
		if(empty($message_data->id)){
			return '<div class="bnta1 bnta2"><a href="javascript:void();">没有了</a></div>';
	  }else{
			return '<div class="bnta1 bnta2"><a href="'.Yii::app()->getController()->createUrl("user/messageshow",array('id'=>$message_data->id,'type'=>$type)).'">下一封</a></div>';
		}
	}
	
	function get_unread_message($user_id=""){
		if(empty($user_id)){
			$user_id=Yii::app()->user->id;
		}
		$numbers=$this->count("t.user_id=:user_id AND t.status=:status",array(':user_id'=>$user_id,':status'=>'1'));
		return empty($numbers)?0:$numbers;
	}
	
	function get_admin_pre_message($type,$id,$user_id=""){
		if(empty($user_id)){
			$user_id=Yii::app()->user->id;
		}
		if($type=='2'){
		   $message_data=$this->find(array('select'=>'id','condition'=>"id < :id AND t.user_id=:user_id",'params'=>array(':id'=>$id,':user_id'=>$user_id),'order'=>'t.id DESC'));
		}
		if($type=="3"){
			 $message_data=$this->find(array('select'=>'id','condition'=>"id < :id AND t.create_id=:user_id",'params'=>array(':id'=>$id,':user_id'=>$user_id),'order'=>'t.id DESC'));
		}
		if(empty($message_data->id)){
			return '<div class="bnta1"><a href="javascript:void();">没有了</a></div>';
		}else{
			return '<div class="bnta1"><a href="'.Yii::app()->getController()->createUrl("message/view",array('id'=>$message_data->id,'type'=>$type)).'">上一封</a></div>';
		}
	}
	
	function get_admin_next_message($type,$id,$user_id=""){
		if(empty($user_id)){
			$user_id=Yii::app()->user->id;
		}
		if($type=='2'){
		   $message_data=$this->find(array('select'=>'id','condition'=>"id > :id AND t.user_id=:user_id",'params'=>array(':id'=>$id,':user_id'=>$user_id),'order'=>'t.id ASC'));
		}
		if($type=="3"){
			 $message_data=$this->find(array('select'=>'id','condition'=>"id > :id AND t.create_id=:user_id",'params'=>array(':id'=>$id,':user_id'=>$user_id),'order'=>'t.id ASC'));
		}
		if(empty($message_data->id)){
			return '<div class="bnta1 bnta2"><a href="javascript:void();">没有了</a></div>';
	  }else{
			return '<div class="bnta1 bnta2"><a href="'.Yii::app()->getController()->createUrl("message/view",array('id'=>$message_data->id,'type'=>$type)).'">下一封</a></div>';
		}
	}
	
}