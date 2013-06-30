<?php

/**
 * This is the model class for table "{{service_support}}".
 *
 * The followings are the available columns in table '{{service_support}}':
 * @property string $id
 * @property string $type
 * @property string $title
 * @property integer $status
 * @property string $create_id
 * @property string $create_time
 */
class ServiceSupport extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ServiceSupport the static model class
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
		return '{{service_support}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('title,create_id,status','required','message'=>'{attribute}不能为空'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('type, create_id, create_time', 'length', 'max'=>11),
			array('title', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, title, status, create_id, create_time', 'safe', 'on'=>'search'),
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
		  'ConfigValues'=>array(self::BELONGS_TO,'ConfigValues','type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => '类型',
			'title' => '标题',
			'status' => '回复状态',
			'create_id' => '提交人',
			'create_time' => '提交时间',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_id',$this->create_id,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
		//删除一笔数据
	public function delete_table_datas($pk_id="",$condition=array()){
		$table_datas=$this->get_table_datas($pk_id,$condition);
		$support_content=new SupportContent();
		if(is_array($table_datas)){
		foreach($table_datas as $key => $value){
			$id=$value->id;
			$support_content_datas=$support_content->findAll(array('select'=>'id','condition'=>'t.relation_id=:relation_id','params'=>array(':relation_id'=>$id)));
      foreach($support_content_datas as $key1 => $value1){
    	  $content_id=$value1->id;
    	  $support_content->delete_table_datas($content_id,array());
      }
			$this->deleteByPk($id,"",array());
		}
	 }else{
	 	  $id=$table_datas->id;
			$support_content_datas=$support_content->findAll(array('select'=>'id','condition'=>'t.relation_id=:relation_id','params'=>array(':relation_id'=>$id)));
      foreach($support_content_datas as $key1 => $value1){
    	  $content_id=$value1->id;
    	  $support_content->delete_table_datas($content_id,array());
      }
			$this->deleteByPk($id,"",array());
	 }
	 return true;
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
			   $this->create_id=Yii::app()->user->id;
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
			case 'type':
				 return $this->ConfigValues->name;
				break;
			case 'status':
			  $support_status=CV::$support_status;
			  return $support_status[$this->status];
			  break;
		   case 'create_id':
				 return $this->User->user_login;
				break;
			case 'create_time':
				 return date("Y-m-d H:i:s",$this->create_time);
				break;
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
		  if(Util::is_permission($user_permission_name,"view"))
		  	$return_str.=CHtml::link('查看',array($controller_id."/view","id"=>$this->id),array('class'=>'operate_green'));
		  if(Util::is_permission($user_permission_name,"status")){
		  	if($this->status=='1'){
		  	   $return_str.=CHtml::link('解决中',array($controller_id."/status","id"=>$this->id,'status'=>'2'),array('class'=>'operate_green'));
		    }
		    
		    if($this->status=='2'){
		  	   $return_str.=CHtml::link('已回复',array($controller_id."/status","id"=>$this->id,'status'=>'3'),array('class'=>'operate_green'));
		    }
		    if($this->status=='3'){
		  	   $return_str.=CHtml::link('已解决',array($controller_id."/status","id"=>$this->id,'status'=>'4'),array('class'=>'operate_green'));
		    }
		  }
		  if(Util::is_permission($user_permission_name,"delete")) 	
		   	$return_str.=CHtml::link('删除','javascript:void(0);',array('id'=>'delete_'.$this->id,'class'=>'operate_red','onclick'=>"javascript:ajax_delete('".Yii::app()->getController()->createUrl('main/delete')."','".get_class($this)."','".$this->id."');"));
		  $return_str.="</div>";
		  return $return_str;
	}
	
	function get_web_operate(){
		  $return_str="<div class='operate_button'>";
		  $return_str.=CHtml::link('查看',array("user/supportview","id"=>$this->id),array('class'=>'operate_green'));
		  $return_str.="</div>";
		  return $return_str;
	}
}