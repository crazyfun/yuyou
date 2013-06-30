<?php

/**
 * This is the model class for table "{{temp_order_insurance}}".
 *
 * The followings are the available columns in table '{{temp_order_insurance}}':
 * @property string $id
 * @property string $order_id
 * @property string $insurance_id
 * @property string $insurance_number
 */
class TravelOrderInsurance extends BaseActive{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TempOrderInsurance the static model class
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
		return '{{travel_order_insurance}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id,insurance_id','required','message'=>'{attribute}不能为空'),
			array('order_id, insurance_id, insurance_number', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_id, insurance_id, insurance_number', 'safe', 'on'=>'search'),
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
				'TravelOrder'=>array(self::BELONGS_TO,'TravelOrder','order_id'),
				'Insurance'=>array(self::BELONGS_TO,'Insurance','insurance_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'order_id' => '订单ID',
			'insurance_id' => '保险ID',
			'insurance_number' => '保险份数',
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
		$criteria->compare('order_id',$this->order_id,true);
		$criteria->compare('insurance_id',$this->insurance_id,true);
		$criteria->compare('insurance_number',$this->insurance_number,true);

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
		  case 'insurance_id':
		    return $this->Insurance->insurance_name;
		    break;
			default:
			  return $this->$attribute_name;
			  break;
		}
	}
}