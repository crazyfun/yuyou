<?php

/**
 * This is the model class for table "{{travel_category}}".
 *
 * The followings are the available columns in table '{{travel_category}}':
 * @property string $category_id
 * @property string $category_name
 * @property string $parent_id
 * @property integer $sort_order
 */
class HotelsBrand extends BaseActive
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TravelCategory the static model class
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
		return '{{hotels_brand}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			 array('brand_name','required','message'=>'{attribute}不能为空'),
			array('sort_order', 'numerical', 'integerOnly'=>true),
			array('brand_name', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, brand_name, sort_order', 'safe', 'on'=>'search'),
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
			'brand_name' => '品牌名称',
			'sort_order' => '排序',
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

		$criteria->compare('id',$this->category_id,true);
		$criteria->compare('brand_name',$this->category_name,true);
		$criteria->compare('sort_order',$this->sort_order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
				//删除一笔数据
	public function delete_table_datas($pk_id="",$condition=array()){
		$table_datas=$this->get_table_datas($pk_id,$condition);
	  if(is_array($table_datas)){
	  	foreach($table_datas as $key => $value){
	  		$this->deleteByPk($value->id);	
	  	}
	  }else{
	  	 $this->deleteByPk($table_datas->id);
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
		  if(Util::is_permission($user_permission_name,"edit"))
		     $return_str.=CHtml::link('修改',array($controller_id."/edit","id"=>$this->id),array('class'=>'operate_green'));
		  if(Util::is_permission($user_permission_name,"delete"))
		     $return_str.=CHtml::link('删除','javascript:void(0);',array('id'=>'delete_'.$this->id,'class'=>'operate_red','onclick'=>"javascript:ajax_delete('".Yii::app()->getController()->createUrl('main/delete')."','".get_class($this)."','".$this->id."');"));
		   $return_str.="</div>";
		  return $return_str;
	}

   //获取选择区域的选择项
    function get_options_brands(){
         $brand_datas=$this->findAll(array('select'=>'id,brand_name','condition'=>"",'params'=>array(),'order'=>'sort_order ASC'));
         $return_array=array();
         foreach($brand_datas as $key => $value){
         	 $return_array[$value->id]=$value->brand_name;
         }
         return $return_array;
    }  

  //获取酒店品牌的搜索项
	function get_search_options_brands(){
         $brand_datas=$this->findAll(array('select'=>'id,brand_name','condition'=>"",'params'=>array(),'order'=>'sort_order ASC'));
         $return_array=array();
         foreach($brand_datas as $key => $value){
         	 $tem_array=array();
         	 $tem_array['id']=$value->id;
         	 $tem_array['name']=$value->brand_name;
         	 $return_array[]=$tem_array;
         }
         return $return_array;
    }  


  

}