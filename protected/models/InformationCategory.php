<?php

/**
 * This is the model class for table "{{information_category}}".
 *
 * The followings are the available columns in table '{{information_category}}':
 * @property string $id
 * @property integer $model_type
 * @property string $parent_id
 * @property string $name
 * @property string $sort
 * @property string $create_id
 * @property string $create_time
 */
class InformationCategory extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return InformationCategory the static model class
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
		return '{{information_category}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('model_type,name', 'required','message'=>'{attribute}不能为空'),
			array('model_type', 'numerical', 'integerOnly'=>true),
			array('parent_id, create_id, create_time', 'length', 'max'=>11),
			array('name', 'length', 'max'=>30),
			array('sort','length','max'=>'4'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, model_type, parent_id, name, create_id, create_time', 'safe', 'on'=>'search'),
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
			'Parent'=>array(self::BELONGS_TO,'InformationCategory','parent_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'model_type' => '类型',
			'parent_id' => '父类',
			'name' => '名称',
			'sort'=>'排序',
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
		$criteria->compare('model_type',$this->model_type);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('create_id',$this->create_id,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
		//删除一笔数据
	public function delete_table_datas($pk_id="",$condition=array()){
		$table_datas=$this->get_table_datas($pk_id,$condition);
		$information=new Information();
		if(is_array($table_datas)){
		foreach($table_datas as $key => $value){
			$id=$value->id;
			$information_datas=$information->findAll(array('select'=>'id','condition'=>'type_id=:type_id','params'=>array(':type_id'=>$id)));
      foreach($information_datas as $key1 => $value1){
    	  $information_id=$value1->id;
    	  $information->delete_table_datas($information_id,array());
      }
      $child_datas=$this->findAll(array('select'=>'id','condition'=>'parent_id=:parent_id','params'=>array(':parent_id'=>$id)));
      foreach($child_datas as $key1 => $value1){
    	  $child_id=$value1->id;
    	  $this->delete_table_datas($child_id,array());
      }
			$this->deleteByPk($id,"",array());
		}
	 }else{
	 	  $id=$table_datas->id;
		  $information_datas=$information->findAll(array('select'=>'id','condition'=>'type_id=:type_id','params'=>array(':type_id'=>$id)));
      foreach($information_datas as $key1 => $value1){
    	  $information_id=$value1->id;
    	  $information->delete_table_datas($information_id,array());
      }
      $child_datas=$this->findAll(array('select'=>'id','condition'=>'parent_id=:parent_id','params'=>array(':parent_id'=>$id)));
      foreach($child_datas as $key1 => $value1){
    	  $child_id=$value1->id;
    	  $this->delete_table_datas($child_id,array());
      }
			$this->deleteByPk($id,"",array());
	 }
	 return true;
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
				$this->create_time=Util::current_time('timestamp');
			}else{
				
			}
			return true;
		}else{
			return false;
		}
	}
	
	function show_attribute($attribute_id){
	 switch($attribute_id){
	 	case 'parent_id':
	 		return $this->Parent->name;
	 		break;
		case 'user_id':
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
		  if(Util::is_permission($user_permission_name,"delete"))
		     $return_str.=CHtml::link('删除','javascript:void(0);',array('id'=>'delete_'.$this->id,'class'=>'operate_red','onclick'=>"javascript:ajax_delete('".Yii::app()->getController()->createUrl('main/delete')."','".get_class($this)."','".$this->id."');"));
		  $return_str.="</div>";
		  return $return_str;
	}
	
	function get_parent_select($model_type,$parent_id=0,$level=0){
	  $category_select=array();
		$child_datas=$this->get_childs($model_type,$parent_id);
		$level++;
		foreach($child_datas as $key => $value){
		  $name="";
		  for($ii=1;$ii<$level;$ii++){
		  	$name.="─";
		  }
		  $name.=$value->name;	
		  $category_select[$value->id]=$name;
		  $tem_child_datas=$this->get_parent_select($model_type,$value->id,$level);
		  if(!empty($tem_child_datas)){
		  	$category_select=$category_select+$tem_child_datas;
		  }
		}
		return $category_select;
	}
	
	function get_categorys($model_type,$parent_id=""){
		$conditions=array();
		$params=array();
		if(!empty($parent_id)){
			$conditions[]="parent_id=:parent_id";
			$params[':parent_id']=$parent_id;
		}
		$conditions[]='model_type=:model_type';
		$params[':model_type']=$model_type;
		 $category_datas=$this->findAll(array('condition'=>implode(" AND ",$conditions),'params'=>$params,'order'=>'sort ASC'));
		 return $category_datas;
	}
	
	function get_childs($model_type,$parent_id,$ids=""){
		$conditions=array();
		$params=array();
		if(!empty($ids)){
			if(strlen($parent_id)){
				$conditions[]=" t.parent_id=:parent_id ";
			  $params[':parent_id']=$parent_id;
			}
			$conditions[]="FIND_IN_SET(t.id,'".$ids."')>0 ";
			$conditions[]="t.model_type=:model_type";
			$params[':model_type']=$model_type;
		}else{
			$conditions[]=" t.parent_id=:parent_id";
			$params[':parent_id']=$parent_id;
			$conditions[]="t.model_type=:model_type";
			$params[':model_type']=$model_type;
	  }
		$child_datas=$this->findAll(array('condition'=>implode(" AND ",$conditions),'params'=>$params,'order'=>'t.sort ASC'));
		return $child_datas;
	}
	
	
	function get_first_category($model_type){
		$conditions=array();
		$params=array();
    $conditions[]='model_type=:model_type';
		$params[':model_type']=$model_type;
		$category_datas=$this->find(array('condition'=>implode(" AND ",$conditions),'params'=>$params,'order'=>'sort ASC','limit'=>'1'));
		return $category_datas;
	}
	
	
}