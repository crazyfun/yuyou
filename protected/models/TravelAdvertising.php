<?php

/**
 * This is the model class for table "{{travel_advertising}}".
 *
 * The followings are the available columns in table '{{travel_advertising}}':
 * @property string $id
 * @property string $region_ids
 * @property integer $type
 * @property string $title
 * @property string $content
 */
class TravelAdvertising extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TravelAdvertising the static model class
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
		return '{{travel_advertising}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, region_ids,content', 'required','message'=>'{attribute}不能为空'),
			array('type', 'numerical', 'integerOnly'=>true),
			array('region_ids, title', 'length', 'max'=>100),
			array('position','length','max'=>'11'),
			array('content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, region_ids, type, title, content', 'safe', 'on'=>'search'),
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
			'position'=>'广告位置',
			'region_ids' => '出发地',
			'type' => '广告类型',
			'title' => '标题',
			'content' => '内容',
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
		$criteria->compare('position',$this->position,true);
		$criteria->compare('region_ids',$this->region_ids,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);

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
	 	 case 'position':
	 	     $position=$this->get_travel_postion();
	 	     return $position[$this->position];
	 	     break;
	 	 case 'region_ids':
	 			$region=Region::model();
	 	    $region_ids=$this->region_ids;
	 	    $region_datas=$region->findAll(array('select'=>'region_name','condition'=>"t.region_id ".Util::db_create_in($region_ids),'params'=>array()));
	 	    $region_name=array();
	 	    foreach($region_datas as $key => $value){
	 	      	$region_name[]=$value->region_name;
	 	    }
	 	    return implode(",",$region_name);
	 	    break;
	 		break;
   		  case 'type':
      		$advertising_type=CV::$advertising_type;
      		return $advertising_type[$this->type];
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
	
	  /*
	 获取线路的广告位置的下拉列表

	*/
	 function get_travel_postion(){
		$position=CV::$travel_advertisiong_position;
		$result=array();
		foreach($position as $key => $value){
			$result[$key]=$value['name']."(宽:".$value['width'].",高:".$value['height'].")";
		}
		return $result;
	}
}