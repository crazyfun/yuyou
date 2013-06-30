<?php

/**
 * This is the model class for table "{{insurance}}".
 *
 * The followings are the available columns in table '{{insurance}}':
 * @property string $id
 * @property string $insurance_name
 * @property string $insurance_company
 * @property string $company_address
 * @property string $contacter
 * @property string $contacter_phone
 * @property string $insurance_price
 * @property string $insurance_desc
 * @property string $insurance_date
 * @property string $start_time
 * @property string $end_time
 * @property integer $company_id
 * @property string $create_time
 */
class Insurance extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Insurance the static model class
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
		return '{{insurance}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('insurance_name,insurance_price','required','message'=>'{attribute}不能为空','on'=>'AdminLogin'),
			array('create_time', 'required'),
			array('company_id', 'numerical', 'integerOnly'=>true),
			array('insurance_name, insurance_company', 'length', 'max'=>100),
			array('company_address', 'length', 'max'=>200),
			array('contacter, contacter_phone, start_time, end_time', 'length', 'max'=>30),
			array('insurance_price, insurance_date', 'length', 'max'=>11),
			array('insurance_desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, insurance_name, insurance_company, company_address, contacter, contacter_phone, insurance_price, insurance_desc, insurance_date, start_time, end_time, company_id, create_time', 'safe', 'on'=>'search'),
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
			'insurance_name' => '保险名称',
			'insurance_company' => '保险公司',
			'company_address' => '保险公司地址',
			'contacter' => '联系人',
			'contacter_phone' => '联系电话',
			'insurance_price' => '保险价钱',
			'insurance_desc' => '保险描述',
			'insurance_date' => '保险时间',
			'start_time' => '签约时间',
			'end_time' => '到期时间',
			'company_id' => '公司名称',
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
		$criteria->compare('insurance_name',$this->insurance_name,true);
		$criteria->compare('insurance_company',$this->insurance_company,true);
		$criteria->compare('company_address',$this->company_address,true);
		$criteria->compare('contacter',$this->contacter,true);
		$criteria->compare('contacter_phone',$this->contacter_phone,true);
		$criteria->compare('insurance_price',$this->insurance_price,true);
		$criteria->compare('insurance_desc',$this->insurance_desc,true);
		$criteria->compare('insurance_date',$this->insurance_date,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('company_id',$this->company_id);
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
	
	function get_insurance_data($company_id){
	    $condition=array();
	    $params=array();
	    if(!empty($company_id)){
	       $condition[]="t.company_id=:company_id";
	       $params[':company_id']=$company_id;	
	    }else{
	    	 $condition[]="t.company_id=:company_id";
	       $params[':company_id']='0';
	    }
	    $insurance_data=$this->findAll(implode(" AND ",$condition),$params);
	    return $insurance_data;
	}
}