<?php

/**
 * This is the model class for table "{{travel_company}}".
 *
 * The followings are the available columns in table '{{travel_company}}':
 * @property string $id
 * @property string $travel_id
 * @property string $company_id
 */
class TravelCompany extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TravelCompany the static model class
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
		return '{{travel_company}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('travel_id,company_id','required','message'=>'{attribute}不能为空'),
			array('company_id','exist_company_id'),
			array('travel_id, company_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, travel_id, company_id', 'safe', 'on'=>'search'),
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
			'travel_id' => '线路名称',
			'company_id' => '公司名称',
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
		$criteria->compare('company_id',$this->company_id,true);

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
       case 'company_id':
		    return $this->Company->company_name."(".$this->Company->address.")";
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
		 
		  if(Util::is_permission($user_permission_name,"delete"))
		     $return_str.=CHtml::link('删除','javascript:void(0);',array('id'=>'delete_'.$this->id,'class'=>'operate_red','onclick'=>"javascript:ajax_delete('".Yii::app()->getController()->createUrl('main/delete')."','".get_class($this)."','".$this->id."');"));
		   $return_str.="</div>";
		  return $return_str;
	}
	
	function exist_company_id(){
		$id=$this->id;
		if(!empty($id)){
			 $get_table_datas=$this->get_table_datas($id,array());
			 if($get_table_datas->company_id!=$this->company_id){
			 	 $find_datas=$this->find(array(
          'select'=>'company_id,travel_id',
          'condition'=>'company_id=:company_id AND travel_id=:travel_id',
          'params'=>array(':company_id' => $this->company_id,':travel_id'=>$this->travel_id),
         ));
			 }
		}else{
			$find_datas=$this->find(array(
         'select'=>'company_id,travel_id',
         'condition'=>'company_id=:company_id AND travel_id=:travel_id',
         'params'=>array(':company_id' => $this->company_id,':travel_id'=>$this->travel_id),
       ));
		}
     if(!empty($find_datas)){
     	 $this->addError("company_id","报名地点已存在");
     }
	}
	
	function get_company_select($travel_id){
		$company_datas=$this->with("Company")->findAll("t.travel_id=:travel_id",array(':travel_id'=>$travel_id));
		$company_select=array();
		foreach($company_datas as $key => $value){
			$company_select[$value->company_id]=$value->Company->company_name."(".$value->Company->address.")";
		}
		return $company_select;
	}
}