<?php

/**
 * This is the model class for table "{{payment}}".
 *
 * The followings are the available columns in table '{{payment}}':
 * @property integer $pay_id
 * @property string $pay_code
 * @property string $pay_name
 * @property string $pay_fee
 * @property string $pay_desc
 * @property string $pay_config
 * @property integer $enabled
 */
class Payment extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Payment the static model class
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
		return '{{payment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		
			array('enabled', 'numerical', 'integerOnly'=>true),
			array('pay_code', 'length', 'max'=>20),
			array('pay_name', 'length', 'max'=>120),
			array('pay_fee', 'length', 'max'=>10),
			array('company_id','length','max'=>11),
			array('pay_desc, pay_config', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pay_id, pay_code, pay_name, pay_fee, pay_desc, pay_config,company_id,enabled', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pay_id' => '支付ID',
			'pay_code' => '支付方式',
			'pay_name' => '支付名称',
			'pay_fee' => '手续费',
			'pay_desc' => '支付方式描述',
			'pay_config' => '支付配置',
			'company_id'=>'公司ID',
			'enabled' => '是否安装',
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

		$criteria->compare('pay_id',$this->pay_id);
		$criteria->compare('pay_code',$this->pay_code,true);
		$criteria->compare('pay_name',$this->pay_name,true);
		$criteria->compare('pay_fee',$this->pay_fee,true);
		$criteria->compare('pay_desc',$this->pay_desc,true);
		$criteria->compare('pay_config',$this->pay_config,true);
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('enabled',$this->enabled);

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
			default:
			  return $this->$attribute_name;
			  break;
		}

	}
	
	function get_real_amount($pay_code,$amount,$company_id=0){
		$payment_data=$this->find("pay_code=:pay_code  AND company_id=:company_id",array(':pay_code'=>$pay_code,':company_id'=>$company_id));
		$pay_fee=$payment_data->pay_fee;
		return $amount*(1-$pay_fee);
		
	}
}