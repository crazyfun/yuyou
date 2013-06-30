<?php

/**
 * This is the model class for table "{{comments}}".
 *
 * The followings are the available columns in table '{{comments}}':
 * @property string $id
 * @property string $model_id
 * @property string $parent_id
 * @property string $relation_id
 * @property string $comment
 * @property string $create_id
 * @property string $create_time
 */
class Comments extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Comments the static model class
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
		return '{{comments}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('model_id,relation_id,comment','required','message'=>'{attribute}不能为空'),
			array('parent_id, relation_id, create_id, create_time', 'length', 'max'=>11),
			array('comment', 'safe'),
			array('model_id', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, model_id, parent_id, relation_id, comment, create_id, create_time', 'safe', 'on'=>'search'),
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
		  'User'=>array(self::BELONGS_TO, 'User', 'create_id'),
		  'Comments'=>array(self::HAS_MANY,'Comments','parent_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'model_id' => '评论类型',
			'parent_id' => '父ID',
			'relation_id' => '关联ID',
			'comment' => '评论内容',
			'create_id' => '评论人',
			'create_time' => '评论时间',
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
		$criteria->compare('model_id',$this->model_id,true);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('relation_id',$this->relation_id,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('create_id',$this->create_id,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider(get_class($this), array(
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
				$this->create_id=Yii::app()->user->id;
				$this->create_time=Util::current_time('timestamp');
			}else{
				$this->create_id=Yii::app()->user->id;
				$this->create_time=Util::current_time('timestamp');
			}
			return true;
		}else{
			return false;
		}
	}

	function format_create_time(){
		return date("Y-m-d H:i:s",$this->create_time);
	}
	/*
	 * 获取评论的层级
	 * @params $comment_id 评论的ID
	 * @return 返回评论的层级
	 * @auther lxf
	 * @version 1.0.0
	 */
	function get_comment_level($comment_id,&$level=1){
		$comment_id=empty($comment_id)?$this->id:$comment_id;
		if(empty($comment_id))
		   return NULL;
		$parent_comment=$this->get_parent_comment($comment_id);
		if(!empty($parent_comment)){
			$level++;
			$level=$this->get_comment_level($parent_comment->id,$level);
		}
		return $level;
	}
	/*
	 * 获取评论的父评论
	 * @params $comment_id 评论的ID
	 * @return 返回评论的父评论
	 * @auther lxf
	 * @version 1.0.0
	 */
	function get_parent_comment($comment_id){
		$comment_id=empty($comment_id)?$this->id:$comment_id;
		if(empty($comment_id))
		   return NULL;
		$self_comment_datas=$this->find(array('select'=>'parent_id','condition'=>'id=:comment_id','params'=>array(':comment_id'=>$comment_id)));
		$parent_id=$self_comment_datas->parent_id;
		if(!empty($parent_id)){
			
			$parent_comment_datas=$this->find(array('select'=>'*','condition'=>'id=:parent_id','params'=>array(':parent_id'=>$parent_id)));
			return $parent_comment_datas;
		}else{
			return NULL;
		}
	}
	/*
	 * 获取评论的子评论
	 * @params $comment_id 评论的ID
	 * @return 返回评论的子评论
	 * @auther lxf
	 * @version 1.0.0
	 */
	function get_child_comment($comment_id){
	  $comment_id=empty($comment_id)?$this->id:$comment_id;
		if(empty($comment_id))
		   return NULL;
		$comment_datas=$this->findAll(array('select'=>'*','condition'=>'parent_id=:comment_id','params'=>array(':comment_id'=>$comment_id)));
		return $comment_datas;
  }
}