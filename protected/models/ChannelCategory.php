<?php

/**
 * This is the model class for table "{{channel_category}}".
 *
 * The followings are the available columns in table '{{channel_category}}':
 * @property string $id
 * @property string $parent_id
 * @property string $name
 * @property string $create_time
 */
class ChannelCategory extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ChannelCategory the static model class
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
		return '{{channel_category}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name','required','message'=>'{attribute}不能为空'),
			array('parent_id', 'length', 'max'=>11),
			array('name', 'length', 'max'=>30),
			array('sort','length','max'=>2),
			array('create_time', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent_id, name, create_time', 'safe', 'on'=>'search'),
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
			'Parent'=>array(self::BELONGS_TO, 'ChannelCategory', 'parent_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' => '父类名称',
			'name' => '分类名称',
			'sort'=>'排序',
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
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('sort',$this->sort,true);
		$criteria->compare('create_time',$this->create_time,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
  //删除一笔数据
	public function delete_table_datas($pk_id="",$condition=array()){
		$table_datas=$this->get_table_datas($pk_id,$condition);
		if(is_array($table_datas)){
		foreach($table_datas as $key => $value){
			$id=$value->id;
      $child_datas=$this->findAll(array('select'=>'id','condition'=>'parent_id=:parent_id','params'=>array(':parent_id'=>$id)));
      foreach($child_datas as $key1 => $value1){
    	  $child_id=$value1->id;
    	  $this->delete_table_datas($child_id,array());
      }
			$this->deleteByPk($id,"",array());
		}
	 }else{
	 	  $id=$table_datas->id;
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
	 	case 'parent_id':
	 		return $this->Parent->name;
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
	
	
 function get_select($parent_id,$level=0){
		$category_select=array();
		$child_datas=$this->get_childs($parent_id);
		$level++;
		foreach($child_datas as $key => $value){
		  $name="";
		  for($ii=1;$ii<$level;$ii++){
		  	$name.="─";
		  }
		  $name.=$value->name;	
		  $category_select[$value->id]=$name;
		  $tem_child_datas=$this->get_select($value->id,$level);
		  if(!empty($tem_child_datas)){
		  	$category_select=$category_select+$tem_child_datas;
		  }
		}
		return $category_select;
	}
	
	
	function get_category($pattern,$parent_id,$channel="",$ids=""){
		$child_datas=$this->get_childs($parent_id,$ids);
		$attributes=array();
		foreach($child_datas as $key => $value){
			$attributes[]=$value->attributes;
		}
		foreach((array)$attributes as $key => $value){
		  $tem_child_datas=$this->get_category($pattern,$value['id'],$channel,$ids);
		  if(!empty($tem_child_datas)){
		  	$value['children']=$tem_child_datas;
		  }
		  $value['href']=$this->set_category_link($pattern,$value['id'],$channel);
		  $attributes[$key]=$value;
		}
		return $attributes;
	}
	
	
	function get_childs($parent_id,$ids=""){
		$conditions=array();
		$params=array();
		if(!empty($ids)){
			if(strlen($parent_id)){
				$conditions[]=" t.parent_id=:parent_id ";
			  $params[':parent_id']=$parent_id;
			}
			$conditions[]="FIND_IN_SET(t.id,'".$ids."')>0";
		}else{
			$conditions[]=" t.parent_id=:parent_id ";
			$params[':parent_id']=$parent_id;
	  }
		$child_datas=$this->findAll(array('condition'=>implode(" AND ",$conditions),'params'=>$params,'order'=>'t.sort ASC'));
		return $child_datas;
	}
	
	
	function set_category_link($pattern,$category,$channel=""){
		switch($pattern){
        		case 'archives':
               return Yii::app()->getController()->createUrl("mchannels/list",array('channel'=>$channel,'category'=>$category));
        		  break;
        		case 'travel':
			    		return Yii::app()->getController()->createUrl("travel/list",array('channel'=>$channel,'category'=>$category));	
        		  break;
        		case 'downloads':
			    		return Yii::app()->getController()->createUrl("downloads/list",array('channel'=>$channel,'category'=>$category));	
        		  break;
        		case 'gallery':
			    		return Yii::app()->getController()->createUrl("gallery/list",array('channel'=>$channel,'category'=>$category));	
        		  break;
        		case 'group':
			    		return Yii::app()->getController()->createUrl("group/list",array('channel'=>$channel,'category'=>$category));	
        		  break;
        		case 'hotels':
			    		return Yii::app()->getController()->createUrl("hotels/list",array('channel'=>$channel,'category'=>$category));	
        		  break;
        		default:
        		  return Yii::app()->getController()->createUrl("mchannels/list",array('channel'=>$channel,'category'=>$category));
        		  break;
    }
	
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
    function get_parents($id)
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
            'select' => 'id',
            'condition' => "parent_id =" . $id,
        ));
        foreach ($childs as $key => $child)
        {
            $tem_id=$child->id;
            if(!empty($tem_id)){
            	$ids[]=$tem_id;
            	$this->_get_descendant($tem_id,$ids);
            }
        }
    }
}