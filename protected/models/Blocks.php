<?php

/**
 * This is the model class for table "{{blocks}}".
 *
 * The followings are the available columns in table '{{blocks}}':
 * @property string $id
 * @property string $name
 * @property integer $view
 * @property string $tlen
 * @property string $dlen
 * @property string $size
 * @property string $attr
 * @property string $channel
 * @property string $category
 * @property integer $sort
 * @property string $cache
 */
class Blocks extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Blocks the static model class
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
		return '{{blocks}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pattern,name,identification', 'required','message'=>'{attribute}不能为空'),
			array('identification','exists_identification'),
			array('pattern,attr,name,sort_type,identification', 'length', 'max'=>30),
			array('dott','length','max'=>'2'),
			array('view,sort,tlen, dlen,channel, category,limit,cache', 'length', 'max'=>11),
			array('size,archive_ids', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,pattern, name, identification,view, tlen,dott,dlen, size,archive_ids, attr, channel, category, sort,sort_type,limit,cache', 'safe', 'on'=>'search'),
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
			'pattern'=>'模型',
			'name' => '模块名称',
			'identification'=>'模块标志',
			'view' => '视图文件',
			'tlen' => '标题长度',
			'dott'=>'显示...',
			'dlen' => '内容长度',
			'size' => '图片尺寸',
			'archive_ids'=>'指定文档',
			'attr' => '文档属性',
			'channel' => '文档栏目',
			'category' => '文档分类',
			'sort' => '文档排序',
			'sort_type'=>'排序规则',
			'limit'=>'显示数量',
			'cache' => '缓存时间',
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
		$criteria->compare('pattern',$this->pattern,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('identification',$this->identification,true);
		$criteria->compare('view',$this->view);
		$criteria->compare('tlen',$this->tlen,true);
		$criteria->compare('dott',$this->dott,true);
		$criteria->compare('dlen',$this->dlen,true);
		$criteria->compare('size',$this->size,true);
		$criteria->compare('archive_ids',$this->archive_ids,true);
		$criteria->compare('attr',$this->attr,true);
		$criteria->compare('channel',$this->channel,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('sort',$this->sort,true);
		$criteria->compare('sort_type',$this->sort_type,true);
		$criteria->compare('limit',$this->limit,true);
		$criteria->compare('cache',$this->cache,true);
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
	 	case 'pattern':
	 	  $pattern=CV::$pattern;
	    return $pattern[$this->pattern];
	 	  break;
	  case 'channel':
	    $channels=Channels::model();
	    $channels_data=$channels->findByPk($this->channel);
	    return $channels_data->name;
	    break;
	  case 'dott':
	    $block_dott=CV::$block_dott;
	    return $block_dott[$this->dott];
	    break;
	  case 'attr':
	    $config_values=ConfigValues::model();
      $attr=$config_values->get_select_values('1');
	    return $attr[$this->attr];
	    break;
	  case 'category':
	    $channel_category=ChannelCategory::model();
	    $channel_category_data=$channel_category->findByPk($this->category);
	    return $channel_category_data->name;
	    break;
	  case 'view':
	     $config_values=ConfigValues::model();
       $block_view=$config_values->get_ralation_values('2');
	    return $block_view[$this->view];
	    break;
	  case 'sort':
	     $config_values=ConfigValues::model();
	     $sort_select=$config_values->get_ralation_values('4');
	    return $sort_select[$this->sort];
	    break;
	  case 'sort_type':
	    $sort_type=CV::$block_sort_type;
	    return $sort_type[$this->sort_type];
	    break;

	  case 'archive_ids':
	    return $this->archive_ids;
	    break;
		default:
		  return $this->$attribute_id;
			break;
	 }
	}
	
	function exists_identification(){
		$id=$this->id;
		if(!empty($id)){
			 $get_table_datas=$this->get_table_datas($id,array());
			 if($get_table_datas->identification!=$this->identification){
			 	 $find_datas=$this->find(array(
          'select'=>'identification',
          'condition'=>'identification=:identification',
          'params'=>array(':identification' => $this->identification),
         ));
			 }
		}else{
			$find_datas=$this->find(array(
         'select'=>'identification',
         'condition'=>'identification=:identification',
         'params'=>array(':identification' => $this->identification),
       ));
		}
     if(!empty($find_datas)){
     	 $this->addError("identification","模块标识已存在");
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
}