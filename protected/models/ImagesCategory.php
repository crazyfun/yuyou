<?php

/**
 * This is the model class for table "{{images_category}}".
 *
 * The followings are the available columns in table '{{images_category}}':
 * @property string $id
 * @property string $parent_id
 * @property string $name
 * @property string $create_id
 * @property string $create_time
 */
class ImagesCategory extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ImagesCategory the static model class
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
		return '{{images_category}}';
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
			array('parent_id, create_id, create_time', 'length', 'max'=>11),
			array('name', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent_id, name, create_id, create_time', 'safe', 'on'=>'search'),
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
			'Parent'=>array(self::BELONGS_TO, 'ImagesCategory', 'parent_id'),
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
			'parent_id' => '父类',
			'name' => '名称',
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
		$images=Images::model();
		if(is_array($table_datas)){
		foreach($table_datas as $key => $value){
			$id=$value->id;
      		$child_datas=$this->findAll(array('select'=>'id','condition'=>'parent_id=:parent_id','params'=>array(':parent_id'=>$id)));
     		 foreach($child_datas as $key1 => $value1){
    	  		$child_id=$value1->id;
    	  	  $images->delete_table_datas("",array('condition'=>'t.category_id=:category_id','params'=>array(':category_id'=>$child_id)));
    	  		$this->delete_table_datas($child_id,array());
     		 }
     		$images->delete_table_datas("",array('condition'=>'t.category_id=:category_id','params'=>array(':category_id'=>$id)));
			$this->deleteByPk($id,"",array());
		}
	 }else{
	 	  $id=$table_datas->id;
      	  $child_datas=$this->findAll(array('select'=>'id','condition'=>'parent_id=:parent_id','params'=>array(':parent_id'=>$id)));
      	  foreach($child_datas as $key1 => $value1){
    	  	 $child_id=$value1->id;
    	  	 $images->delete_table_datas("",array('condition'=>'t.category_id=:category_id','params'=>array(':category_id'=>$child_id)));
    	  	 $this->delete_table_datas($child_id,array());
      	  }
      	  $images->delete_table_datas("",array('condition'=>'t.category_id=:category_id','params'=>array(':category_id'=>$id)));
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
		$child_datas=$this->findAll(array('condition'=>implode(" AND ",$conditions),'params'=>$params));
		return $child_datas;
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