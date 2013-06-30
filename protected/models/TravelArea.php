<?php

/**
 * This is the model class for table "{{trave_area}}".
 *
 * The followings are the available columns in table '{{trave_area}}':
 * @property string $id
 * @property string $trave_id
 * @property string $trave_area
 * @property string $create_id
 * @property string $create_time
 */
class TravelArea extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TraveArea the static model class
	 */
	public  $import='';
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{travel_area}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('travel_id,travel_area','required','message'=>'{attribute}不能为空'),
			array('travel_id,create_id, create_time', 'length', 'max'=>11),
			array('travel_area', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, travel_id,travel_area, create_id, create_time', 'safe', 'on'=>'search'),
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
			'Travel'=>array(self::BELONGS_TO,'Travel','travel_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'travel_id' => '线路名称',
			'travel_area' => '景区名称',
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
		$criteria->compare('travel_id',$this->travel_id,true);
		$criteria->compare('travel_area',$this->travel_area,true);
		$criteria->compare('create_id',$this->create_id,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
				//删除一笔数据
public function delete_table_datas($pk_id="",$condition=array()){
	$table_datas=$this->get_table_datas($pk_id,$condition);
	if(is_array($table_datas)){
		foreach($table_datas as $key => $value){
			$id=$value->id;
			$this->delete_relation($value->travel_id,$id);
			$this->deleteByPk($id,"",array());
		}
	 }else{
	 	  $id=$table_datas->id;
	 	  $this->delete_relation($table_datas->travel_id,$id);
			$this->deleteByPk($id,"",array());
	 }
	 return true;
	}
	
	public function delete_relation($travel_id,$id){
		$condition=array('condition'=>"travel_id=:travel_id AND travel_area_id=:travel_area_id",'params'=>array(':travel_id'=>$travel_id,':travel_area_id'=>$id));
		$travel_images=TravelImages::model();
		$travel_images->delete_table_datas("",$condition);
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
	 	case 'travel_id':
	 		return $this->Travel->title;
	 		break;
	  case 'create_id':
	        return $this->User->user_login;
	        break;
	  case 'create_time':
	    	return date('Y-m-d H:i:s',$this->create_time);
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
	
	function get_select($travel_id){
		$travel_area_datas=$this->findAll("t.travel_id=:travel_id",array(':travel_id'=>$travel_id));
		$return_array=array();
		foreach($travel_area_datas as $key => $value){
			$return_array[$value->id]=$value->travel_area;
		}
		return $return_array;
	}
	//获取线路的景点
	function get_travel_areas($channel_id,$region_id="",$limit='10'){
		if(empty($region_id)){
			$ip_convert=IpConvert::get();
		  $region_data=$ip_convert->init_region();
      $region_id=$region_data['id'];			
		}
		$search_condition=array('select'=>'distinct(t.travel_area) as travel_area,COUNT(t.travel_area) as count_travel_area','condition'=>'Travel.channel_id=:channel_id AND Travel.start_region=:start_region AND Travel.status=:status','params'=>array(':channel_id'=>$channel_id,':start_region'=>$region_id,':status'=>'2'),'order'=>'count_travel_area DESC','group'=>'t.travel_area','together'=>true);
		if($limit!=-1){
				$search_condition['limit']=$limit;
	  }
		$area_datas=$this->with("Travel")->findAll($search_condition);
		return $area_datas;
	}
	
	
		//获取线路的景点
	function get_hot_travel_areas($region_id="",$limit='10'){
		if(empty($region_id)){
			$ip_convert=IpConvert::get();
		  $region_data=$ip_convert->init_region();
      $region_id=$region_data['id'];			
		}
		$search_condition=array('select'=>'distinct(t.travel_area) as travel_area,COUNT(t.travel_area) as count_travel_area','condition'=>' Travel.start_region=:start_region AND Travel.status=:status','params'=>array(':start_region'=>$region_id,':status'=>'2'),'order'=>'count_travel_area DESC','group'=>'t.travel_area','together'=>true);
		if($limit!=-1){
				$search_condition['limit']=$limit;
	  }
		$area_datas=$this->with("Travel")->findAll($search_condition);
		return $area_datas;
	}
	
	
		//获取搜索时的线路景点
	function get_seach_travel_areas($limit='10'){
	
		$search_condition=array('select'=>'distinct(t.travel_area) as travel_area,COUNT(t.travel_area) as count_travel_area','condition'=>'Travel.status=:status','params'=>array(':status'=>'2'),'order'=>'count_travel_area DESC','group'=>'t.travel_area','together'=>true);
		if($limit!=-1){
				$search_condition['limit']=$limit;
	  }
		$area_datas=$this->with("Travel")->findAll($search_condition);
		$result_datas=array();
		foreach($area_datas as $key => $value){
				$tem_array=array();
				$tem_array['id']=$value->id;
				$tem_array['name']=$value->travel_area;
				$result_datas[]=$tem_array;
		}
		return $result_datas;
	}
}