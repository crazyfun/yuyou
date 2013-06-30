<?php

/**
 * This is the model class for table "{{search_keywords}}".
 *
 * The followings are the available columns in table '{{search_keywords}}':
 * @property string $id
 * @property string $keywords
 * @property string $counts
 * @property string $search_time
 */
class SearchKeywords extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SearchKeywords the static model class
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
		return '{{search_keywords}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('keywords','message'=>'{attribute}不能为空'),
			array('keywords', 'length', 'max'=>30),
			array('counts, search_time', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, keywords, counts, search_time', 'safe', 'on'=>'search'),
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
			'keywords' => '关键字',
			'counts' => '搜索次数',
			'search_time' => '搜索时间',
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
		$criteria->compare('keywords',$this->keywords,true);
		$criteria->compare('counts',$this->counts,true);
		$criteria->compare('search_time',$this->search_time,true);

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
	 	case 'search_time':
	 	  return date('Y-m-d',$this->search_time);
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
		  if(Util::is_permission($user_permission_name,"delete"))
		     $return_str.=CHtml::link('删除','javascript:void(0);',array('id'=>'delete_'.$this->id,'class'=>'operate_red','onclick'=>"javascript:ajax_delete('".Yii::app()->getController()->createUrl('main/delete')."','".get_class($this)."','".$this->id."');"));
		   $return_str.="</div>";
		  return $return_str;
	}
	
		//插入搜索的关键字
	function insert_keywords($keywords){
		$keywords_data=$this->find("keywords=:keywords",array(":keywords"=>$keywords));
		if(empty($keywords_data)){
			$this->id=null;
			$this->setIsNewRecord(true);
			$this->keywords=$keywords;
			$this->counts='1';
			$this->search_time=time();
			$this->insert_datas();
		}else{
			$keywords_data->counts=$keywords_data->counts+1;
			$keywords_data->search_time=time();
			$keywords_data->save();
		}
	}
}