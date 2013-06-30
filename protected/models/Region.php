<?php

/**
 * This is the model class for table "{{region}}".
 *
 * The followings are the available columns in table '{{region}}':
 * @property string $region_id
 * @property string $region_name
 * @property string $parent_id
 * @property string $open
 * @property integer $sort_order
 */
class Region extends BaseActive
{
	public $switchs;
	public $layer;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Region the static model class
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
		return '{{region}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		    array('region_name,english_name','required','message'=>'{attribute}不能为空'),
			array('sort_order,open', 'numerical', 'integerOnly'=>true),
			array('region_name,english_name', 'length', 'max'=>100),
			array('parent_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('region_id, region_name, english_name,parent_id, open,sort_order', 'safe', 'on'=>'search'),
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
			'Parent'=>array(self::BELONGS_TO, 'Region', 'parent_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'region_id' => 'ID',
			'region_name' => '区域名称',
			'english_name'=>'英文名称',
			'parent_id' => '父区域',
			'open'=>'开通状态',
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

		$criteria->compare('region_id',$this->region_id,true);
		$criteria->compare('region_name',$this->region_name,true);
		$criteria->compare('english_name',$this->english_name,true);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('open',$this->open,true);
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
	  		$descendant=$this->get_descendant($value->region_id);
	  		array_push($descendant,$value->region_id);
	  		$this->deleteAll('region_id '.Util::db_create_in($descendant),array());
	  		
	  	}
	  }else{
	  	 $descendant=$this->get_descendant($table_datas->region_id);
	  		array_push($descendant,$table_datas->region_id);
	  		$this->deleteAll('region_id '.Util::db_create_in($descendant),array());
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
				 return $this->Parent->region_name;
				break;
		  case 'open':
		    return CV::$region_status[$this->open];
		    break;
		    
			default:
			  return $this->$attribute_name;
			  break;
		}
	}
	
	
	 public function get_regions()
    {
       
        $regions = $this->get_list(0);
        if ($regions)
        {
            $tmp  = array();
            foreach ($regions as $key => $value)
            {
                $tmp[$key] = $value['region_name'];
            }
            $regions = $tmp;
        }
        return $regions;
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
                'order' => 'sort_order ASC, region_id ASC',
            ));
        }
        else
        {
            return $this->findAll(array(
            	  'condition'=>'',
            	  'params'=>array(),
            	  'order'=>'sort_order ASC, region_id ASC'
            	));
        }
    }



    /**
     * 取得options，用于下拉列表
     */
    function get_options($parent_id = 0)
    {
        $res = array();
        $regions = $this->get_list($parent_id);
        foreach ($regions as $region)
        {
            $res[$region['region_id']] = $region['region_name'];
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
     * @param  int $region_id
     * @return void
     **/
    function get_parents($region_id)
    {  
      $parents = array();
    
        $region = $this->findByPk($region_id);
        if (!empty($region))
        {
            if ($region['parent_id'])
            {
                $tmp = $this->get_parents($region['parent_id']);
                $parents = array_merge($parents, $tmp);
                $parents[] = $region['parent_id'];
            }
            $parents[] = $region_id;
        }  
 
      return array_unique($parents);
    }

    function _get_descendant($id,&$ids)
    { 
        $childs = $this->findAll(array(
            'select' => 'region_id',
            'condition' => "parent_id =" . $id,
        ));
        foreach ($childs as $key => $child)
        {
            $tem_id=$child->region_id;
            if(!empty($tem_id)){
            	$ids[]=$tem_id;
            	$this->_get_descendant($tem_id,$ids);
            }
        }
    }
    
  
    //获取选择区域的列表项
    function get_select_regions(){
       $charaters=CV::$charaters;
       $return_array=array();
       foreach($charaters as $key => $value){
       	 $tem=array();
       	 $tem['id']=$key;
       	 $tem['name']=$value;
       	 $tem['children']=array();
         $children_datas=$this->findAll(array('select'=>'region_id,region_name,english_name,parent_id','condition'=>"sort_order=:sort_order AND open=:open",'params'=>array(':sort_order'=>$key,':open'=>'2')));
         foreach($children_datas as $key1 => $value1){
         	 $children_tem=array();
         	 $children_tem['id']=$value1->region_id;
         	 $children_tem['name']=$value1->region_name;
         	 $children_tem['english_name']=$value1->english_name;
         	 $children_tem['parent_id']=$value1->parent_id;
         	 $tem['children'][]=$children_tem;
         }
         $return_array[]=$tem;
       }
       return $return_array;
    }
   //获取选择区域的选择项
    function get_options_regions(){
         $region_datas=$this->findAll(array('select'=>'region_id,region_name,english_name','condition'=>"open=:open",'params'=>array(':open'=>'2'),'order'=>'sort_order ASC'));
         $return_array=array();
         foreach($region_datas as $key => $value){
         	 $return_array[$value->region_id]=$value->region_name;
         }
         return $return_array;
    }  
  function get_operate(){
		  $user=new User();
		  $user_permission_name=$user->get_permissions_name();
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="<div class='operate_button'>";
		  if(Util::is_permission($user_permission_name,"edit"))
		     $return_str.=CHtml::link('编辑',array($controller_id."/edit","id"=>$this->region_id),array());
		  if(Util::is_permission($user_permission_name,"delete"))
		     $return_str.="|".CHtml::link('删除',"javascript:if(confirm('下级区域一起被删除，确认要删除吗？'))window.location = '".Yii::app()->getController()->createUrl("mregion/delete",array('id'=>$this->region_id)).";'",array());
		  if(Util::is_permission($user_permission_name,"add"))
		     $return_str.="|".CHtml::link('新增下级',Yii::app()->getController()->createUrl('mregion/add',array('pid'=>$this->region_id)),array());
		 if(Util::is_permission($user_permission_name,"open")){
         if($this->open=='2'){
		     	  $return_str.="|".'<a href="'.Yii::app()->getController()->createUrl('mregion/open',array('open'=>'1','id'=>$this->region_id)).'">取消开通</a>';
		     }else{
		     	$return_str.="|".'<a href="'.Yii::app()->getController()->createUrl('mregion/open',array('open'=>'2','id'=>$this->region_id)).'">开通</a>';	
		    }   
		 }   
		  $return_str.="</div>";
		  return $return_str;
	}
	
  function get_region_level($region_id){
  	$parent_datas=$this->get_parents($region_id);
  	return count($parent_datas);
  	
  }
	
}