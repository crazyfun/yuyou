<?php

/**
 * This is the model class for table "{{group_order}}".
 *
 * The followings are the available columns in table '{{group_order}}':
 * @property string $id
 * @property string $group_id
 * @property string $user_id
 * @property string $amount
 * @property string $total_price
 * @property integer $status
 * @property integer $pay_status
 * @property string $pay_time
 * @property string $create_time
 */
class GroupOrder extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GroupOrder the static model class
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
		return '{{group_order}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('group_id,amount,total_price,cell_phone', 'required','message'=>'{attribute}不能为空'),
			array('status, pay_status', 'numerical', 'integerOnly'=>true),
			array('group_id, user_id, amount, total_price, pay_time, create_time,user_time', 'length', 'max'=>11),
			array('cell_phone,order_serial','length','max'=>'30'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, group_id, user_id, amount, cell_phone,total_price, status, pay_status, pay_time, create_time,user_time', 'safe', 'on'=>'search'),
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
		  'User'=>array(self::BELONGS_TO,'User','user_id'),
		  'Group'=>array(self::BELONGS_TO,'Group','group_id'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'group_id' => '团购产品',
			'user_id' => '用户名称',
			'order_serial'=>'订单序列号',
			'cell_phone'=>'手机号码',
			'amount' => '购买数量',
			'total_price' => '购买总价',
			'status' => '订单状态',
			'pay_status' => '付款状态',
			'pay_time' => '付款时间',
			'user_time'=>'使用时间',
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
		$criteria->compare('group_id',$this->group_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('order_serial',$this->order_serial,true);
		$criteria->compare('cell_phone',$this->cell_phone,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('total_price',$this->total_price,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('pay_status',$this->pay_status);
		$criteria->compare('user_time',$this->user_time);
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
	    case 'group_id':
	      return $this->Group->title;
	      break;
	    case 'status':
	      $status=CV::$group_status;
	      return $status[$this->status];
	      break;
	   
	   case 'pay_status':
	      $group_pay_status=CV::$group_pay_status;
	    	return $group_pay_status[$this->pay_status];
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
	
	function show_group_title($group_id=""){
		if(empty($group_id)){
			$group_id=$this->group_id;
		}
		$group=Group::model();
		$group_data=$group->findByPk($group_id);
		return CHtml::link($group_data->title,array('group/show','id'=>$group_id),array());
	}
	
  function show_company_name($company_id=""){
		if(empty($company_id)){
			$company_id=$this->Group->company_id;
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
		  	if($this->pay_status=='1'&&$this->status=='1'){
		  	   $return_str.=CHtml::link('取消',array($controller_id."/status","id"=>$this->id,"status"=>'3'),array('class'=>'operate_green'));
		    }
      }
		  $return_str.="</div>";
		  return $return_str;
	}
	
		function get_group_operate(){
		  $user=new User();
		  $user_permission_name=$user->get_permissions_name();
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="<div class='operate_button'>";
		  if(Util::is_permission($user_permission_name,"view"))
		     $return_str.=CHtml::link('查看',array($controller_id."/view","id"=>$this->id),array('class'=>'operate_green'));
		  
		  $return_str.="</div>";
		  return $return_str;
	}
		function get_web_operate(){
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="<div class='operate_button'>";
		  $return_str.=CHtml::link('查看',array($controller_id."/grouporderview","id"=>$this->id),array('class'=>'operate_green'));
		  if($this->pay_status=='1'&&$this->status=='1'){
		  	 $return_str.=CHtml::link('付款',array("grouppay/step2","id"=>$this->id),array('class'=>'operate_green'));
		  	 $return_str.=CHtml::link('取消',array($controller_id."/grouporderstatus","id"=>$this->id,"status"=>'3'),array('class'=>'operate_green'));
		  }
		  if($this->pay_status=='2'){
		  	$return_str.=CHtml::link('查看订单号',"javascript:send_group_order_serial('".$this->id."')",array('class'=>'operate_green'));
		  }
		  $return_str.="</div>";
		  return $return_str;
	}
	
	
	
		
	
	
}