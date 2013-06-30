<?php

/**
 * This is the model class for table "{{hotels_beds}}".
 *
 * The followings are the available columns in table '{{hotels_beds}}':
 * @property string $id
 * @property string $hotels_id
 * @property string $price
 * @property string $o_price
 * @property integer $line
 * @property integer $bed
 */
class HotelsPrice extends BaseActive
{
	public $type_period_value1="";
	public $type_period_value2="";
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HotelsBeds the static model class
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
		return '{{hotels_price}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hotels_id,bed_id,line,bed,breakfast,price,o_price,settle_price,numbers', 'required','message'=>'{attribute}不能为空'),
			array('line, bed,breakfast,date_type', 'numerical', 'integerOnly'=>true),
			array('hotels_id,bed_id,numbers,price, o_price,settle_price', 'length', 'max'=>11),
			array('type_value1,type_value2','length','max'=>'30'),
			array('price_desc,settle_price_desc','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, hotels_id,bed_id,date_type,price_desc,settle_price_desc, type_value1,type_value2,price, o_price, settle_price,line, bed,breakfast', 'safe', 'on'=>'search'),
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
			'HotelsBeds'=>array(self::BELONGS_TO,'HotelsBeds','bed_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'hotels_id' => '酒店',
			'bed_id'=>'房型名称',
			'date_type'=>'时间类型',
			'type_value1'=>'类型1',
			'type_value2'=>'类型2',
			'price' => '价格',
			'price_desc'=>'价格说明',
			'o_price' => '原价',
			'settle_price'=>'结算价',
			'settle_price_desc'=>'结算价说明',
			'line' => '宽带',
			'bed' => '床型',
			'breakfast'=>'早餐',
			'numbers'=>'房间数'
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
		$criteria->compare('hotels_id',$this->hotels_id,true);
		$criteria->compare('bed_id',$this->name,true);
		$criteria->compare('date_type',$this->date_type,true);
		$criteria->compare('type_value1',$this->type_value1,true);
		$criteria->compare('type_value2',$this->type_value2,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('price_desc',$this->price_desc,true);
		$criteria->compare('o_price',$this->o_price,true);
		$criteria->compare('settle_price',$this->settle_price,true);
		$criteria->compare('settle_price_desc',$this->settle_price_desc,true);
		$criteria->compare('line',$this->line);
		$criteria->compare('bed',$this->bed);
		$criteria->compare('breakfast',$this->breakfast);
		$criteria->compare('numbers',$this->numbers);

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
	    case 'hotels_id':
	    	return $this->Hotels->title;
	    	break;
	   case 'bed_id':
	      return $this->HotelsBeds->name;
	   case 'date_type':
	 			$date_type=array('1'=>'规律日期','2'=>'日期段');
	 	    return $date_type[$this->date_type];
	 			break;
	 	case 'type_value1':
	 		if($this->date_type=='1'){
	 				return CV::$regular_month[$this->type_value1];
	 	   }else{
	 	    	return $this->type_value1;	
	 	   }
	 	    break;
	  case 'type_value2':
	    	if($this->date_type=='1'){
	 				return CV::$regular_day[$this->type_value2];
	 	    }else{
	 	    	return $this->type_value2;	
	 	    }
	 	    break;
	    case 'line':
	      $HOTELS_LINE=CV::$HOTELS_LINE;
	      return $HOTELS_LINE[$this->line];
	      break;
	    case 'bed':
	      $HOTELS_BED=CV::$HOTELS_BED;
	      return $HOTELS_BED[$this->bed];      
	      break;
	    case 'breakfast':
	      $HOTELS_BREAKFAST=CV::$HOTELS_BREAKFAST;
	      return $HOTELS_BREAKFAST[$this->breakfast];
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
		  if(Util::is_permission($user_permission_name,"edit"))
		     $return_str.=CHtml::link('修改',array($controller_id."/edit","id"=>$this->id),array('class'=>'operate_green'));
		  if(Util::is_permission($user_permission_name,"delete"))
		     $return_str.=CHtml::link('删除','javascript:void(0);',array('id'=>'delete_'.$this->id,'class'=>'operate_red','onclick'=>"javascript:ajax_delete('".Yii::app()->getController()->createUrl('main/delete')."','".get_class($this)."','".$this->id."');"));
		   $return_str.="</div>";
		  return $return_str;
	}
	
	//获取剩余的房间数
	function get_room_remain($hotels_price_id="",$start_date,$end_date){
		$hotels_price_id=empty($hotels_price_id)?$this->id:$hotels_price_id;
		$hotels_price_data=$this->findByPk($hotels_price_id);
		$numbers=$hotels_price_data->numbers;
		$start_date_time=strtotime($start_date);
		$end_date_time=strtotime($end_date);
    $diff_day=($end_date_time-$start_date_time)/86400;
    $remain_flag=true;
    $hotels_order_numbers=HotelsOrderNumbers::model();
    for($ii=0;$ii <= $diff_day;$ii++){
    	$current_date=date("Y-m-d",mktime(0,0,0,date("m",$start_date_time),(date("d",$start_date_time)+$ii),date("Y",$start_date_time)));
			$hotels_order_numbers_data=$hotels_order_numbers->find(array('select'=>'order_numbers,date','condition'=>"t.hotels_price_id=:hotels_price_id AND t.date=:current_date",'params'=>array(':hotels_price_id'=>$hotels_price_id,':current_date'=>$current_date)));
    	$order_numbers=$hotels_order_numbers_data->order_numbers;
    	$sub_numbers=$numbers-$order_numbers;
    	if($sub_numbers<=0){
    		$remain_flag=false;
        break;
    	}	
    }
    return $remain_flag;
	}
	
	//根据时间获取剩余的房间数
	function get_over_beds($hotels_price_id="",$start_date,$end_date){
		$start_date_time=strtotime($start_date);
		$end_date_time=strtotime($end_date);
		if(empty($hotels_price_id)){
			$hotels_price_datas=$this->findByPk($hotels_price_id);
			$numbers=$hotels_price_data->numbers;
		}else{
			$numbers=$this->numbers;
		}
		$hotels_order_numbers=HotelsOrderNumbers::model();
		$hotels_order_numbers_data=$hotels_order_numbers->findAll(array('select'=>'order_numbers,date','condition'=>"t.hotels_price_id=:hotels_price_id AND (t.date>=:start_date AND t.date<=:end_date)",'params'=>array(':hotels_price_id'=>$hotels_price_id,':start_date'=>$start_date,':end_date'=>$end_date)));
    $diff_day=($end_date_time-$start_date_time)/86400;
    $return_date=array();
    for($ii=0;$ii <= $diff_day;$ii++){
    	$current_date=date("Y-m-d",mktime(0,0,0,date("m",$start_date_time),(date("d",$start_date_time)+$ii),date("Y",$start_date_time)));
    	$return_date[$current_date]="<font color='#ff0000'>还剩".$numbers."间</font>";
    	foreach((array)$hotels_order_numbers_data as $key => $value){
    		$tem_date=$value->date;
    		$order_numbers=$value->order_numbers;
    		if($current_date==$tem_date){
    			$diff_name=(($numbers-$order_numbers)>0)?("<font color='#ff0000'>还剩".($numbers-$order_numbers)."间</font>"):"<font color='#999999'>已预定完</font>";
    			$return_date[$current_date]=$diff_name;
    		}
    	}
    }
    return $return_date;
	}
}