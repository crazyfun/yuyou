<?php

/**
 * This is the model class for table "{{information}}".
 *
 * The followings are the available columns in table '{{information}}':
 * @property string $id
 * @property string $model_type
 * @property string $type_id
 * @property string $title
 * @property string $content
 * @property string $sort
 * @property string $views
 * @property string $create_id
 * @property string $create_time
 */
class Information extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Information the static model class
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
		return '{{information}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('model_type,type_id,title,content', 'required','message'=>'{attribute}不能为空'),
			array('model_type, type_id, views, create_id, create_time', 'length', 'max'=>11),
			array('title', 'length', 'max'=>100),
			array('content', 'safe'),
			array('sort','length','max'=>'4'),
			array('information_image','length','max'=>'100'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, model_type, type_id, title, content, views, create_id, create_time', 'safe', 'on'=>'search'),
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
			'Type'=>array(self::BELONGS_TO,'InformationCategory','type_id'),
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
			'type_id' => '分类',
			'title' => '标题',
			'information_image'=>'图片',
			'content' => '内容',
			'sort'=>'排序',
			'views' => '查看数',
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
		$criteria->compare('model_type',$this->model_type,true);
		$criteria->compare('type_id',$this->type_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('views',$this->views,true);
		$criteria->compare('create_id',$this->create_id,true);
		$criteria->compare('create_time',$this->create_time,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	//删除一笔数据
	public function delete_table_datas($pk_id="",$condition=array()){
		if(!empty($pk_id)){
			$model_datas=$this->get_table_datas($pk_id);
			if(!empty($model_datas->information_image)){
				 Util::deleteFile($model_datas->information_image);
			}
			$datas=$this->deleteByPk($pk_id,"",array());
		}else{
			 $model_datas=$this->get_table_datas("",$condition);
			 foreach($model_datas as $key => $value){
			 	if(!empty($value->information_image)){
				 Util::deleteFile($value->information_image);
			   }
			 }
       $datas=$this->deleteAll($condition);
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
	 	case 'type_id':
	 		return $this->Type->name;
	 		break;
		case 'create_id':
			return $this->User->user_login;
			break;
		
	   case 'information_image':
        	return CHtml::image("/".$this->information_image,"",array("width"=>'50','height'=>'50'));
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
	function get_whelp_information($type_id=''){
		$conditions=array();
		$params=array();
		if(!empty($type_id)){
			$condition[]="type_id=:type_id";
			$params[':type_id']=$type_id;
		}
		$condition[]="model_type=:model_type";
	  $params[':model_type']=CV::$model_type['help'];
		$information_datas=$this->findAll(array('condition'=>implode(" AND ",$condition),'params'=>$params,'order'=>'sort ASC'));
		return $information_datas;
	}
	function get_whelp_categorys(){
		$category=InformationCategory::model();
		$category_datas=$category->get_categorys(CV::$model_type['help']);
		$return_array=array();
		foreach($category_datas as $key => $value){
			$tem_array=array();
			$tem_array['id']=$value->id;
			$tem_array['name']=$value->name;
			$tem_array['parent_id']=$value->parent_id;
			$tem_array['sub_items']=array();
			$information_datas=$this->get_whelp_information($value->id);
			foreach($information_datas as $key1 => $value1){
				$tem_information=array();
				$tem_information['id']=$value1->id;
				$tem_information['name']=$value1->title;
				$tem_information['type_id']=$value1->type_id;
				$tem_array['sub_items'][]=$tem_information;
			}
			$return_array[]=$tem_array;
		}
		return $return_array;
	}
	
}