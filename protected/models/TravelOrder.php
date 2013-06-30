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
class TravelOrder extends BaseActive{
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
		return '{{travel_order}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('travel_id,travel_date,adult_price,fa_price,child_price,fc_price,adult_nums,child_nums','required','message'=>'{attribute}不能为空'),
			array('travel_id,user_id,operate_id,goperate_id, adult_price, fa_price, child_price, fc_price, adult_nums, child_nums, coupon,total_price,company_id,pay_time,create_time', 'length', 'max'=>11),
			array('status,pay_status,reserved', 'length', 'max'=>1),
			array('travel_date,reserved_date', 'length', 'max'=>30),
			array('comment','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, travel_id,user_id,reserved,reserved_date,operate_id,goperate_id, travel_date, adult_price, fa_price, child_price, fc_price, adult_nums, child_nums, coupon,total_price,status,pay_status,company_id,pay_time,create_time,comment', 'safe', 'on'=>'search'),
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
	    	'User'=>array(self::BELONGS_TO,'User','user_id'),
	    	'TravelOrderContacter'=>array(self::HAS_MANY,'TravelOrderContacter','order_id'),
	    	'Company'=>array(self::BELONGS_TO,'Company','company_id'),
	    	'OperateUser'=>array(self::BELONGS_TO,'User','operate_id'),
	    	'GoperateUser'=>array(self::BELONGS_TO,'User','goperate_id'),
	    	'TravelSettle'=>array(self::HAS_ONE,'TravelSettle','order_id'),
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
			'user_id'=>'用户ID',
			'operate_id'=>'操作用户',
			'goperate_id'=>'组团操作用户',
			'travel_date' => '出发时间',
			'adult_price' => '成人价',
			'fa_price' => '成人结算价',
			'child_price' => '儿童价',
			'fc_price' => '儿童结算价',
			'adult_nums' => '成人数',
			'child_nums' => '儿童数',
			'coupon'=>'抵用劵',
			'total_price' => '总支付',
			'status'=>'订单状态',
			'pay_status'=>'付款状态',
			'comment'=>'备注',
			'company_id'=>'报名门市',
			'reserved'=>'预留状态',
			'reserved_date'=>'预留时间',
			'pay_time'=>'付款时间',
			'create_time'=>'创建时间',
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
		$criteira->compare('user_id',$this->user_id,true);
		$criteria->compare('operate_id',$this->operate_id,true);
		$criteria->compare('goperate_id',$this->goperate_id,true);
		$criteria->compare('travel_date',$this->travel_date,true);
		$criteria->compare('adult_price',$this->adult_price,true);
		$criteria->compare('fa_price',$this->fa_price,true);
		$criteria->compare('child_price',$this->child_price,true);
		$criteria->compare('fc_price',$this->fc_price,true);
		$criteria->compare('adult_nums',$this->adult_nums,true);
		$criteria->compare('child_nums',$this->child_nums,true);
		$criteria->compare('coupon',$this->coupon,true);
		$criteria->compare('total_price',$this->total_price,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('pay_status',$this->pay_status,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('reserved',$this->reserved,true);
		$criteria->compare('reserved_date',$this->reserved_date,true);
		$criteria->compare('pay_time',$this->pay_time,true);
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
				$this->user_id=Yii::app()->user->id;
			   $this->status='1';
		    	$this->pay_status='1';
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
			case 'order_serial':
			  $travel_order_seiral=TravelOrderSerial::model();
			  $order_seiral_data=$travel_order_seiral->find("t.order_id=:order_id",array(':order_id'=>$this->id));
			  return $order_seiral_data->order_serial;
			  break;
			case 'contacter_name':
			  $travel_order_contacter=TravelOrderContacter::model();
			  $travel_order_contacter_datas=$travel_order_contacter->find("t.order_id=:order_id AND t.main=:main",array(':order_id'=>$this->id,':main'=>'1'));
			  return $travel_order_contacter_datas->contacter;
			  break;
			case 'contacter_phone':
			  $travel_order_contacter=TravelOrderContacter::model();
			  $travel_order_contacter_datas=$travel_order_contacter->find("t.order_id=:order_id AND t.main=:main",array(':order_id'=>$this->id,':main'=>'1'));
			  return $travel_order_contacter_datas->contacter_phone;
			  break;
			case 'company_id':
			  return $this->Company->company_name;
			  break;
			case 'user_id':
				return empty($this->user_id)?"游客":$this->User->user_login;
				break;
		  case 'operate_id':
		    return $this->OperateUser->real_name;
		  case 'goperate_id':
		    return $this->GoperateUser->real_name;
			case 'travel_id':
				 return $this->Travel->title;
				break;
		  case 'settle_status':
		     return empty($this->TravelSettle->status)?"未结算":$this->TravelSettle->show_attribute("status");
		     break;
			case 'status':
				$status=CV::$travel_order_status;
			    return $status[$this->status];
				break;
			case 'all_price':
			  return $this->total_price+$this->coupon;
			  break;
		    case 'pay_status':
		    	$pay_status=CV::$travel_pay_status;
		        return $pay_status[$this->pay_status];
		    	break;
		    case 'pay_time':
		    	return empty($this->pay_time)?"未付款":date("Y-m-d",$this->pay_time);
				break;
		    case 'create_time':
		    return date("Y-m-d",$this->create_time);
				break;
		  case 'reserved':
		  $user=new User();
		  $user_permission_name=$user->get_permissions_name();
		  $controller_id=Yii::app()->getController()->getId();
		  if(Util::is_permission($user_permission_name,"reserved")){
		    $travel_reserved=CV::$travel_reserved;
		    if($this->reserved=='1'){
		    	if($this->status!='6'&&$this->status!='7'&&$this->status!='8'&&$this->status!='9'){
		    		return $travel_reserved[$this->reserved].CHtml::link('预留',array($controller_id."/reserved","id"=>$this->id,'status'=>'2'),array('class'=>'operate_green'));
		    	}else{
		    		return "未预留";
		    	}
		    }
		    if($this->reserved=='2'){
		    	return $travel_reserved[$this->reserved]."(预留到:".$this->reserved_date.")".CHtml::link('取消预留',array($controller_id."/reserved","id"=>$this->id,'status'=>'1'),array('class'=>'operate_green'));
		    }
		  }
		    break;
			default:
			  return $this->$attribute_name;
			  break;
		}
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
		  	
		  	if($this->status=='2'){
		  		
		  	 	  $return_str.=CHtml::link('客服已联系',array($controller_id."/status","id"=>$this->id,'status'=>'3'),array('class'=>'operate_green'));
		  	 
		  	}
		  	
		  	if($this->status=='3'){
		  		
		  	 	  $return_str.=CHtml::link('客户已答复',array($controller_id."/status","id"=>$this->id,'status'=>'4'),array('class'=>'operate_green'));
		  	  
		  	}
		  	
		  	if($this->status=='4'){
		  		
		  	 	  $return_str.=CHtml::link('已发确认书',array($controller_id."/status","id"=>$this->id,'status'=>'5'),array('class'=>'operate_green'));
		  	  
		  	}
		  	if($this->reserved=='1'){
		  	if($this->status=='5'&&$this->pay_status == '2'){
		  		
		  	 	  $return_str.=CHtml::link('已转成正式订单',array($controller_id."/status","id"=>$this->id,'status'=>'6'),array('class'=>'operate_green'));
		  	  
		  	}
		  	
		  	if($this->status=='6'&&$this->pay_status == '2'){
		  		
		  	 	 $return_str.=CHtml::link('已发团通知书',array($controller_id."/status","id"=>$this->id,'status'=>'7'),array('class'=>'operate_green'));
		  	  
		  	 }
		  	}
		  	
		  	if($this->status=='1' || $this->status=='2' || $this->status=='3' || $this->status=='4' || $this->status=='5'){
		  		
		  		   $return_str.=CHtml::link('取消订单',array($controller_id."/status","id"=>$this->id,'status'=>'8'),array('class'=>'operate_green'));
		  	  
		  	}
      }

		  $return_str.="</div>";
		  return $return_str;
	}
	
	
		function get_dijie_operate(){
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
		  	
		  	if($this->status=='2'){
		  		if(Yii::app()->getController()->company_id==$this->company_id){
		  	 	  $return_str.=CHtml::link('客服已联系',array($controller_id."/status","id"=>$this->id,'status'=>'3'),array('class'=>'operate_green'));
		  	 }
		  	}
		  	
		  	if($this->status=='3'){
		  		if(Yii::app()->getController()->company_id==$this->company_id){
		  	 	  $return_str.=CHtml::link('客户已答复',array($controller_id."/status","id"=>$this->id,'status'=>'4'),array('class'=>'operate_green'));
		  	  }
		  	}
		  	
		  	if($this->status=='4'){
		  		if(Yii::app()->getController()->company_id==$this->company_id){
		  	 	  $return_str.=CHtml::link('已发确认书',array($controller_id."/status","id"=>$this->id,'status'=>'5'),array('class'=>'operate_green'));
		  	  }
		  	}
		  	if($this->reserved=='1'){
		  	if($this->status=='5'&&$this->pay_status == '2'){
		  		if(Yii::app()->getController()->company_id==$this->company_id){
		  	 	  $return_str.=CHtml::link('已转成正式订单',array($controller_id."/status","id"=>$this->id,'status'=>'6'),array('class'=>'operate_green'));
		  	  }
		  	}
		  	
		  	if($this->status=='6'&&$this->pay_status == '2'){
		  		if(Yii::app()->getController()->company_id==$this->company_id){
		  	 	 $return_str.=CHtml::link('已发团通知书',array($controller_id."/status","id"=>$this->id,'status'=>'7'),array('class'=>'operate_green'));
		  	  }
		  	 }
		  	}
		  	
		  	if($this->status=='1' || $this->status=='2' || $this->status=='3' || $this->status=='4' || $this->status=='5'){
		  		if(Yii::app()->getController()->company_id==$this->company_id){
		  		   $return_str.=CHtml::link('取消订单',array($controller_id."/status","id"=>$this->id,'status'=>'8'),array('class'=>'operate_green'));
		  	  }
		  	}
      }
      if(Util::is_permission($user_permission_name,"pay")){
     	 if(($this->pay_status == '1'&&$this->status!='6'&&$this->status!='7'&&$this->status!='8'&&$this->status!='9')){
     	 	 if(Yii::app()->getController()->company_id==$this->company_id){
      		  $return_str.=CHtml::link('付款',array($controller_id."/pay","id"=>$this->id),array('class'=>'operate_green'));
      		  
      		}
      	}
      } 
      if(Util::is_permission($user_permission_name,"setuser")){
     	    $return_str.=CHtml::link('关联用户',array($controller_id."/setuser","id"=>$this->id),array('class'=>'operate_green'));
      } 
		  $return_str.="</div>";
		  return $return_str;
	}
	
	
	
	function get_zutuan_operate(){
		  $user=new User();
		  $user_permission_name=$user->get_permissions_name();
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="<div class='operate_button'>";
		  if(Util::is_permission($user_permission_name,"view"))
		     $return_str.=CHtml::link('查看',array($controller_id."/view","id"=>$this->id),array('class'=>'operate_green'));
		  if(Util::is_permission($user_permission_name,"status")){
		  	
		  	
		  	if($this->status=='2'){
		  	 	$return_str.=CHtml::link('客服已联系',array($controller_id."/status","id"=>$this->id,'status'=>'3'),array('class'=>'operate_green'));
		  	}
		  	
		  	if($this->status=='3'){
		  	 	$return_str.=CHtml::link('客户已答复',array($controller_id."/status","id"=>$this->id,'status'=>'4'),array('class'=>'operate_green'));
		  	}
		  	
		  	if($this->status=='4'){
		  	 	$return_str.=CHtml::link('已发确认书',array($controller_id."/status","id"=>$this->id,'status'=>'5'),array('class'=>'operate_green'));
		  	}
		  	if($this->reserved=='1'){
		  	if($this->status=='5'&&$this->pay_status == '2'){
		  	 	$return_str.=CHtml::link('已转成正式订单',array($controller_id."/status","id"=>$this->id,'status'=>'6'),array('class'=>'operate_green'));
		  	}
		  	
		  	if($this->status=='6'&&$this->pay_status == '2'){
		  	 	$return_str.=CHtml::link('已发团通知书',array($controller_id."/status","id"=>$this->id,'status'=>'7'),array('class'=>'operate_green'));
		  	}
		  }
		  	
		  	if($this->status=='1' || $this->status=='2' || $this->status=='3' || $this->status=='4' || $this->status=='5'){
		  		
		  		   $return_str.=CHtml::link('取消订单',array($controller_id."/status","id"=>$this->id,'status'=>'8'),array('class'=>'operate_green'));
		  	  
		  	}
      }
      if(Util::is_permission($user_permission_name,"pay")){
     	 if(($this->pay_status == '1'&&$this->status!='6'&&$this->status!='7'&&$this->status!='8'&&$this->status!='9')){
      		  $return_str.=CHtml::link('付款',array($controller_id."/pay","id"=>$this->id),array('class'=>'operate_green'));
      	}
      } 
      if(Util::is_permission($user_permission_name,"setuser")){
     	    $return_str.=CHtml::link('关联用户',array($controller_id."/setuser","id"=>$this->id),array('class'=>'operate_green'));
      } 
		  $return_str.="</div>";
		  return $return_str;
	}
	
	
	
	
	
	function get_web_operate(){
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="<div class='operate_button'>";
		  $return_str.=CHtml::link('查看',array($controller_id."/travelorderview","id"=>$this->id),array('class'=>'operate_green'));
		  if($this->status!='9'&&$this->status!='8'&&$this->status!='6'&&$this->status!='7'&&$this->pay_status!='2'){
		  	if($this->status=='2'||$this->status=='3'||$this->status=='4'){
		  	 	$return_str.=CHtml::link('付款',array("pay/step4","order_id"=>$this->id),array('class'=>'operate_green'));
		  	}
		  	 $return_str.=CHtml::link('取消',array($controller_id."/travelorderstatus","id"=>$this->id,"status"=>'8'),array('class'=>'operate_green'));
		  }
		  if($this->pay_status=='2'){
		  	$return_str.=CHtml::link('查看订单号',"javascript:send_travel_order_serial('".$this->id."')",array('class'=>'operate_green'));
		  }
		  $return_str.="</div>";
		  return $return_str;
	}
	
	
	function get_dijie_settle_operate(){
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
	
	
	
	
	function create_travel_order($order_id){
		$temp_order=TempOrder::model();
		$temp_order_data=$temp_order->with("Travel")->findByPk($order_id);
		$this->attributes=$temp_order_data->attributes;
		$this->id=null;
		$this->setIsNewRecord(true);
		if($this->validate()){
			    
      		$result=$this->insert_datas();
      		if($result){
      			$temp_order_insurance=TempOrderInsurance::model();
      			$travel_order_insurance=new TravelOrderInsurance();
      			$order_insurance_datas=$temp_order_insurance->findAll("t.order_id=:order_id",array(':order_id'=>$order_id));
      			foreach($order_insurance_datas as $key => $value){
      				$travel_order_insurance->id=null;
	             	$travel_order_insurance->setIsNewRecord(true);
      				$travel_order_insurance->attributes=$value->attributes;
      				$travel_order_insurance->order_id=$this->id;
      				if($travel_order_insurance->validate()){
      					$travel_order_insurance->insert_datas();
      					$temp_order_insurance->deleteByPk($value->id);
      		        }
      			}
      			
      			$tem_order_contacter=TemOrderContacter::model();
      			$travel_order_contacter=new TravelOrderContacter();
      			$order_contacter_datas=$tem_order_contacter->findAll("t.order_id=:order_id",array(':order_id'=>$order_id));
      			foreach($order_contacter_datas as $key => $value){
      				$travel_order_contacter->id=null;
	             	$travel_order_contacter->setIsNewRecord(true);
      				$travel_order_contacter->attributes=$value->attributes;
      				$travel_order_contacter->order_id=$this->id;
      				if($travel_order_contacter->validate()){
      					$travel_order_contacter->insert_datas();
      					$tem_order_contacter->deleteByPk($value->id);
      		        }
      			}
      			
      			$travel_order_serial=new TravelOrderSerial();
      			$travel_order_serial->order_id=$this->id;
      			$travel_order_serial->order_serial="T".Util::randStr(6,"NUMBER").$this->id;
      			if($travel_order_serial->validate()){
      		     	$result=$travel_order_serial->insert_datas();
      		   }
      		   $temp_order->deleteByPk($order_id);	  
      		   return $this->id;
      		}
		}
		
	}
	
	function get_total_price($order_id){
		$order_data=$this->findByPk($order_id);
		$adult_price=$order_data->adult_price;
		$child_price=$order_data->child_price;
		$fa_price=$order_data->fa_price;
		$fc_price=$order_data->fc_price;
		$adult_nums=$order_data->adult_nums;
		$child_nums=$order_data->child_nums;
		$order_total_price=(floatval($adult_price)*floatval($adult_nums))+(floatval($child_price)*floatval($child_nums));
		$travel_order_insurance=TravelOrderInsurance::model();
		$travel_order_insurance_datas=$travel_order_insurance->with("Insurance")->findAll("t.order_id=:order_id",array(':order_id'=>$order_id));
		foreach((array)$travel_order_insurance_datas as $key => $value){
			$order_total_price+=floatval($value->Insurance->insurance_price*$value->insurance_number);
		}
		return $order_total_price;
	}
	
	function get_total_settle_price($order_id){
		$order_data=$this->findByPk($order_id);
		$adult_price=$order_data->adult_price;
		$child_price=$order_data->child_price;
		$fa_price=$order_data->fa_price;
		$fc_price=$order_data->fc_price;
		$adult_nums=$order_data->adult_nums;
		$child_nums=$order_data->child_nums;
		$order_total_price=(floatval($fa_price)*floatval($adult_nums))+(floatval($fc_price)*floatval($child_nums));
		$travel_order_insurance=TravelOrderInsurance::model();
		$travel_order_insurance_datas=$travel_order_insurance->with("Insurance")->findAll("t.order_id=:order_id",array(':order_id'=>$order_id));
		foreach((array)$travel_order_insurance_datas as $key => $value){
			$order_total_price+=floatval($value->Insurance->insurance_price*$value->insurance_number);
		}
		return $order_total_price;
	}
	
	function show_travel($travel_id=""){
		$travel_id=empty($travel_id)?$this->travel_id:$travel_id;
		$travel=Travel::model();
		$travel_data=$travel->findByPk($travel_id);
		return "<a href='".Yii::app()->getController()->createUrl("travel/show",array('id'=>$travel_data->id))."' target='_blank'>".$travel_data->title."</a>";
	}
}