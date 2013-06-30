<?php

/**
 * This is the model class for table "{{travel_order_serial}}".
 *
 * The followings are the available columns in table '{{travel_order_serial}}':
 * @property string $id
 * @property string $order_id
 * @property string $order_serial
 * @property integer $status
 * @property string $create_time
 * @property string $user_time
 */
class TravelOrderSerial extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TravelOrderSerial the static model class
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
		return '{{travel_order_serial}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id,order_serial', 'required','message'=>'{attribute}不能为空'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('order_id,create_time,user_time', 'length', 'max'=>11),
			array('order_serial', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_id, order_serial, status, create_time, user_time', 'safe', 'on'=>'search'),
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
			'order_serial' => '订单号',
			'status' => '状态',
			'create_time' => '创建时间',
			'user_time' => '使用时间',
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
		$criteria->compare('order_serial',$this->order_serial,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('user_time',$this->user_time,true);
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
			   $this->status='1';
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
        case 'status':
        	$status=array('1'=>'未使用','2'=>'已使用');
            return $status[$this->status];
        	break;
        case 'create_time':
          return date("Y-m-d",$this->create_time);
          break;
        case 'user_time':
          return empty($this->user_time)?"未使用":date("Y-m-d",$this->user_time);
          break;
		default:
		  return $this->$attribute_id;
			break;
	 }
	}
}