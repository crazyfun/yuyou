<?php

/**
 * This is the model class for table "{{company_address}}".
 *
 * The followings are the available columns in table '{{company_address}}':
 * @property string $id
 * @property string $time
 * @property string $address
 * @property string $company_id
 * @property string $create_time
 */
class CompanyAddress extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CompanyAddress the static model class
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
		return '{{company_address}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('address,company_id','required','message'=>'{attribute}不能为空'),
			array('address','exist_address'),
			array('time', 'length', 'max'=>30),
			array('address', 'length', 'max'=>200),
			array('company_id, create_time', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, time, address, company_id, create_time', 'safe', 'on'=>'search'),
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
			'Company'=>array(self::BELONGS_TO,'Company','company_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'time' => '上车时间',
			'address' => '上车地点',
			'company_id' => '公司ID',
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
		$criteria->compare('time',$this->time,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('company_id',$this->company_id,true);
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
	 	case 'company_id':
	 		return $this->Company->company_name;
	 		break;
	 	case 'create_time':
	  	 return date("Y-m-d H:i:s",$this->create_time);
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
	
	function exist_address(){
		$id=$this->id;
		if(!empty($id)){
			 $get_table_datas=$this->get_table_datas($id,array());
			 if($get_table_datas->address!=$this->address||$get_table_datas->time!=$this->time){
			 	 $find_datas=$this->find(array(
          			'select'=>'address,time',
         			'condition'=>'address=:address AND time=:time',
          			'params'=>array(':address' => $this->address,':time'=>$this->time),
         ));
			 }
		}else{
		      $find_datas=$this->find(array(
          			'select'=>'address,time',
         			'condition'=>'address=:address AND time=:time',
          			'params'=>array(':address' => $this->address,':time'=>$this->time),
         ));
		}
     if(!empty($find_datas)){
     	 $this->addError("address","上车地点已存在");
     }
	}
	
	function get_address_select($company_id){
		$address_datas=$this->findAll("t.company_id=:company_id",array(':company_id'=>$company_id));
		$address_select=array();
		foreach($address_datas as $key => $value){
			$address_select[$value->id]=$value->time.$value->address;
		}
		return $address_select;
	}
}