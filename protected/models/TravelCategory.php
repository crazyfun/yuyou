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
class TravelCategory extends BaseActive
{
	public $switchs;
	public $layer;
	public $childerns;
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
		return '{{travel_category}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			 array('category_name','required','message'=>'{attribute}不能为空'),
			array('sort_order', 'numerical', 'integerOnly'=>true),
			array('category_name', 'length', 'max'=>100),
			array('parent_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('category_id, category_name, parent_id, sort_order', 'safe', 'on'=>'search'),
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
			'Parent'=>array(self::BELONGS_TO, 'TravelCategory', 'parent_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'category_id' => 'ID',
			'category_name' => '分类名称',
			'parent_id' => '父分类',
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

		$criteria->compare('category_id',$this->category_id,true);
		$criteria->compare('category_name',$this->category_name,true);
		$criteria->compare('parent_id',$this->parent_id,true);
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
	  		$descendant=$this->get_descendant($value->category_id);
	  		array_push($descendant,$value->category_id);
	  		$this->deleteAll('category_id '.Util::db_create_in($descendant),array());
	  		
	  	}
	  }else{
	  	 $descendant=$this->get_descendant($table_datas->category_id);
	  		array_push($descendant,$table_datas->category_id);
	  		$this->deleteAll('category_id '.Util::db_create_in($descendant),array());
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
			case 'parent_id':
				 return $this->Parent->category_name;
				break;
			default:
			  return $this->$attribute_name;
			  break;
		}
	}
	
	
	 public function get_categorys()
    {
       
        $categorys = $this->get_list(0);
        if ($categorys)
        {
            $tmp  = array();
            foreach ($categorys as $key => $value)
            {
                $tmp[$key] = $value['category_name'];
            }
            $categorys = $tmp;
        }
        return $categorys;
    }
    
    
    
      /**
     * 取得地区列表
     *
     * @param int $parent_id 大于等于0表示取某个地区的下级地区，小于0表示取所有地区
     * @return array
     */
    function get_list($parent_id = -1)
    {
    
        if ($parent_id >= 0)
        {
            return $this->findAll(array(
                'condition' => "parent_id = :parent_id",
                'params'=>array(':parent_id'=>$parent_id),
                'order' => 'sort_order ASC, category_id ASC',
            ));
        }
        else
        {
            return $this->findAll(array(
            	  'condition'=>'',
            	  'params'=>array(),
            	  'order'=>'sort_order ASC, category_id ASC'
            	));
        }
    }



    /**
     * 取得options，用于下拉列表
     */
    function get_options($parent_id = 0)
    {
        $res = array();
        $categorys = $this->get_list($parent_id);
        foreach ($categorys as $category)
        {
            $res[$category['category_id']] = $category['category_name'];
        }
        return $res;
    }

    /**
     * 取得某地区的所有子孙地区id
     */
    function get_descendant($id)
    {
    	$ids=array();
    	$ids[]=$id; 
    	
       $this->_get_descendant($id,$ids);
 
    	return array_unique($ids);
    }

    /**
     * 取得某地区的所有父级地区
     *
     * @author Garbin
     * @param  int $category_id
     * @return void
     **/
    function get_parents($category_id)
    {
      $parents = array();
    
        $category = $this->findByPk($id);
        if (!empty($category))
        {
            if ($category['parent_id'])
            {
                $tmp = $this->get_parents($category['parent_id']);
                $parents = array_merge($parents, $tmp);
                $parents[] = $category['parent_id'];
            }
            $parents[] = $id;
        }  
       
      return array_unique($parents);
    }

    function _get_descendant($id,&$ids)
    { 
        $childs = $this->findAll(array(
            'select' => 'category_id',
            'condition' => "parent_id =" . $id,
        ));
        foreach ($childs as $key => $child)
        {
            $tem_id=$child->category_id;
            if(!empty($tem_id)){
            	$ids[]=$tem_id;
            	$this->_get_descendant($tem_id,$ids);
            }
        }
    }
    
  
    //获取选择区域的列表项
    function get_select_categorys(){
       $charaters=CV::$charaters;
       $return_array=array();
       foreach($charaters as $key => $value){
       	 $tem=array();
       	 $tem['id']=$key;
       	 $tem['name']=$value;
       	 $tem['children']=array();
         $children_datas=$this->findAll(array('select'=>'category_id,category_name,parent_id','condition'=>"sort_order=:sort_order",'params'=>array(':sort_order'=>$key)));
         foreach($children_datas as $key1 => $value1){
         	 $children_tem=array();
         	 $children_tem['id']=$value1->category_id;
         	 $children_tem['name']=$value1->category_name;
         	 $children_tem['parent_id']=$value1->parent_id;
         	 $tem['children'][]=$children_tem;
         }
         $return_array[]=$tem;
       }
       return $return_array;
    }
   //获取选择区域的选择项
    function get_options_categorys(){
         $category_datas=$this->findAll(array('select'=>'category_id,category_name','condition'=>"",'params'=>array(),'order'=>'sort_order ASC'));
         $return_array=array();
         foreach($category_datas as $key => $value){
         	 $return_array[$value->category_id]=$value->category_name;
         }
         return $return_array;
    }  
  function get_operate(){
		  $user=new User();
		  $user_permission_name=$user->get_permissions_name();
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="<div class='operate_button'>";
		  if(Util::is_permission($user_permission_name,"edit"))
		     $return_str.=CHtml::link('编辑',array($controller_id."/edit","id"=>$this->category_id),array());
		  if(Util::is_permission($user_permission_name,"delete"))
		     $return_str.="|".CHtml::link('删除',"javascript:if(confirm('下级区域一起被删除，确认要删除吗？'))window.location = '".Yii::app()->getController()->createUrl("travelcategory/delete",array('id'=>$this->category_id)).";'",array());
		  if(Util::is_permission($user_permission_name,"add"))
		     $return_str.="|".CHtml::link('新增下级',Yii::app()->getController()->createUrl('travelcategory/add',array('pid'=>$this->category_id)),array());
  
		  $return_str.="</div>";
		  return $return_str;
	}
	
  function get_category_level($category_id){
  	$parent_datas=$this->get_parents($category_id);
  	return count($parent_datas);
  	
  }
  //获取分类的子分类
  function get_category_datas($parent_id){
  	$category_datas=$this->findAll(array('condition'=>'t.parent_id = :parent_id','params'=>array(':parent_id'=>$parent_id),'order'=>'t.sort_order ASC'));
  	return $category_datas;
  	
  }
  
 //获取周边有的搜索分类
  function get_zhoubian_category($parent_ids){
  	$parent_datas=$this->findAll(array('condition'=>'t.category_id '.Util::db_create_in($parent_ids),'params'=>array(),'order'=>'t.sort_order ASC'));
  	foreach($parent_datas as $key => $value){
  		$child_datas=$this->findAll(array('condition'=>'t.parent_id = :parent_id','params'=>array(':parent_id'=>$value->category_id),'order'=>'t.sort_order ASC'));
  		$value['childerns']=$child_datas;
  		$parent_datas[$key]=$value;
  	}
  	return $parent_datas;
  	
  }
}