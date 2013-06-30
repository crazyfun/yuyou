<?php

/**
 * This is the model class for table "{{hotels_beds}}".
 *
 * The followings are the available columns in table '{{hotels_beds}}':
 * @property string $id
 * @property string $hotels_id
 * @property string $price
 * @property string $o_price
 * @property integer $line
 * @property integer $bed
 */
class HotelsBeds extends BaseActive
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HotelsBeds the static model class
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
		return '{{hotels_beds}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hotels_id,name', 'required','message'=>'{attribute}不能为空'),
			array('hotels_id', 'length', 'max'=>11),
			array('name','length','max'=>'100'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, hotels_id,name', 'safe', 'on'=>'search'),
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
			'HotelsPrice'=>array(self::HAS_MANY,'HotelsPrice','bed_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'hotels_id' => '酒店',
			'name'=>'房型名称',
			
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
		$criteria->compare('hotels_id',$this->hotels_id,true);
		$criteria->compare('name',$this->name,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
		
	}
		public function delete_table_datas($pk_id="",$condition=array()){
	$table_datas=$this->get_table_datas($pk_id,$condition);
	if(is_array($table_datas)){
		foreach($table_datas as $key => $value){
			$id=$value->id;
			$this->delete_relation($id);
			$this->deleteByPk($id,"",array());
		}
	 }else{
	 	  $id=$table_datas->id;
	 	  $this->delete_relation($id);
			$this->deleteByPk($id,"",array());
	 }
	 return true;
	}
	
	public function delete_relation($id){
		$condition=array('condition'=>"bed_id=:bed_id",'params'=>array(':bed_id'=>$id));
		$hotels_price=HotelsPrice::model();
		$hotels_price->delete_table_datas("",$condition);
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
	    case 'hotels_id':
	    	return $this->Hotels->title;
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
	
	
			//获得线路的出发时间
	function show_hotels_price($hotels_bed_id=""){
		 $hotels_bed_id=empty($hotels_bed_id)?$this->id:$hotels_bed_id;
		 $hotels_price=HotelsPrice::model();
		 $hotels_price_number=$hotels_price->count("t.bed_id=:bed_id",array(':bed_id'=>$hotels_bed_id));
		 $return_array=CHtml::link("房型价格(".$hotels_price_number.")",'javascript:void(0);',array('class'=>'operate_green','onclick'=>"javascript:frame_hotels_bed('".Yii::app()->getController()->createUrl('hotelsprice/index')."','房型价格','".$hotels_bed_id."');"));
		 return $return_array; 
	}
	
	//根据入住时间和退房时间计算房型和价钱
	function get_all_beds($hotels_id){
		$hotel_beds_datas=$this->with("HotelsPrice")->findAll(array('condition'=>'t.hotels_id=:hotels_id','params'=>array(':hotels_id'=>$hotels_id)));
		return $hotel_beds_datas;
	}
	
	
}