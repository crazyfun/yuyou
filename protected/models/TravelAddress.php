<?php

/**
 * This is the model class for table "{{travel_address}}".
 *
 * The followings are the available columns in table '{{travel_address}}':
 * @property string $id
 * @property string $travel_id
 * @property string $address
 */
class TravelAddress extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TravelAddress the static model class
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
		return '{{travel_address}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('travel_id,address_id','required','message'=>'{attribute}不能为空'),
			array('address_id','exist_address_id'),
			array('travel_id,address_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, travel_id, address_id', 'safe', 'on'=>'search'),
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
			'CompanyAddress'=>array(self::BELONGS_TO,'CompanyAddress','address_id'),
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
			'address_id' => '上车地点',
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
		$criteria->compare('address_id',$this->address_id,true);

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
	 	case 'travel_id':
	 		return $this->Travel->title;
	 		break;
	  case 'address_id':
	    return $this->CompanyAddress->time."&nbsp;".$this->CompanyAddress->address;
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
	
   	function exist_address_id(){
		$id=$this->id;
		if(!empty($id)){
			 $get_table_datas=$this->get_table_datas($id,array());
			 if($get_table_datas->address_id!=$this->address_id){
			 	 $find_datas=$this->find(array(
          			'select'=>'address_id,travel_id',
         			'condition'=>'address_id=:address_id AND travel_id=:travel_id',
          			'params'=>array(':address_id' => $this->address_id,':travel_id'=>$this->travel_id),
         ));
			 }
		}else{
		     $find_datas=$this->find(array(
          			'select'=>'address_id,travel_id',
         			'condition'=>'address_id=:address_id AND travel_id=:travel_id',
          			'params'=>array(':address_id' => $this->address_id,':travel_id'=>$this->travel_id),
         ));
		}
     if(!empty($find_datas)){
     	 $this->addError("address_id","上车地点已存在");
     }
	}
	
	
	function get_address_select($travel_id){
		$address_datas=$this->with("CompanyAddress")->findAll("t.travel_id=:travel_id",array(':travel_id'=>$travel_id));
		$address_select=array();
		foreach($address_datas as $key => $value){
			$address_select[$value->id]=$value->CompanyAddress->time."&nbsp;".$value->CompanyAddress->address;
		}
		return $address_select;
	}
	
	
}