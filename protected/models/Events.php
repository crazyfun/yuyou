<?php

/**
 * This is the model class for table "{{events}}".
 *
 * The followings are the available columns in table '{{events}}':
 * @property string $event_id
 * @property string $user_id
 * @property string $event_name
 * @property string $start_date
 * @property string $end_date
 * @property string $details
 */
class Events extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Events the static model class
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
		return '{{events}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		    array('user_id','required','message'=>'{attribute}不能为空'),
			array('user_id', 'length', 'max'=>11),
			array('event_name', 'length', 'max'=>127),
			array('start_date, end_date, details', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('event_id, user_id, event_name, start_date, end_date, details', 'safe', 'on'=>'search'),
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
			'User'=>array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'event_id' => '行程ID',
			'user_id' => '用户ID',
			'event_name' => '行程名称',
			'start_date' => '开始时间',
			'end_date' => '结束时间',
			'details' => '详情',
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
		$criteria->compare('event_id',$this->event_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('event_name',$this->event_name,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('details',$this->details,true);

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
				$this->user_id=Yii::app()->user->id;
			}else{
				//$this->create_id=Yii::app()->user->id;
				//$this->create_time=Util::current_time('timestamp');
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
			break;
		default:
		  return $this->$attribute_id;
			break;
	 }
	}	
}