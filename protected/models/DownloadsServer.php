<?php

/**
 * This is the model class for table "{{downloads_server}}".
 *
 * The followings are the available columns in table '{{downloads_server}}':
 * @property string $id
 * @property string $downloads_id
 * @property string $server_address
 * @property string $server_name
 * @property string $create_id
 * @property string $create_time
 */
class DownloadsServer extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DownloadsServer the static model class
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
		return '{{downloads_server}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('downloads_id,server_address,server_name', 'required','message'=>'{attribute}不能为空'),
			array('server_address, server_name', 'length', 'max'=>100),
			array('downloads_id,create_id, create_time', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, server_address, server_name, create_id, create_time', 'safe', 'on'=>'search'),
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
			'Downloads'=>array(self::BELONGS_TO,'Downloads','downloads_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'downloads_id'=>'软件名称',
			'server_address' => '服务器地址',
			'server_name' => '服务器名称',
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
		$criteria->compare('downloads_id',$this->downloads_id,true);
		$criteria->compare('server_address',$this->server_address,true);
		$criteria->compare('server_name',$this->server_name,true);
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
	 	case 'downloads_id':
	 		return $this->Downloads->title;
	 		break;
	    case 'create_id':
	    	return $this->User->user_login;
	    	break;
	    case 'create_time':
	    	return date("Y-m-d",$this->create_time);
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
}