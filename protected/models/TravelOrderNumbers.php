<?php

/**
 * This is the model class for table "{{travel_order_numbers}}".
 *
 * The followings are the available columns in table '{{travel_order_numbers}}':
 * @property string $id
 * @property string $order_id
 * @property string $start_date
 * @property string $order_numbers
 */
class TravelOrderNumbers extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TravelOrderNumbers the static model class
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
		return '{{travel_order_numbers}}';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('travel_id,start_date','required','message'=>'{attribute}不能为空'),
			array('travel_id, order_numbers', 'length', 'max'=>11),
			array('start_date', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, travel_id, start_date, order_numbers', 'safe', 'on'=>'search'),
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
			'Travel'=>array(self::BELONGS_TO,'Travel','travel_id'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'travel_id' => '线路',
			'start_date' => '开始时间',
			'order_numbers' => '订单数',
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
		$criteria->compare('travel_id',$this->travel_id,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('order_numbers',$this->order_numbers,true);
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
			}else{
			}
			return true;
		}else{
			return false;
		}
	}
	
	function show_attribute($attribute_name){
		switch($attribute_name){
			case 'travel_id':
				return $this->Travel->title;
				break;
			default:
			  return $this->$attribute_name;
			  break;
		}
	}

}