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
class HotelsOrderNumbers extends BaseActive
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
		return '{{hotels_order_numbers}}';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hotels_id,hotels_price_id,date','required','message'=>'{attribute}不能为空'),
			array('hotels_id, hotels_price_id,order_numbers', 'length', 'max'=>11),
			array('date','length','max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, hotels_id, hotels_price_id,date,order_numbers', 'safe', 'on'=>'search'),
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
			'Hotels'=>array(self::BELONGS_TO,'Hotels','hotels_id'),
			'HotelsPrice'=>array(self::BELONGS_TO,'HotelsPrice','hotels_price_id'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'hotels_id' => '酒店',
			'hotels_price_id' => '房型',
			'date'=>'预定时间',
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
		$criteria->compare('hotels_id',$this->hotels_id,true);
		$criteria->compare('hotels_price_id',$this->hotels_price_id,true);
		$criteria->compare('date',$this->date,true);
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
			case 'hotels_id':
				return $this->Hotels->title;
				break;
			case 'hotels_price_id':
				return $this->HotelsPrice->price;
				break;
			case 'date':
				return $this->date;
				break;
			default:
			  return $this->$attribute_name;
			  break;
		}
	}
	
	

}