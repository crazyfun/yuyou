<?php

/**
 * This is the model class for table "{{travel_route}}".
 *
 * The followings are the available columns in table '{{travel_route}}':
 * @property string $id
 * @property string $travel_id
 * @property integer $route_day
 * @property string $travel_route
 * @property string $route_describe
 * @property string $route_flight
 * @property string $route_stay
 * @property string $route_dining
 * @property string $create_id
 * @property string $create_time
 */
class TravelRoute extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TravelRoute the static model class
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
		return '{{travel_route}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('route_day,travel_id,route_describe,travel_route','required','message'=>'{attribute}不能为空'),
			array('route_day', 'numerical', 'integerOnly'=>true),
			array('travel_id, create_id, create_time', 'length', 'max'=>11),
			array('travel_route, route_stay', 'length', 'max'=>100),
			array('route_flight, route_dining', 'length', 'max'=>30),
			array('route_describe', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, travel_id, route_day, travel_route, route_describe, route_flight, route_stay, route_dining, create_id, create_time', 'safe', 'on'=>'search'),
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
			'route_day' => '行程天数',
			'travel_route' => '途径',
			'route_describe' => '行程描述',
			'route_flight' => '参考航班',
			'route_stay' => '住宿',
			'route_dining' => '餐饮',
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
		$criteria->compare('route_day',$this->route_day);
		$criteria->compare('travel_route',$this->travel_route,true);
		$criteria->compare('route_describe',$this->route_describe,true);
		$criteria->compare('route_flight',$this->route_flight,true);
		$criteria->compare('route_stay',$this->route_stay,true);
		$criteria->compare('route_dining',$this->route_dining,true);
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
	 	case 'route_day':
	 	  return "第".$this->route_day."天";
	  case 'travel_route':
	        $travel_area=TravelArea::model();
	        $travel_route=$this->travel_route;
	        $travel_area_datas=$travel_area->findAll('t.id '.Util::db_create_in($travel_route),array());
	        $return_array=array();
	        foreach($travel_area_datas as $key => $value){
	        	$return_array[]=$value->travel_area;
	        }
	        return implode("->",$return_array);
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
	
	function get_route_datas($travel_id){
	   $route_datas=$this->findAll(array('condition'=>"t.travel_id=:travel_id",'params'=>array(':travel_id'=>$travel_id),'order'=>'route_day ASC'));
	   return $route_datas;
	}
}