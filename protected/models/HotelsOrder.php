<?php

/**
 * This is the model class for table "{{hotels_order}}".
 *
 * The followings are the available columns in table '{{hotels_order}}':
 * @property string $id
 * @property string $order_serial
 * @property string $hotels_id
 * @property string $hotels_bed_id
 * @property string $start_date
 * @property string $end_date
 * @property string $numbers
 * @property string $live_numbers
 * @property string $live_contacter
 * @property string $start_time
 * @property string $end_time
 * @property string $total_price
 * @property string $contacter
 * @property string $contacter_phone
 * @property string $contacter_telephone
 * @property string $email
 * @property string $commment
 * @property string $company_id
 * @property integer $status
 * @property integer $pay_status
 * @property string $user_id
 * @property string $pay_time
 * @property string $user_time
 * @property string $create_time
 */
class HotelsOrder extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HotelsOrder the static model class
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
		return '{{hotels_order}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hotels_id,hotels_bed_id,hotels_price_id,start_date,end_date,numbers,live_numbers,total_price,live_contacter,start_time,contacter,contacter_phone', 'required','message'=>'{attribute}不能为空'),
			array('start_date','compare_start_date'),
			array('email','email','message'=>'邮箱格式不正确'),
			array('status, pay_status', 'numerical', 'integerOnly'=>true),
			array('order_serial, start_date, end_date, live_contacter, start_time, end_time, contacter, contacter_phone, contacter_telephone, email', 'length', 'max'=>30),
			array('hotels_id, hotels_bed_id,hotels_price_id, numbers, live_numbers, total_price, company_id, user_id, pay_time, user_time, create_time', 'length', 'max'=>11),
			array('commment', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_serial, hotels_id, hotels_bed_id,hotels_price_id,start_date, end_date, numbers, live_numbers, live_contacter, start_time, end_time, total_price, contacter, contacter_phone, contacter_telephone, email, commment, company_id, status, pay_status, user_id, pay_time, user_time, create_time', 'safe', 'on'=>'search'),
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
		  'HotelsBeds'=>array(self::BELONGS_TO,'HotelsBeds','hotels_bed_id'),
		  'HotelsPrice' => array(self::BELONGS_TO,'HotelsPrice','hotels_price_id'),
		  'User'=>array(self::BELONGS_TO,'User','user_id'),
		  'Company'=>array(self::BELONGS_TO,'Company','company_id'),
		  'HotelsSettle'=>array(self::HAS_ONE,'HotelsSettle','order_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'order_serial' => '订单号',
			'hotels_id' => '酒店',
			'hotels_bed_id' => '房型',
			'hotels_price_id'=>'房型价钱',
			'start_date' => '入住时间',
			'end_date' => '退房时间',
			'numbers' => '房间数',
			'live_numbers' => '入住人数',
			'live_contacter' => '入住人',
			'start_time' => '到店开始时间',
			'end_time' => '到店结束时间',
			'total_price' => '总价',
			'contacter' => '联系人',
			'contacter_phone' => '联系手机',
			'contacter_telephone' => '固定电话',
			'email' => '邮箱',
			'commment' => '备注',
			'company_id' => '旅行社',
			'status' => '订单状态',
			'pay_status' => '付款状态',
			'user_id' => '创建人',
			'pay_time' => '付款时间',
			'user_time' => '订单号使用时间',
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
		$criteria->compare('order_serial',$this->order_serial,true);
		$criteria->compare('hotels_id',$this->hotels_id,true);
		$criteria->compare('hotels_bed_id',$this->hotels_bed_id,true);
		$criteria->compare('hotels_price_id',$this->hotels_price_id,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('numbers',$this->numbers,true);
		$criteria->compare('live_numbers',$this->live_numbers,true);
		$criteria->compare('live_contacter',$this->live_contacter,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('total_price',$this->total_price,true);
		$criteria->compare('contacter',$this->contacter,true);
		$criteria->compare('contacter_phone',$this->contacter_phone,true);
		$criteria->compare('contacter_telephone',$this->contacter_telephone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('commment',$this->commment,true);
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('pay_status',$this->pay_status);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('pay_time',$this->pay_time,true);
		$criteria->compare('user_time',$this->user_time,true);
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
	public function beforeSave(){
	  if(parent::beforeSave()){
			if($this->isNewRecord){
			    $this->user_id=Yii::app()->user->id;
			    $this->create_time=time();
			}else{
			   //$this->create_time=time();
			}
			return true;
		}else{
			return false;
		}
	}
	
	function show_attribute($attribute_id){
	 switch($attribute_id){
	    case 'user_id':
	      return $this->User->user_login;
	      break;
	    case 'order_serial':
	      return $this->order_serial;
	      break;
	    case 'hotels_id':
	      return $this->Hotels->title;
	      break;
	    case 'hotels_bed_id':
	      return $this->HotelsBeds->name;
	      break;
	    case 'hotels_price_id':
	     return $this->HotelsPrice->price;
	     break;
	    case 'status':
	      $status=CV::$hotels_status;
	      return $status[$this->status];
	      break;
	   
	   case 'pay_status':
	      $hotels_pay_status=CV::$hotels_pay_status;
	    	return $hotels_pay_status[$this->pay_status];
	    	break;
	 case 'settle_status':
		     return empty($this->HotelsSettle->status)?"未结算":$this->HotelsSettle->show_attribute("status");
		     break;
	 case 'user_time':
	 	  	return !empty($this->user_time)?date('Y-m-d H:i:s',$this->user_time):"未使用";
	    	break;
     case 'pay_time':
	    	return !empty($this->pay_time)?date('Y-m-d H:i:s',$this->pay_time):"未付款";
	    	break;
	    case 'create_time':
	    	return date('Y-m-d H:i:s',$this->create_time);
	    	break;
		default:
		  return $this->$attribute_id;
			break;
	 }
	}
	
	function show_hotels_title($hotels_id=""){
		if(empty($hotels_id)){
			$hotels_id=$this->hotels_id;
		}
		$hotels=Hotels::model();
		$hotels_data=$hotels->findByPk($hotels_id);
		return CHtml::link($hotels_data->title,array('hotels/show','id'=>$hotels_id),array());
	}
	
  function show_company_name($company_id=""){
		if(empty($company_id)){
			$company_id=$this->Hotels->company_id;
		}
		$company=Company::model();
		$company_data=$company->findByPk($company_id);
		return '<a href="javascript:frame_view(\'/admin.php/company/view\',\'company\',\''.$company_id.'\');">'.$company_data->company_name.'</a>';
		
	}
	
	function get_operate(){
		   $user=new User();
		  $user_permission_name=$user->get_permissions_name();
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="<div class='operate_button'>";
		  if(Util::is_permission($user_permission_name,"view"))
		     $return_str.=CHtml::link('查看',array($controller_id."/view","id"=>$this->id),array('class'=>'operate_green'));
		  if(Util::is_permission($user_permission_name,"status")){
		  	 if($this->status=='1'){
		  	 	$return_str.=CHtml::link('计调已确认',array($controller_id."/status","id"=>$this->id,'status'=>'2'),array('class'=>'operate_green'));
		  	}
		  	if($this->status=='2'&&$this->pay_status == '2'){
		  	 	  $return_str.=CHtml::link('已转成正式订单',array($controller_id."/status","id"=>$this->id,'status'=>'3'),array('class'=>'operate_green'));
		  	}
		  	if($this->status=='1' || $this->status=='2'){
		  		  $return_str.=CHtml::link('取消订单',array($controller_id."/status","id"=>$this->id,'status'=>'4'),array('class'=>'operate_green'));
		  	}
      }
		  $return_str.="</div>";
		  return $return_str;
	}
	
		function get_hotels_operate(){
		  $user=new User();
		  $user_permission_name=$user->get_permissions_name();
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="<div class='operate_button'>";
		  if(Util::is_permission($user_permission_name,"view"))
		     $return_str.=CHtml::link('查看',array($controller_id."/view","id"=>$this->id),array('class'=>'operate_green'));
		  if(Util::is_permission($user_permission_name,"status")){
		  	if($this->status=='1' || $this->status=='2'){
		  		  $return_str.=CHtml::link('取消订单',array($controller_id."/status","id"=>$this->id,'status'=>'4'),array('class'=>'operate_green'));
		  	}
		  }
		  
		  if(Util::is_permission($user_permission_name,"pay")){
     	 if($this->pay_status == '1'&&($this->status='1'||$this->status='2')){
      		  $return_str.=CHtml::link('付款',array($controller_id."/pay","id"=>$this->id),array('class'=>'operate_green'));
      	}
      } 
		  $return_str.="</div>";
		  return $return_str;
	}
		function get_web_operate(){
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="<div class='operate_button'>";
		  $return_str.=CHtml::link('查看',array($controller_id."/hotelsorderview","id"=>$this->id),array('class'=>'operate_green'));
		  if($this->pay_status=='1'&&($this->status=='1'||$this->status=='2')){
		  	 $return_str.=CHtml::link('付款',array("hotelspay/step2","id"=>$this->id),array('class'=>'operate_green'));
		  	 $return_str.=CHtml::link('取消',array($controller_id."/hotelsorderstatus","id"=>$this->id,"status"=>'4'),array('class'=>'operate_green'));
		  }
		  if($this->pay_status=='2'){
		  	$return_str.=CHtml::link('查看订单号',"javascript:send_hotels_order_serial('".$this->id."')",array('class'=>'operate_green'));
		  }
		  $return_str.="</div>";
		  return $return_str;
	}
	
	
	function get_hotels_settle_operate(){
		  $user=new User();
		  $user_permission_name=$user->get_permissions_name();
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="<div class='operate_button'>";
		  if(Util::is_permission($user_permission_name,"view"))
		     $return_str.=CHtml::link('查看',array($controller_id."/view","id"=>$this->id),array('class'=>'operate_green'));
		  if(Util::is_permission($user_permission_name,"viewsettle")){
		  	if($this->TravelSettle->status!='1'){
		  	  $return_str.=CHtml::link('查看结算信息',array($controller_id."/viewsettle","order_id"=>$this->id),array('class'=>'operate_green'));
		    }
		  }
		  $return_str.="</div>";
		  return $return_str;
		
	}
	
	
	
	function get_zutuan_settle_operate(){
		  $user=new User();
		  $user_permission_name=$user->get_permissions_name();
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="<div class='operate_button'>";
		  if(Util::is_permission($user_permission_name,"view"))
		     $return_str.=CHtml::link('查看',array($controller_id."/view","id"=>$this->id),array('class'=>'operate_green'));
		  if(Util::is_permission($user_permission_name,"viewsettle")){
		  	  $return_str.=CHtml::link('查看结算信息',array($controller_id."/viewsettle","order_id"=>$this->id),array('class'=>'operate_green'));
		  }
		  $return_str.="</div>";
		  return $return_str;
		
	}
	
	
	
	
	
		function show_hotels($hotels_id=""){
		$hotels_id=empty($hotels_id)?$this->hotels_id:$hotels_id;
		$hotels=Hotels::model();
		$hotels_data=$hotels->findByPk($hotels_id);
		return "<a href='".Yii::app()->getController()->createUrl("hotels/show",array('id'=>$hotels_data->id))."' target='_blank'>".$hotels_data->title."</a>";
	}
	
	function compare_start_date(){
		if($this->start_date>=$this->end_date){
			
			$this->addError("start_date","入住日期必须小于退房日期");
		}
	}
	
	
	
	
	
	function get_total_settle_price($order_id){
			$order_data=$this->findByPk($order_id);
			$hotels_price=HotelsPrice::model();
      $hotels_price_data=$hotels_price->findByPk($order_data->hotels_price_id);
		  $date=new Date($order_data->start_date);
		  $diff_days=$date->dateDiff($order_data->end_date);
		  $settle_total_price=floatval($order_data->numbers*$hotels_price_data->settle_price*$diff_days);
		  return $settle_total_price;
	}
	
	
	
	
	
	
}