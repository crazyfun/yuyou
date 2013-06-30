<?php

/**
 * This is the model class for table "{{group_customize}}".
 *
 * The followings are the available columns in table '{{group_customize}}':
 * @property string $id
 * @property string $contact_name
 * @property string $contact_phone
 * @property string $contact_tel
 * @property string $contact_email
 * @property integer $reply_time
 * @property string $company_name
 * @property integer $start_region
 * @property string $end_region
 * @property string $start_time
 * @property string $adults
 * @property string $childs
 * @property string $travel_nums
 * @property string $travel_budget
 * @property integer $transport
 * @property string $transport_tips
 * @property integer $stay
 * @property string $stay_tips
 * @property integer $dinning
 * @property string $dinning_tips
 * @property integer $guide
 * @property string $guide_tips
 * @property integer $shopping
 * @property string $shopping_tips
 * @property integer $meeting
 * @property string $meeting_tips
 * @property string $other_tips
 * @property integer $status
 * @property string $create_id
 * @property string $create_time
 */
class GroupCustomize extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GroupCustomize the static model class
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
		return '{{group_customize}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('contact_name,contact_phone,contact_tel','required','message'=>'{attribute}为空'),
		  array('contact_email','email'),
			array('reply_time, transport, stay, dinning, guide, shopping, meeting, status', 'numerical', 'integerOnly'=>true),
			array('contact_name, contact_phone, contact_tel, contact_email, start_time,end_time','length', 'max'=>30),
			array('company_name', 'length', 'max'=>100),
			array('adults, childs,start_region,end_region,travel_nums, travel_budget, create_time', 'length', 'max'=>11),
			array('transport_tips, stay_tips, dinning_tips, guide_tips, shopping_tips, meeting_tips, other_tips', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, contact_name, contact_phone, contact_tel, contact_email, reply_time, company_name, start_region, end_region, start_time,end_time, adults, childs, travel_nums, travel_budget, transport, transport_tips, stay, stay_tips, dinning, dinning_tips, guide, guide_tips, shopping, shopping_tips, meeting, meeting_tips, other_tips, status, create_time', 'safe', 'on'=>'search'),
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
		  'StartRegion'=>array(self::BELONGS_TO,'Region','start_region'),
		  'EndRegion'=>array(self::BELONGS_TO,'Region','end_region'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'contact_name' => '联系人',
			'contact_phone' => '手机号码',
			'contact_tel' => '联系电话',
			'contact_email' => '邮箱',
			'reply_time' => '回复时间',
			'company_name' => '公司名称',
			'start_region' => '出发城市',
			'end_region' => '目的地',
			'start_time' => '出发日期',
			'end_time'=>'返程日期',
			'adults' => '成人数',
			'childs' => '儿童数',
			'travel_nums' => '天数',
			'travel_budget' => '出游预算',
			'transport' => '交通工具',
			'transport_tips' => '交通工具需求',
			'stay' => '住宿标准',
			'stay_tips' => '住宿标准需求',
			'dinning' => '用餐标准',
			'dinning_tips' => '用餐标准需求',
			'guide' => '导游要求',
			'guide_tips' => '导游要求需求',
			'shopping' => '购物安排',
			'shopping_tips' => '购物安排需求',
			'meeting' => '会议安排',
			'meeting_tips' => '会议安排需求',
			'other_tips' => '其他需求',
			'status' => '过期状态',
			'create_time' => '创建世间',
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
		$criteria->compare('contact_name',$this->contact_name,true);
		$criteria->compare('contact_phone',$this->contact_phone,true);
		$criteria->compare('contact_tel',$this->contact_tel,true);
		$criteria->compare('contact_email',$this->contact_email,true);
		$criteria->compare('reply_time',$this->reply_time);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('start_region',$this->start_region);
		$criteria->compare('end_region',$this->end_region,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('adults',$this->adults,true);
		$criteria->compare('childs',$this->childs,true);
		$criteria->compare('travel_nums',$this->travel_nums,true);
		$criteria->compare('travel_budget',$this->travel_budget,true);
		$criteria->compare('transport',$this->transport);
		$criteria->compare('transport_tips',$this->transport_tips,true);
		$criteria->compare('stay',$this->stay);
		$criteria->compare('stay_tips',$this->stay_tips,true);
		$criteria->compare('dinning',$this->dinning);
		$criteria->compare('dinning_tips',$this->dinning_tips,true);
		$criteria->compare('guide',$this->guide);
		$criteria->compare('guide_tips',$this->guide_tips,true);
		$criteria->compare('shopping',$this->shopping);
		$criteria->compare('shopping_tips',$this->shopping_tips,true);
		$criteria->compare('meeting',$this->meeting);
		$criteria->compare('meeting_tips',$this->meeting_tips,true);
		$criteria->compare('other_tips',$this->other_tips,true);
		$criteria->compare('status',$this->status);
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
	 	case 'reply_time':
	 	     $GROUP_REPLY_TIME=CV::$GROUP_REPLY_TIME;
	 	     return $GROUP_REPLY_TIME[$this->reply_time];
	  case 'create_time':
	    	return date('Y-m-d H:i:s',$this->create_time);
	    	break;
	   case 'start_region':
	        return $this->StartRegion->region_name;
	   	    break;
	   case 'end_region':
	        return $this->EndRegion->region_name;
	   	    break;
	   case 'transport':
	   	   $GROUP_TRANSPORT=CV::$GROUP_TRANSPORT;
	        return $GROUP_TRANSPORT[$this->transport];
	   	    break;
	   	case 'stay':
	   	   $GROUP_STAY=CV::$GROUP_STAY;
	        return $GROUP_STAY[$this->stay];
	   	    break;
	   	case 'dinning':
	   	   $GROUP_DINNING=CV::$GROUP_DINNING;
	        return $GROUP_DINNING[$this->dinning];
	   	    break;
	    case 'guide':
	   	   $GROUP_GUIDE=CV::$GROUP_GUIDE;
	        return $GROUP_GUIDE[$this->guide];
	   	    break;
	   	 case 'shopping':
	   	   $GROUP_SHOPPING=CV::$GROUP_SHOPPING;
	        return $GROUP_SHOPPING[$this->shopping];
	   	    break;
	   	case 'meeting':
	   	   $GROUP_MEETING=CV::$GROUP_MEETING;
	        return $GROUP_MEETING[$this->meeting];
	   	    break;
	   	case 'status':
	   	    $GROUP_CUSTOMIZE_STATUS=CV::$GROUP_CUSTOMIZE_STATUS;
	   	    return $GROUP_CUSTOMIZE_STATUS[$this->status];
	   	    break;
		default:
		    return $this->$attribute_id;
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
		   $return_str.="</div>";
		  return $return_str;
	}
}