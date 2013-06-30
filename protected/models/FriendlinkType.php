<?php

/**
 * This is the model class for table "{{friendlink_type}}".
 *
 * The followings are the available columns in table '{{friendlink_type}}':
 * @property string $id
 * @property string $type_name
 * @property string $create_id
 * @property string $create_time
 */
class FriendlinkType extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return FriendlinkType the static model class
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
		return '{{friendlink_type}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type_name', 'required','message'=>'{attribute}不能为空'),
			array('type_name', 'length', 'max'=>30),
			array('create_id, create_time', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type_name, create_id, create_time', 'safe', 'on'=>'search'),
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
			'type_name' => '类型名称',
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
		$criteria->compare('type_name',$this->type_name,true);
		$criteria->compare('create_id',$this->create_id,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	//删除一笔数据
	public function delete_table_datas($pk_id="",$condition=array()){
		$table_datas=$this->get_table_datas($pk_id,$condition);
		$friend_link=new Friendlink();
		if(is_array($table_datas)){
		foreach($table_datas as $key => $value){
			$id=$value->id;
			$friend_link_datas=$friend_link->findAll(array('select'=>'id','condition'=>'friendlink_type=:friendlink_type','params'=>array(':friendlink_type'=>$id)));
      foreach($friend_link_datas as $key1 => $value1){
    	  $friend_link_id=$value1->id;
    	  $friend_link->delete_table_datas($friend_link_id,array());
      }
			$this->deleteByPk($id,"",array());
		}
	 }else{
	 	  $id=$table_datas->id;
		  $friend_link_datas=$friend_link->findAll(array('select'=>'id','condition'=>'friendlink_type=:friendlink_type','params'=>array(':friendlink_type'=>$id)));
      foreach($friend_link_datas as $key1 => $value1){
    	  $friend_link_id=$value1->id;
    	  $friend_link->delete_table_datas($friend_link_id,array());
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
	public function beforeSave(){
	  if(parent::beforeSave()){
			if($this->isNewRecord){
				$this->create_id=Yii::app()->user->id;
				$this->create_time=Util::current_time('timestamp');
			}else{
				$this->create_id=Yii::app()->user->id;
				$this->create_time=Util::current_time('timestamp');
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
	
	
	
}