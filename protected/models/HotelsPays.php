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
class HotelsPays extends BaseActive
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
		return '{{hotels_pays}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type,order_id,price,status','required','message'=>'{attribute}不能为空'),
			array('price','numerical','allowEmpty'=>false,'message'=>'必须是数字'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>20),
			array('order_id,user_id, price, create_time, pay_time', 'length', 'max'=>11),
			array('type', 'length', 'max'=>30),
			array('outer_serial', 'length', 'max'=>100),
			array('comment', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_id,user_id, type, outer_serial, price, status, comment, create_time, pay_time', 'safe', 'on'=>'search'),
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
			'HotelsOrder'=>array(self::BELONGS_TO,'HotelsOrder','order_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'order_id'=>'订单号',
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
		$criteria->compare('order_id',$this->order_id,true);
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
			    $this->create_time=time();
			    $this->user_id=Yii::app()->user->id;
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
		   	case 'hotels_id':
			  return $this->HotelsOrder->Hotels->title;
			  break;
			case 'user_id':
				 return $this->User->user_login;
				break;
		 	case 'type':
		 			$payment_type=CV::$travel_payment_type;
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
              	  	
              	  	$hotels_order_id=$pays_data->order_id;
              		 	$hotels_order=HotelsOrder::model();
              			$hotels_order_data=$hotels_order->with("Hotels")->findByPk($hotels_order_id);
              		  $hotels_order->updateByPk($hotels_order_id,array('pay_status'=>'2','pay_time'=>time()));
              		  $hotels=Hotels::model();
      						  $hotels_data=$hotels->findByPk($hotels_order_data->hotels_id);
      						  $hotels_data->buy_numbers=$hotels_data->buy_numbers+1;
      						  $hotels_data->insert_datas();
      						  
       					   	 $hotels_order_numbers=new HotelsOrderNumbers();
		    		 	$start_date_time=strtotime($hotels_order_data->start_date);
							$end_date_time=strtotime($hotels_order_data->end_date);
							$diff_day=($end_date_time-$start_date_time)/86400;
							for($ii=0;$ii <= $diff_day;$ii++){
								$current_date=date("Y-m-d",mktime(0,0,0,date("m",$start_date_time),(date("d",$start_date_time)+$ii),date("Y",$start_date_time)));
								$order_numbers_data=$hotels_order_numbers->find("t.hotels_id=:hotels_id AND t.hotels_price_id=:hotels_price_id AND date=:date",array(':hotels_id'=>$hotels_order_data->hotels_id,':hotels_price_id'=>$hotels_order_data->hotels_price_id,':date'=>$current_date));
            	  if(empty($order_numbers_data)){
            	  	$hotels_order_numbers->id=null;
            	  	$hotels_order_numbers->hotels_id=$hotels_order_data->hotels_id;
            	  	$hotels_order_numbers->hotels_price_id=$hotels_order_data->hotels_price_id;
            	  	$hotels_order_numbers->date=$current_date;
            	  	$hotels_order_numbers->order_numbers=$hotels_order_data->numbers;
            	  	$hotels_order_numbers->setIsNewRecord(true);
            	  	if($hotels_order_numbers->validate()){
      							$hotels_order_numbers->insert_datas();
      						}
            	  }else{
            	  	$hotels_order_numbers->updateByPk($order_numbers_data->id,array('order_numbers'=>($order_numbers_data->order_numbers+$hotels_order_data->numbers)));
            	  }
            	  
							}
              		  $send_message=new SendMessage();
   	    						$send_message->send_message(25,$hotels_order_data->contacter_phone,array('order_serial'=>$hotels_order_data->order_serial,'title'=>$hotels_order_data->Hotels->title,'contact_phone'=>$hotels_order_data->Hotels->hotel_telephone,'address'=>$hotels_order_data->Hotels->hotel_address));
              	
              	}
             }
             $transaction->commit();      
       }catch(Exception $e){
              $transaction->rollBack();   
       }      
	}
	
	function get_pay_type_select(){
		$return_arr=array();
		$payment_type=CV::$travel_payment_type;
		foreach($payment_type as $key => $value){
			$return_arr[$key]=$value['name'];
		}
		return $return_arr;
	}
}