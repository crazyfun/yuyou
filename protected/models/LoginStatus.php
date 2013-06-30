<?php

/**
 * This is the model class for table "{{login_status}}".
 *
 * The followings are the available columns in table '{{login_status}}':
 * @property string $id
 * @property string $create_id
 * @property string $login_ip
 * @property string $login_address
 * @property string $login_time
 */
class LoginStatus extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return LoginStatus the static model class
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
		return '{{login_status}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  
			array('create_id, login_time', 'length', 'max'=>11),
			array('login_ip, login_address', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, create_id, login_ip, login_address, login_time', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'create_id' => '用户名',
			'login_ip' => '登录IP',
			'login_address' => '登录地址',
			'login_time' => '登录时间',
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
		$criteria->compare('create_id',$this->create_id,true);
		$criteria->compare('login_ip',$this->login_ip,true);
		$criteria->compare('login_address',$this->login_address,true);
		$criteria->compare('login_time',$this->login_time,true);

		return new CActiveDataProvider(get_class($this), array(
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
				$this->login_time=Util::current_time('timestamp');
			}else{
				$this->create_id=Yii::app()->user->id;
				$this->login_time=Util::current_time('timestamp');
			}
			return true;
		}else{
			return false;
		}
	}
	
	function format_login_time(){
		return date("Y-m-d H:i:s",$this->login_time);
		
	}
	
}