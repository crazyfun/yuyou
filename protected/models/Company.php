<?php

/**
 * This is the model class for table "{{company}}".
 *
 * The followings are the available columns in table '{{company}}':
 * @property string $id
 * @property string $company_name
 * @property string $contact
 * @property string $contact_phone
 * @property string $telephone
 * @property string $email
 * @property string $address
 * @property string $coordinate
 * @property string $qq1
 * @property string $qq2
 * @property string $qq3
 * @property string $bank_name
 * @property string $bank_owner
 * @property string $bank_account
 * @property integer $region_id
 * @property string $create_time
 */
class Company extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Company the static model class
	 */
	 public $agreement;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{company}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_name,company_type,contact,contact_phone,telephone,address,region_id','required','message'=>'{attribute}不能为空'),
			 array('company_name','exist_company_name'),
			array('company_name, coordinate, bank_name, bank_account', 'length', 'max'=>100),
			array('contact, contact_phone, telephone, email, qq1, qq2, qq3, bank_owner,start_time,end_time', 'length', 'max'=>30),
			array('agreement', 'compare', 'compareValue'=>'1','message'=>'未同意誉游网商家协议'),
			array('address,traffic', 'length', 'max'=>200),
		  array('company_type,status','length','max'=>1),
			array('region_id,create_time', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, company_name, company_type,contact, contact_phone, telephone, email, address,traffic, coordinate, qq1, qq2, qq3, bank_name, bank_owner, bank_account, create_time', 'safe', 'on'=>'search'),
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
       'Region'=>array(self::BELONGS_TO,'Region','region_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'company_name' => '公司名称',
			'company_type'=>'公司性质',
			'contact' => '联系人',
			'contact_phone' => '联系电话',
			'telephone' => '公司座机',
			'email' => '邮箱',
			'address' => '公司地址',
			'traffic'=>'交通指南',
			'coordinate' => '坐标',
			'qq1' => '联系qq1',
			'qq2' => '联系qq2',
			'qq3' => '联系qq3',
			'bank_name' => '银行名称',
			'bank_owner' => '户名',
			'bank_account' => '银行帐号',
			'status'=>'开通状态',
			'start_time'=>'开始时间',
			'end_time'=>'结束时间',
			'region_id'=>'区域名称',
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
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('company_type',$this->company_type,true);
		$criteria->compare('contact',$this->contact,true);
		$criteria->compare('contact_phone',$this->contact_phone,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('traffic',$this->traffic,true);
		$criteria->compare('coordinate',$this->coordinate,true);
		$criteria->compare('qq1',$this->qq1,true);
		$criteria->compare('qq2',$this->qq2,true);
		$criteria->compare('qq3',$this->qq3,true);
		$criteria->compare('bank_name',$this->bank_name,true);
		$criteria->compare('bank_owner',$this->bank_owner,true);
		$criteria->compare('bank_account',$this->bank_account,true);
		$criteria->compare('region_id',$this->region_id,true);
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
			case 'company_type':
			  $company_type=CV::$company_type;
			  return $company_type[$this->company_type];
			  break;
			case 'region_id':

			  return $this->Region->region_name;
			  break;
			case 'status':
				$open_status=CV::$open_status;
			    return $open_status[$this->status];
				break;
		   
			case 'create_time':
				return date("Y-m-d",$this->create_time);
		
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
		  if(Util::is_permission($user_permission_name,"status")){
		  	  if($this->status==1){
		        $return_str.=CHtml::link('开通',array($controller_id."/status","id"=>$this->id,'status'=>'2'),array('class'=>'operate_green'));
		      }else{
		      	  $return_str.=CHtml::link('取消开通',array($controller_id."/status","id"=>$this->id,'status'=>'1'),array('class'=>'operate_green'));
		      }
		  
		  }
		  if(Util::is_permission($user_permission_name,"edit"))
		     $return_str.=CHtml::link('修改',array($controller_id."/edit","id"=>$this->id),array('class'=>'operate_green'));
		  if(Util::is_permission($user_permission_name,"delete"))
		     $return_str.=CHtml::link('删除','javascript:void(0);',array('id'=>'delete_'.$this->id,'class'=>'operate_red','onclick'=>"javascript:ajax_delete('".Yii::app()->getController()->createUrl('main/delete')."','".get_class($this)."','".$this->id."');"));
		   $return_str.="</div>";
		  return $return_str;
	}
	
	function get_company_select($company_type,$region_id){

		$company_datas=$this->findAll("company_type=:company_type AND region_id=:region_id AND status=:status",array(':company_type'=>$company_type,":region_id"=>$region_id,':status'=>'2'));
		$company_select=array();
		foreach((array)$company_datas as $key => $value){
			$company_select[$value->id]=$value->company_name;
		}
		return $company_select;
	}
	
	
	function exist_company_name(){
		$id=$this->id;
		if(!empty($id)){
			 $get_table_datas=$this->get_table_datas($id,array());
			 if($get_table_datas->company_name!=$this->company_name){
			 	 $find_datas=$this->find(array(
          'select'=>'company_name',
          'condition'=>'company_name=:company_name',
          'params'=>array(':company_name' => $this->company_name),
         ));
			 }
		}else{
			$find_datas=$this->find(array(
         'select'=>'company_name',
         'condition'=>'company_name=:company_name',
         'params'=>array(':company_name' => $this->company_name),
       ));
		}
     if(!empty($find_datas)){
     	 $this->addError("company_name","商家名称已存在");
     }
	}
}