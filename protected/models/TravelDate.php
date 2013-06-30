<?php

/**
 * This is the model class for table "{{trave_date}}".
 *
 * The followings are the available columns in table '{{trave_date}}':
 * @property string $id
 * @property string $trave_id
 * @property integer $date_type
 * @property string $trave_date
 * @property string $child_price
 * @property string $adult_price
 * @property string $fa_price
 * @property integer $fc_price
 * @property string $seats
 * @property string $create_id
 * @property string $create_time
 */
class TravelDate extends BaseActive
{
	
	public $type_period_value1="";
	public $type_period_value2="";
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TraveDate the static model class
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
		return '{{travel_date}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('travel_id,travel_date,date_type,child_price,adult_price,fa_price,fc_price,seats','required','message'=>'{attribute}不能为空'),
			array('date_type', 'numerical', 'integerOnly'=>true),
			array('travel_id, child_price, adult_price, fa_price, fc_price,seats,group,create_id, create_time', 'length', 'max'=>11),
		    array('type_value1,type_value2','length','max'=>30),
			array('travel_date', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, travel_id, date_type,type_value1,type_value2,travel_date, child_price, adult_price, fa_price, fc_price, seats,group, create_id, create_time', 'safe', 'on'=>'search'),
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
			'User'=>array(self::BELONGS_TO,'User','create_id'),
			'Travel'=>array(self::BELONGS_TO,'Travel','travel_id'),
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
			'date_type' => '时间类型',
			'type_value1'=>'规律日期段1',
			'type_value2'=>'规律日期段2',
			'travel_date' => '出发时间',
			'child_price' => '儿童价',
			'adult_price' => '成人价',
			'fa_price' => '成人结算价',
			'fc_price' => '儿童结算价',
			'seats' => '座位数',
			'group'=>'成团人数',
			'create_id' => '创建人',
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
		$criteria->compare('travel_id',$this->travel_id,true);
		$criteria->compare('date_type',$this->date_type);
		$criteria->compare('type_value1',$this->type_value1);
		$criteria->compare('type_value2',$this->type_value2);
		$criteria->compare('travel_date',$this->travel_date,true);
		$criteria->compare('child_price',$this->child_price,true);
		$criteria->compare('adult_price',$this->adult_price,true);
		$criteria->compare('fa_price',$this->fa_price,true);
		$criteria->compare('fc_price',$this->fc_price);
		$criteria->compare('seats',$this->seats,true);
		$criteria->compare('group',$this->group,true);
		$criteria->compare('create_id',$this->create_id,true);
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
				$this->create_id=Yii::app()->user->id;
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
	 	case 'travel_id':
	 		return $this->Travel->title;
	 		break;
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
	 	case 'child_price':
	 			return $this->child_price."元";
	 	    break;
	 	case 'adult_price':
	 			return $this->adult_price."元";
	 	    break;
	 	case 'fa_price':
	 	   
	 			return $this->fa_price."元";
	 	    break;
	 	case 'fc_price':
	 			return $this->fc_price."元";
	 	    break;
	 	case 'seats':
	 			return $this->seats."人";
	 	    break;
	 	case 'group':
	 	    return $this->group."人";
	 	    break;
	  case 'create_id':
	        return $this->User->user_login;
	        break;
	  case 'create_time':
	    	return date('Y-m-d H:i:s',$this->create_time);
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
		  if(Util::is_permission($user_permission_name,"edit"))
		     $return_str.=CHtml::link('修改',array($controller_id."/edit","id"=>$this->id),array('class'=>'operate_green'));
		  if(Util::is_permission($user_permission_name,"delete"))
		     $return_str.=CHtml::link('删除','javascript:void(0);',array('id'=>'delete_'.$this->id,'class'=>'operate_red','onclick'=>"javascript:ajax_delete('".Yii::app()->getController()->createUrl('main/delete')."','".get_class($this)."','".$this->id."');"));
		   $return_str.="</div>";
		  return $return_str;
	}
	
	 //获得时间段的日期
	function get_period_date($open_date,$close_date){
		 
		 $open_date=strtotime($open_date);
		 $date=new Date($open_date);
		 $date_nums=$date->dateDiff($close_date,"d");
		 $date_nums=ceil($date_nums);
		 $return_array=array();
		 $diff_time=(24*60*60);
		for($ii=0;$ii <= $date_nums;$ii++){
			   $current_date=$open_date+($diff_time*$ii);
			   $final_day=date('Y-m-d', $current_date);
			   array_push($return_array,$final_day);
		}
		
		return $return_array;
	}
	
	//月份的天天
	function get_month_days($start_time){
		          $return_array=array();
			    	  $day_m=date('n',$start_time);
			    	  $day_y=date('Y',$start_time);
			    	  $day_nums=date('t',$start_time);
			    	  $current_moth_first=mktime(0,0,0,$day_m,1,$day_y);
			    	  $diff_day=$day_nums;
			    	  $diff_time=(24*60*60);
			    	  for($ii=0;$ii < $diff_day;$ii++){
			    	  	$current_date=$current_moth_first+($diff_time*$ii);
			    	  	$final_day=date('Y-m-d', $current_date);
			    	  	array_push($return_array,$final_day);
			    	  }		
			    	  return $return_array;
		
	}
	
	
	

	
	//月份的星期几
	function get_month_weekly($start_time,$weekly){
		            $return_array=array();
			    	    $day_m=date('n',$start_time);
			    	    $day_y=date('Y',$start_time);
		            $day_nums=date('t',$start_time);
			    	    $current_moth_first=mktime(0,0,0,$day_m,1,$day_y);
                $diff_time=(24*60*60);
                for($ii=0;$ii < $day_nums;$ii++){
                	$tem_date=$current_moth_first+$diff_time*$ii;
                	$tem_day_w=date('w',$tem_date);
                	if($tem_day_w==(($weekly-1)%7)){
                		$final_day=date('Y-m-d', $tem_date);
                		array_push($return_array,$final_day);
                	}
                	
                }
                return $return_array; 
	}
 //对时间进行去重
 function date_unique($travel_dates){
     $tem_array=array();
     foreach($travel_dates as $key => $value){
     	  if(in_array($value['date'],$tem_array)){
     	  	unset($travel_dates[$key]);
     	  }else{
     	  	$tem_array[]=$value['date'];
     	  	continue;
     	  }
     }
     return $travel_dates;
 }
}