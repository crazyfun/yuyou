<?php

/**
 * This is the model class for table "{{coupon_resume}}".
 *
 * The followings are the available columns in table '{{coupon_resume}}':
 * @property string $id
 * @property string $user_id
 * @property integer $type
 * @property string $value
 * @property string $comment
 * @property string $create_time
 */
class CouponResume extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CouponResume the static model class
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
		return '{{coupon_resume}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id,type,value,remain','required','message'=>'{attribute}不能为空'),
			array('type', 'numerical', 'integerOnly'=>true),
			array('user_id, value,remain, create_id,create_time', 'length', 'max'=>11),
			array('comment', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, type, value,remain, comment, create_id,create_time', 'safe', 'on'=>'search'),
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
			'User'=>array(self::BELONGS_TO, 'User', 'user_id'),
			'OperateUser'=>array(self::BELONGS_TO,'User','create_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => '用户ID',
			'type' => '类型',
			'value' => '值',
			'remain'=>'剩余',
			'comment' => '描述',
			'create_id'=>'操作人',
			'create_time' => '消费时间',
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
		$criteria->compare('type',$this->type);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('remain',$this->remain,true);
		$criteria->compare('comment',$this->comment,true);
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
	
	function beforeSave(){
	  if(parent::beforeSave()){
			if($this->isNewRecord){
				$this->create_time=Util::current_time('timestamp');
				//$this->create_id=Yii::app()->user->id;
			}else{
				
				//$this->create_id=Yii::app()->user->id;
				//$this->create_time=Util::current_time('timestamp');
			}
			return true;
		}else{
			return false;
		}
	}
	
	
	function show_attribute($attribute_name){
		switch($attribute_name){
		
		   case 'type':
		        return CV::$consume_type[$this->type];
		    	break;
		    	
		  case 'value':
		       if($this->type=='1'){
		         return "+".$this->value;	
		       }else{
		       	return "-".$this->value;	
		       }
		        
		    	break;  	
		  case 'user_id':
		        return $this->User->user_login;
		    	break;
		  case 'create_id':
		        return $this->OperateUser->user_login;
		    	break;
			case 'create_time':
				 return date('Y-m-d H:i:s',$this->create_time);
				break;
			default:
			  return $this->$attribute_name;
			  break;
		}
	}
	
	function consume($user_id,$type,$value,$comment){
		
		$user=User::model();
		$user_data=$user->findByPk($user_id);
		switch($type){
			case '1':
			  $user_data->conpon=$user_data->conpon+$value;
			  $result=$user_data->insert_datas();
			  if($result){
			  	$this->user_id=$user_id;
			  	$this->type=$type;
			  	$this->value=$value;
			  	$this->remain=$user_data->conpon;
			  	$this->comment=$comment;
			  	$this->insert_datas();
			  }
			  break;
			case '2':
			  $user_data->conpon=$user_data->conpon-$value;
			  $result=$user_data->insert_datas();
			  
			  if($result){
			  	$this->user_id=$user_id;
			  	$this->type=$type;
			  	$this->value=$value;
			  	$this->remain=$user_data->conpon;
			  	$this->comment=$comment;
			  	$this->insert_datas();
			  }
			  break;
			default:
			  break;
		}
	}
}