<?php

/**
 * This is the model class for table "{{email_templates}}".
 *
 * The followings are the available columns in table '{{email_templates}}':
 * @property string $id
 * @property string $templates_name
 * @property string $templates_content
 * @property string $templates_title
 * @property string $create_id
 * @property string $create_time
 */
class EmailTemplates extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return EmailTemplates the static model class
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
		return '{{email_templates}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('templates_name,type,templates_title,templates_content','required','message'=>'{attribute}不能为空'),
			array('templates_name', 'length', 'max'=>30),
			array('create_id, create_time', 'length', 'max'=>11),
			array('type','length','max'=>'1'),
			array('templates_name,templates_content','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,type, templates_name,templates_title,templates_content, create_id, create_time', 'safe', 'on'=>'search'),
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
			'User'=>array(self::BELONGS_TO,'User','create_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type'=>'模板类型',
			'templates_name' => '模版名称',
			'templates_content' => '模版内容',
			'templates_title' => '模版主题',
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
		$criteria->compare('templates_name',$this->templates_name,true);
		$criteria->compare('templates_content',$this->templates_content,true);
		$criteria->compare('templates_title',$this->templates_title,true);
		$criteria->compare('create_id',$this->create_id,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider(get_class($this), array(
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
				$this->create_time=Util::current_time('timestamp');
			}else{
				//$this->create_id=Yii::app()->user->id;
				//$this->create_time=Util::current_time('timestamp');
			}
			return true;
		}else{
			return false;
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
	
	function format_create_time(){
		return date("Y-m-d H:i:s",$this->create_time);
	}
	
	
		function show_attribute($attribute_name){
		switch($attribute_name){
			
			case 'type':
				 return CV::$template_type[$this->type];
				break;
				
				
      case 'create_id':
				 return Yii::app()->User->user_login;
				break;
				
			case 'create_time':
				 return date('Y-m-d H:i:s',$this->create_time);
				break;
			default:
			  return $this->$attribute_name;
			  break;
		}
	}
	
	

}