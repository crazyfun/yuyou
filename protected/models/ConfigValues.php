<?php

/**
 * This is the model class for table "{{config_values}}".
 *
 * The followings are the available columns in table '{{config_values}}':
 * @property string $id
 * @property integer $type
 * @property string $extern_value
 * @property string $name
 * @property string $value
 */
class ConfigValues extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ConfigValues the static model class
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
		return '{{config_values}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,type,value','required','message'=>'{attribute}不能为空'),
			array('type,sort', 'numerical', 'integerOnly'=>true),
			array('name,extern_value', 'length', 'max'=>30),
			array('value', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, name, value', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => '变量类型',
			'name' => '变量名次',
			'extern_value'=>'附加值',
			'value' => '变量值',
			'sort'=>'排序',
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
		$criteria->compare('type',$this->type);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('extern_value',$this->extern_value,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('sort',$this->sort,true);
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
			
			}else{
			
			}
			return true;
		}else{
			return false;
		}
	}
	
	
	function show_attribute($attribute_name){
		switch($attribute_name){
			case 'type':
				 $config_value_type=CV::$config_value_type;
				 return $config_value_type[$this->type];
				break;
			default:
			  return $this->$attribute_name;
			  break;
		}
	}
	
	function get_value($type,$value){
	   $config_datas=$this->find(array('condition'=>"type=:type AND value=:value",'params'=>array(':type'=>$type,':value'=>$value)));
	   return $config_datas;	
	}
	
	function get_select_values($type){
		$config_datas=$this->findAll(array('condition'=>"type=:type",'params'=>array(':type'=>$type),'order'=>'sort ASC'));
	  $select_array=array();
	  foreach($config_datas as $key => $value){
	  	$select_array[$value->value]=$value->name;
	  }
	  return $select_array;
		
	}
	
	function get_ralation_values($type){
		$config_datas=$this->findAll(array('condition'=>"type=:type",'params'=>array(':type'=>$type),'order'=>'sort ASC'));
	  $select_array=array();
	  foreach($config_datas as $key => $value){
	  	$select_array[$value->id]=$value->name;
	  }
	  return $select_array;
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
}