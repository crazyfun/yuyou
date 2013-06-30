<?php

/**
 * This is the model class for table "{{temp_order}}".
 *
 * The followings are the available columns in table '{{temp_order}}':
 * @property string $id
 * @property string $travel_id
 * @property string $travel_date
 * @property string $adult_price
 * @property string $fa_price
 * @property string $child_price
 * @property string $fc_price
 * @property string $adult_nums
 * @property string $child_nums
 * @property string $total_price
 */
class TempOrder extends BaseActive{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TempOrder the static model class
	 */
	public $agree_order="";
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{temp_order}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('travel_id,travel_date,adult_price,fa_price,child_price,fc_price,company_id','required','message'=>'{attribute}不能为空'),
			array('agree_order','required','message'=>'未同意预定条款'),
			array('travel_id, adult_price, fa_price, child_price, fc_price, adult_nums, child_nums, total_price,company_id', 'length', 'max'=>11),
			array('travel_date', 'length', 'max'=>30),
			array('comment','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, travel_id, travel_date, adult_price, fa_price, child_price, fc_price, adult_nums, child_nums, total_price,comment,company_id', 'safe', 'on'=>'search'),
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
	    	'Company'=>array(self::BELONGS_TO,'Company','company_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'travel_id' => '线路名称',
			'travel_date' => '出发时间',
			'adult_price' => '成人价',
			'fa_price' => '成人结算价',
			'child_price' => '儿童价',
			'fc_price' => '儿童结算价',
			'adult_nums' => '成人数',
			'child_nums' => '儿童数',
			'total_price' => '总价',
			'comment'=>'备注',
			'company_id'=>'报名公司',
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
		$criteria->compare('travel_date',$this->travel_date,true);
		$criteria->compare('adult_price',$this->adult_price,true);
		$criteria->compare('fa_price',$this->fa_price,true);
		$criteria->compare('child_price',$this->child_price,true);
		$criteria->compare('fc_price',$this->fc_price,true);
		$criteria->compare('adult_nums',$this->adult_nums,true);
		$criteria->compare('child_nums',$this->child_nums,true);
		$criteria->compare('total_price',$this->total_price,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('company_id',$this->company_id,true);
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
			case 'company_id':
				return $this->Company->company_name;
			    break;
			default:
			  return $this->$attribute_name;
			  break;
		}
	}
	
	
}