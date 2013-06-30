<?php

/**
 * This is the model class for table "{{tem_order_contacter}}".
 *
 * The followings are the available columns in table '{{tem_order_contacter}}':
 * @property string $id
 * @property string $order_id
 * @property string $contacter
 * @property string $contacter_phone
 * @property integer $code_type
 * @property string $code_value
 * @property integer $main
 */
class TravelOrderContacter extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TemOrderContacter the static model class
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
		return '{{travel_order_contacter}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code_type, main', 'numerical', 'integerOnly'=>true),
			array('order_id,address_id', 'length', 'max'=>11),
			array('contacter, contacter_phone, code_value', 'length', 'max'=>30),
			array('is_child','length','max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_id, contacter, contacter_phone, code_type, code_value, main,is_child,address_id', 'safe', 'on'=>'search'),
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
				'TravelAddress'=>array(self::BELONGS_TO,'TravelAddress','address_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'order_id' => '订单',
			'contacter' => '联系人',
			'contacter_phone' => '联系电话',
			'code_type' => '证件类型',
			'code_value' => '增加号码',
			'main' => '主要联系人',
			'is_child'=>'儿童',
			'address_id'=>'上车地点',
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
		$criteria->compare('contacter',$this->contacter,true);
		$criteria->compare('contacter_phone',$this->contacter_phone,true);
		$criteria->compare('code_type',$this->code_type);
		$criteria->compare('code_value',$this->code_value,true);
		$criteria->compare('main',$this->main);
		$criteria->compare('is_child',$this->is_child);
		$criteria->compare('address_id',$this->address_id);
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
			
			}else{
			
			}
			return true;
		}else{
			return false;
		}
	}
	
	function show_attribute($attribute_id){
	 switch($attribute_id){
	    case 'code_type':
	    	$code_type=CV::$code_type;
	        return $code_type[$this->code_type];
	    	break;
	    case 'is_child':
	    	if($this->is_child=="1"){
	    		 return "是";
	        }else{
	             return "不是";	
	        }
	        break;
	      case 'address_id':
	    	return $this->TravelAddress->show_attribute("address_id");
	    	break;
		default:
		  return $this->$attribute_id;
			break;
	 }
	}
	
	
}