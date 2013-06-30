<?php

/**
 * This is the model class for table "{{contacter}}".
 *
 * The followings are the available columns in table '{{contacter}}':
 * @property string $id
 * @property string $user_id
 * @property string $contacter
 * @property string $contacter_phone
 * @property integer $code_type
 * @property string $code_value
 */
class Contacter extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Contacter the static model class
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
		return '{{contacter}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id,contacter', 'required','message'=>'{attribute}不能为空'),
			array('code_type', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>11),
			array('contacter, contacter_phone, code_value', 'length', 'max'=>30),
			array('is_child','length','max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, contacter, contacter_phone, code_type, code_value,is_child', 'safe', 'on'=>'search'),
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
				'User'=>array(self::BELONGS_TO,'User','user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => '用户',
			'contacter' => '联系人',
			'contacter_phone' => '联系电话',
			'code_type' => '证件类型',
			'code_value' => '证件号码',
			'is_child'=>'儿童',
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('contacter',$this->contacter,true);
		$criteria->compare('contacter_phone',$this->contacter_phone,true);
		$criteria->compare('code_type',$this->code_type);
		$criteria->compare('code_value',$this->code_value,true);
        $criteria->compare('is_child',$this->is_child,true);
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
	    case 'user_id':
	    	$this->User->user_login;
	        break;
	    case 'code_type':
	    	$code_type=CV::$code_type;
	        return $code_type[$this->code_type];
	    	break;
	     case 'is_child':
	    	if($this->is_child=="1"){
	    		 return "是";
	        }else{
	             return "不是";	
	        }
	        break;
		default:
		  return $this->$attribute_id;
			break;
	 }
	}
	
    function get_operate(){

		  $return_str="<div class='operate_button'>";
		  $return_str.=CHtml::link('修改',array("user/editcontacter","id"=>$this->id),array('class'=>'operate_green'));
		  $return_str.=CHtml::link('删除',array("user/deletecontacter","id"=>$this->id),array('class'=>'operate_red'));
		  $return_str.="</div>";
		  return $return_str;
	}
	
	
}