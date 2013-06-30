<?php

/**
 * This is the model class for table "{{pays}}".
 *
 * The followings are the available columns in table '{{pays}}':
 * @property string $id
 * @property string $user_id
 * @property string $type
 * @property string $outer_serial
 * @property string $price
 * @property integer $status
 * @property string $comment
 * @property string $create_time
 * @property string $pay_time
 */
class Pays extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pays the static model class
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
		return '{{pays}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id,type,user_id,price,status','required','message'=>'{attribute}不能为空'),
			array('price','numerical','allowEmpty'=>false,'message'=>'必须是数字'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>20),
			array('user_id, price, create_time, pay_time', 'length', 'max'=>11),
			array('type', 'length', 'max'=>30),
			array('outer_serial', 'length', 'max'=>100),
			array('comment', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, type, outer_serial, price, status, comment, create_time, pay_time', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'user_id' => '支付人',
			'type' => '支付类型',
			'outer_serial' => '外部流水号',
			'price' => '价钱',
			'status' => '支付状态',
			'comment' => '备注',
			'create_time' => '创建时间',
			'pay_time' => '支付时间',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('outer_serial',$this->outer_serial,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('pay_time',$this->pay_time,true);

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
			case 'user_id':
				 return $this->User->user_login;
				break;
		 	case 'type':
		 			$payment_type=CV::$payment_type;
		 	    return $payment_type[$this->type]['name'];
		 		break;
		  case 'status':
		    $pay_status=CV::$pay_status;
		    return $pay_status[$this->status];
		    break;
			case 'create_time':
				 return date('Y-m-d H:i:s',$this->create_time);
				break;
		    case 'pay_time':
				 return empty($this->pay_time)?"未购买":date('Y-m-d H:i:s',$this->pay_time);
				break;
			default:
			  return $this->$attribute_name;
			  break;
		}
	}
	
	function check_money($order_id,$amount){
		 
		 $pays_data=$this->findByPk($order_id);
		 $price=$pays_data->price;
		 if($price!=$amount){
		 	  return false;
		 }else{
        return true;		 	
		 }
		
	}
	function change_order_status($order_id,$outer_serial=""){
       $transaction = Yii::app()->db->beginTransaction();
       try {
              $pays_data=$this->findByPk($order_id);
              $status=$pays_data->status;
              if($status=='1'){
              	$result=$this->updateByPk($order_id,array('status'=>'2','pay_time'=>time(),'outer_serial'=>$outer_serial));
              	if($result){
              		  $consume_temp=new ConsumeTemp();
		    			  		$consume_temp->consume(13,$pays_data->user_id,'1',$pays_data->price,array('value'=>$pays_data->price));
              	}
              }
              $transaction->commit();      
       } catch(Exception $e){
              $transaction->rollBack();   
       }      
	}
	
	function get_pay_type_select(){
		$return_arr=array();
		$payment_type=CV::$payment_type;
		foreach($payment_type as $key => $value){
			$return_arr[$key]=$value['name'];
		}
		return $return_arr;
	}
}