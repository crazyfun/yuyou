<?php

/**
 * This is the model class for table "{{downloads_flash_ad}}".
 *
 * The followings are the available columns in table '{{downloads_flash_ad}}':
 * @property string $id
 * @property string $flash_img
 * @property string $describe
 * @property integer $sort
 */
class DownloadsFlashAd extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return FlashAd the static model class
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
		return '{{downloads_flash_ad}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('flash_img,img_href,sort', 'required','message'=>'{attribute}不能为空'),
			array('sort', 'required'),
			array('title','length','max'=>'30'),
			array('sort', 'numerical', 'integerOnly'=>true),
			array('flash_img,img_href', 'length', 'max'=>100),
			array('describe', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,title,flash_img, img_href,describe, sort', 'safe', 'on'=>'search'),
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
			'title'=>'图片名称',
			'flash_img' => '图片',
			'img_href'=>'图片连接',
			'describe' => '描述',
			'sort' => '排序',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('flash_img',$this->flash_img,true);
		$criteria->compare('img_href',$this->img_href,true);
		$criteria->compare('describe',$this->describe,true);
		$criteria->compare('sort',$this->sort);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
			 //删除一笔数据
	public function delete_table_datas($pk_id="",$condition=array()){
	  	if(!empty($pk_id)){
	  		$flash_datas=$this->findByPk($pk_id);
	  		$flash_src=$flash_datas->flash_img;
	  		Util::deleteFile($flash_src);
			 $datas=$this->deleteByPk($pk_id);
		}else{
			$flash_datas=$this->findAll($condition);
			foreach((array)$flash_datas as $key => $value){
				$flash_src=$value->flash_img;
				Util::deleteFile($flash_src);
				$this->deleteByPk($value->id);
			}
			$datas=true;
		}
		return $datas;
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
	    case 'flash_img':
	    	return CHtml::image("/".$this->flash_img,$this->describe,array());
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
	function get_content(){
	  $contents=$this->findAll(array('condition'=>"",'params'=>array(),'order'=>'sort ASC'));
		$return_contents=array();
		foreach($contents as $key => $value){
			$value->flash_img="/".$value->flash_img;
			$return_contents[]=$value->attributes;
		}
		return $return_contents;
	}
	
}