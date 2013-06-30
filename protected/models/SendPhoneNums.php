<?php

/**
 * This is the model class for table "{{send_phone_nums}}".
 *
 * The followings are the available columns in table '{{send_phone_nums}}':
 * @property string $id
 * @property string $user_id
 * @property integer $send_numbers
 * @property string $send_time
 */
class SendPhoneNums extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SendPhoneNums the static model class
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
		return '{{send_phone_nums}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('send_numbers,user_id', 'required','message'=>'{attribute}不能为空','on'=>'Order'),
			array('send_numbers', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>11),
		    array('send_time','length','max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, send_numbers, send_time', 'safe', 'on'=>'search'),
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
			'User'=>array(self::BELONGS_TO,'User','user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => '用户ID',
			'send_numbers' => '发送次数',
			'send_time' => '发送时间',
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
		$criteria->compare('send_numbers',$this->send_numbers);
		$criteria->compare('send_time',$this->send_time,true);
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
			   $this->user_id=Yii::app()->user->id;
			   $this->send_time=date("Y-m-d");
			}else{
			  $this->send_time=date("Y-m-d");
			}
			return true;
		}else{
			return false;
		}
	}
	
	function show_attribute($attribute_id){
	 switch($attribute_id){
	    case 'user_id':
	        return $this->User->user_login;
	        break
	    case 'send_time':
	    	return $this->send_time;
	        break;
		default:
		    return $this->$attribute_id;
			break;
	 }
	}
}