<?php

/**
 * This is the model class for table "{{images}}".
 *
 * The followings are the available columns in table '{{images}}':
 * @property string $id
 * @property integer $category_id
 * @property string $name
 * @property string $src
 * @property string $desc
 * @property string $create_id
 * @property string $create_time
 */
class Images extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Images the static model class
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
		return '{{images}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,category_id','required','message'=>'{attribute}不能为空'),
			array('category_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>30),
			array('src', 'length', 'max'=>100),
			array('create_id, create_time', 'length', 'max'=>11),
			array('desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category_id, name, src, desc, create_id, create_time', 'safe', 'on'=>'search'),
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
			'ImagesCategory'=>array(self::BELONGS_TO, 'ImagesCategory', 'category_id'),
			'User'=>array(self::BELONGS_TO, 'User', 'create_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category_id' => '分类ID',
			'name' => '图片名称',
			'src' => '图片链接',
			'desc' => '图片描述',
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
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('src',$this->src,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('create_id',$this->create_id,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
		 //删除一笔数据
	public function delete_table_datas($pk_id="",$condition=array()){
	  	if(!empty($pk_id)){
	  		$images_datas=$this->findByPk($pk_id);
	  		$images_src=$images_datas->src;
	  		Util::deleteFile($images_src);
			$datas=$this->deleteByPk($pk_id);
		}else{
			$images_datas=$this->findAll($condition);
			foreach((array)$images_datas as $key => $value){
				$images_src=$value->src;
				Util::deleteFile($images_src);
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
	 	case 'category_id':
	 		return $this->ImagesCategory->name;
	 		break;
	    case 'src':
	    	return CHtml::image("/".$this->src,$this->name,array('width'=>'80','height'=>'80'));
	    	break;
	    case 'create_id':
	    	return $this->User->user_login;
	        break;
	    case 'create_time':
	    	return date("Y-m-d H:i:s",$this->create_time);
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
		  $return_str.="|";
		  if(Util::is_permission($user_permission_name,"delete"))
		     $return_str.=CHtml::link('删除',array($controller_id."/delete","id"=>$this->id),array('class'=>'operate_red'));
		   $return_str.="</div>";
		  return $return_str;
	}
}