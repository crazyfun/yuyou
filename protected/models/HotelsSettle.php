<?php

/**
 * This is the model class for table "{{travel_settle}}".
 *
 * The followings are the available columns in table '{{travel_settle}}':
 * @property string $id
 * @property string $order_id
 * @property integer $type
 * @property string $out_serial
 * @property integer $status
 * @property string $create_time
 */
class HotelsSettle extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TravelSettle the static model class
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
		return '{{hotels_settle}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id,type,out_serial,status','required','message'=>'{attribute}不能为空'),
			array('type, status', 'numerical', 'integerOnly'=>true),
			array('order_id, create_time', 'length', 'max'=>11),
			array('out_serial', 'length', 'max'=>100),
			array('comment','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,comment, order_id, type, out_serial, status, create_time', 'safe', 'on'=>'search'),
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
			'HotelsOrder'=>array(self::BELONGS_TO, 'HotelsOrder', 'order_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'order_id' => '订单号',
			'type' => '付款类型',
			'out_serial' => '付款单号',
			'status' => '结算状态',
			'comment'=>'备注',
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
		$criteria->compare('order_id',$this->order_id,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('out_serial',$this->out_serial,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('comment',$this->comment);
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
			case 'order_id':
				return $this->order_id;
				break;
		    case 'status':
		    	$hotels_settle=CV::$hotels_settle;
		    	return empty($this->status)?"未结算":$hotels_settle[$this->status];
		    	break;
		    case 'create_time':
				 return date('Y-m-d H:i:s',$this->create_time);
				break;
			default:
			  return $this->$attribute_name;
			  break;
		}
	}
	
	

	
	
	
}