<?php

/**
 * This is the model class for table "{{themes}}".
 *
 * The followings are the available columns in table '{{themes}}':
 * @property string $id
 * @property string $name
 * @property string $theme_dir
 * @property string $theme_preview
 * @property string $make_name
 * @property string $make_time
 * @property string $create_id
 * @property string $create_time
 */
class Themes extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Themes the static model class
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
		return '{{themes}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,theme_dir,theme_preview', 'required','message'=>'{attribute}不能为空'),
			array('name, make_name, make_time', 'length', 'max'=>30),
			array('theme_dir', 'length', 'max'=>20),
			array('theme_preview', 'length', 'max'=>200),
			array('create_id, create_time', 'length', 'max'=>11),
			array('default_theme','length','max'=>1),
			array('theme_desc','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, theme_dir, theme_preview, make_name, make_time,theme_desc,default_theme,create_id, create_time', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => '模版名称',
			'theme_dir' => '模版路径',
			'theme_preview' => '首页图',
			'make_name' => '制作人',
			'make_time' => '制作时间',
			'theme_desc'=>'模版描述',
			'default_theme'=>'默认模版',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('theme_dir',$this->theme_dir,true);
		$criteria->compare('theme_preview',$this->theme_preview,true);
		$criteria->compare('make_name',$this->make_name,true);
		$criteria->compare('make_time',$this->make_time,true);
		$criteria->compare('theme_desc',$this->theme_desc,true);
		$criteria->compare('default_theme',$this->default_theme,true);
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
	    case 'create_id':
	    	return $this->User->user_login;
	        break;
	    case 'create_time':
	    	return date("Y-m-d H:i:s",$this->create_time);
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
		  if(Util::is_permission($user_permission_name,"status")){
		  	if(empty($this->default_theme)){
		     $return_str.=CHtml::link('设为模版',array($controller_id."/status","id"=>$this->id),array('class'=>'operate_green'));
		    }
		  }
		  if(Util::is_permission($user_permission_name,"edit"))
		     $return_str.=CHtml::link('修改',array($controller_id."/edit","id"=>$this->id),array('class'=>'operate_green'));
		  if(Util::is_permission($user_permission_name,"delete"))
		     $return_str.=CHtml::link('删除','javascript:void(0);',array('id'=>'delete_'.$this->id,'class'=>'operate_red','onclick'=>"javascript:ajax_delete('".Yii::app()->getController()->createUrl('main/delete')."','".get_class($this)."','".$this->id."');"));
		   $return_str.="</div>";
		  return $return_str;
	}
}