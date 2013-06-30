<?php
/**
 * This is the model class for table "{{backend_menu}}".
 *
 * The followings are the available columns in table '{{backend_menu}}':
 * @property string $id
 * @property string $menu_name
 * @property string $menu_parent
 * @property integer $menu_sort
 * @property string $menu_controller
 * @property string $create_id
 * @property string $create_time
 */
class BackendMenu extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return BackendMenu the static model class
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
		return '{{backend_menu}}';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('menu_name,menu_sort','required','message'=>'{attribute}不能为空'),
			array('menu_sort,is_show', 'numerical', 'integerOnly'=>true),
			array('menu_name,menu_alias', 'length', 'max'=>30),
			array('menu_parent, create_id, create_time', 'length', 'max'=>11),
			array('menu_controller,menu_action', 'length', 'max'=>200),
			array('menu_sort','numerical','message'=>'{attribute}必须是数字'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, menu_name,menu_alias, menu_parent, menu_sort, is_show,menu_controller,menu_action,create_id, create_time', 'safe', 'on'=>'search'),
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
		  'BackendMenu'=>array(self::BELONGS_TO,'BackendMenu','menu_parent'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'menu_name' => '菜单名',
			'menu_parent' => '父菜单',
			'menu_sort' => '菜单排序',
			'menu_controller' => '控制器名称',
			'menu_action'=>"方法名称",
			'is_show'=>'是否显示',
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
		$criteria->compare('menu_name',$this->menu_name,true);
		$criteria->compare('menu_alias',$this->menu_alias,true);
		$criteria->compare('menu_parent',$this->menu_parent,true);
		$criteria->compare('menu_sort',$this->menu_sort);
		$criteria->compare('menu_controller',$this->menu_controller,true);
		$criteria->compare('menu_action',$this->menu_action,true);
		$criteria->compare('is_show',$this->is_show,true);
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
				//$this->create_id=Yii::app()->user->id;
				//$this->create_time=Util::current_time('timestamp');
			}
			return true;
		}else{
			return false;
		}
	}
	function get_operate(){
		  $user=new User();
		  $user_permission_name=$user->get_permissions_name();
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="<div class='operate_button'>";
		  if(Util::is_permission($user_permission_name,"add"))
		     $return_str.=CHtml::link('修改',array($controller_id."/add","id"=>$this->id),array('class'=>'operate_green'));
		  if(Util::is_permission($user_permission_name,"delete"))
		  		$return_str.=CHtml::link('删除','javascript:void(0);',array('id'=>'delete_'.$this->id,'class'=>'operate_red','onclick'=>"javascript:ajax_delete('".Yii::app()->getController()->createUrl('main/delete')."','".get_class($this)."','".$this->id."');"));
		  $return_str.="</div>";
		  return $return_str;
	}
	
	function format_create_time(){
		return date("Y-m-d H:i:s",$this->create_time);
	}
	
		//删除一笔数据
	public function delete_table_datas($pk_id="",$condition=array()){
		$table_datas=$this->get_table_datas($pk_id,$condition);
		if(is_array($table_datas)){
		foreach($table_datas as $key => $value){
			$id=$value->id;
			$child_menu_datas=$this->findAll(array('select'=>'id','condition'=>'menu_parent=:menu_parent','params'=>array(':menu_parent'=>$id)));
      foreach($child_menu_datas as $key1 => $value1){
    	  $child_menu_id=$value1->id;
    	  $this->delete_table_datas($child_menu_id,array());
      }
			$this->deleteByPk($id,"",array());
		}
	 }else{
	 	  $id=$table_datas->id;
			$child_menu_datas=$this->findAll(array('select'=>'id','condition'=>'menu_parent=:menu_parent','params'=>array(':menu_parent'=>$id)));
      foreach($child_menu_datas as $key1 => $value1){
    	  $child_menu_id=$value1->id;
    	  $this->delete_table_datas($child_menu_id,array());
      }
      
      
			$this->deleteByPk($id,"",array());
	 }
	 return true;
	}
	//显示菜单是否显示
	function show_is_show(){
		$is_show=$this->is_show;
		$is_show_select=CV::$is_show_select;
		return $is_show_select[$is_show];
	}
	//显示菜单的名称
	function show_menu_name(){
		if(!empty($this->menu_alias)){
			return $this->menu_name."(".$this->menu_alias.")";
		}else{
			return $this->menu_name;
		}
		
	}
	/*
	 * 获取所有的后台菜单的单个信息
	 * @param $menu_id 菜单的ID
	 * @return array 后台菜单的数组
	 * @auther lxf
	 * @version 1.0.0
	 */
	 function get_menu_by_menu_id($menu_id){
	 		if(empty($menu_id)){
	 			return false;
	 		}
	 		$backend_menu_datas=$this->find(array('select'=>'*','condition'=>"id=:id",'params'=>array(':id'=>$menu_id)));
			return $backend_menu_datas;
	 }
	 
	 
	 

	 /**获取
	 
	 */
	 
	 public function get_parent_menu($menu_id){
	 	 $back_menu_data=$this->find(array('select'=>'menu_parent','condition'=>'id=:id','params'=>array(':id'=>$menu_id),'order'=>'menu_sort ASC'));
	   $menu_parent=$back_menu_data->menu_id;
	   $parent_back_menu_data=$this->find(array('select'=>'*','condition'=>'id=:id','params'=>array(':id'=>$menu_parent),'order'=>'menu_sort ASC'));
	   return $parent_back_menu_data;
	 }
	 
	 /*
	 * 获取菜单的父菜单即menu_parent 为空的菜单
	 * @return array 返回父菜单的选择项
	 * @auther lxf
	 * @version 1.0.0
	 */
	 public function get_top_parent_menu(){
	   $back_menu_datas=$this->findAll(array('select'=>'id,menu_name','condition'=>'menu_parent=:menu_parent','params'=>array(':menu_parent'=>'0'),'order'=>'menu_sort ASC'));
	   $return_menus=array();
	   foreach($back_menu_datas as $key => $value){
	     $return_menus[$value->id]=$value->menu_name;	
	  }
	  return $return_menus;
	 }

}