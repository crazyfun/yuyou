<?php

/**
 * This is the model class for table "{{travel_favorite}}".
 *
 * The followings are the available columns in table '{{travel_favorite}}':
 * @property string $id
 * @property string $user_id
 * @property string $travel_id
 */
class HotelsFavorite extends BaseActive{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TravelFavorite the static model class
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
		return '{{hotels_favorite}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id,hotels_id','required','message'=>'{attribute}不能为空'),
			array('user_id, hotels_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, hotels_id', 'safe', 'on'=>'search'),
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
			  'Hotels'=>array(self::BELONGS_TO,'Hotels','hotels_id'),
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
			'user_id' => '用户ID',
			'hotels_id' => '酒店名称',
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
		$criteria->compare('hotels_id',$this->hotels_id,true);
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
				$this->user_id=Yii::app()->user->id;
			}else{
			
			}
			return true;
		}else{
			return false;
		}
	}
	
	function show_attribute($attribute_name){
		switch($attribute_name){
			case 'user_id':
			  return $this->User->user_login;
              break;
            case 'hotels_id':
			  return $this->Hotels->title;
              break;
			default:
			  return $this->$attribute_name;
			  break;
		}
	}
	function show_hotels($hotels_id=""){
		$hotels_id=empty($hotels_id)?$this->hotels_id:$hotels_id;
		$hotels=Hotels::model();
		$hotels_data=$hotels->findByPk($hotels_id);
		return "<a href='".Yii::app()->getController()->createUrl("hotels/show",array('id'=>$hotels_data->id))."' target='_blank'>".$hotels_data->title."</a>";
		
		
	}
	function get_web_operate(){
		  $return_str="<div class='operate_button'>";
      $return_str.=CHtml::link('删除',array("user/deletehotelsfavorite",'id'=>$this->id),array('class'=>'operate_red'));
		  $return_str.="</div>";
		  return $return_str;
  }
 }
       