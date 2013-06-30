<?php

/**
 * This is the model class for table "{{channels}}".
 *
 * The followings are the available columns in table '{{channels}}':
 * @property string $id
 * @property string $parent_id
 * @property string $name
 * @property integer $permission
 * @property integer $link_type
 * @property string $link_href
 * @property string $content
 * @property string $seo_title
 * @property string $seo_keywords
 * @property string $seo_describe
 * @property string $cover_template
 * @property string $lists_template
 * @property string $archive_template
 * @property string $image_size
 * @property integer $sort
 * @property integer $is_hidden
 * @property string $user_id
 * @property string $create_time
 * @property string $update_time
 */
class Channels extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Channels the static model class
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
		return '{{channels}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,pattern,permission,link_type,is_hidden,cover_template,lists_template,archive_template', 'required','message'=>'{attribute}不能为空'),
			//array('cover_template','exist_cover_template'),
			//array('lists_template','exist_lists_template'),
			//array('archive_template','exist_archive_template'),
			array('permission, link_type, sort, is_hidden', 'numerical', 'integerOnly'=>true),
			array('parent_id, user_id,list_view,list_sort,list_limit', 'length', 'max'=>11),
			array('name,pattern,list_sort_type', 'length', 'max'=>30),
			array('link_href,channel_category, seo_title, cover_template, lists_template, archive_template', 'length', 'max'=>100),
			array('seo_keywords, image_size', 'length', 'max'=>200),
			array('create_time, update_time', 'length', 'max'=>10),
			array('content, seo_describe', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent_id, name, permission, link_type, link_href, content, seo_title, seo_keywords, seo_describe, cover_template, lists_template, archive_template, image_size, sort, is_hidden, user_id, create_time, update_time', 'safe', 'on'=>'search'),
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
			'Parent'=>array(self::BELONGS_TO, 'Channels', 'parent_id'),
			'User'=>array(self::BELONGS_TO,'User','user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' => '父栏目',
			'name' => '栏目名称',
			'pattern'=>'模型',
			'permission' => '浏览权限',
			'link_type' => '栏目属性',
			'link_href' => '栏目链接',
			'content' => '栏目内容',
			'channel_category'=>'栏目分类',
			'seo_title' => 'Seo标题',
			'seo_keywords' => 'Seo关键字',
			'seo_describe' => 'Seo描述',
			'cover_template' => '封面模版',
			'lists_template' => '列表模版',
			'archive_template' => '文章模版',
			'list_view'=>'列表视图',
			'list_sort'=>'列表排序',
			'list_sort_type'=>'排序方式',
			'list_limit'=>'列表数量',
			'image_size' => '图片尺寸',
			'sort' => '排序',
			'is_hidden' => '是否显示',
			'user_id' => '创建人',
			'create_time' => '创建时间',
			'update_time' => '跟新时间',
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
		$criteria->compare('pattern',$this->pattern,true);
		$criteria->compare('permission',$this->permission);
		$criteria->compare('link_type',$this->link_type);
		$criteria->compare('link_href',$this->link_href,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('channel_category',$this->channel_category,true);
		$criteria->compare('seo_title',$this->seo_title,true);
		$criteria->compare('seo_keywords',$this->seo_keywords,true);
		$criteria->compare('seo_describe',$this->seo_describe,true);
		$criteria->compare('cover_template',$this->cover_template,true);
		$criteria->compare('lists_template',$this->lists_template,true);
		$criteria->compare('archive_template',$this->archive_template,true);
		$criteria->compare('list_view',$this->list_view,true);
		$criteria->compare('list_sort',$this->list_sort,true);
		$criteria->compare('list_sort_type',$this->list_sort_type,true);
		$criteria->compare('list_limit',$this->list_limit,true);
		$criteria->compare('image_size',$this->image_size,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('is_hidden',$this->is_hidden);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
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
			$pattern=$value->pattern;
			$model_name=Ucfirst($pattern);
			$model=new $model_name();
		
			$child_menu_datas=$this->findAll(array('select'=>'id','condition'=>'parent_id=:parent_id','params'=>array(':parent_id'=>$id)));
      foreach($child_menu_datas as $key1 => $value1){
    	  $child_menu_id=$value1->id;
    	  $this->delete_table_datas($child_menu_id,array());
    	  $model->deleteAll("channel_id=:channel_id",array(':channel_id'=>$child_menu_id));
      }
			$this->deleteByPk($id,"",array());
			$model->deleteAll("channel_id=:channel_id",array(':channel_id'=>$id));
		}
	 }else{
	 	  $id=$table_datas->id;
	 	  $pattern=$table_datas->pattern;
	 	  $model_name=Ucfirst($pattern);
			$model=new $model_name();
			
			$child_menu_datas=$this->findAll(array('select'=>'id','condition'=>'parent_id=:parent_id','params'=>array(':parent_id'=>$id)));
      foreach($child_menu_datas as $key1 => $value1){
    	  $child_menu_id=$value1->id;
    	  $this->delete_table_datas($child_menu_id,array());
    	  $model->deleteAll("channel_id=:channel_id",array(':channel_id'=>$child_menu_id));
      }
			$this->deleteByPk($id,"",array());
			$model->deleteAll("channel_id=:channel_id",array(':channel_id'=>$id));
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
			   $this->user_id=Yii::app()->user->id;
			   $this->create_time=time();
			}else{
			   $this->update_time=time();
			}
			return true;
		}else{
			return false;
		}
	}
	
	function exist_cover_template(){
		if(!file_exists($this->cover_template)){
			$this->addError("cover_template","封面模版不存在");
		}else{
			return true;
		}
	}
	
	function exist_lists_template(){
		if(!file_exists($this->lists_template)){
			$this->addError("lists_template","列表模版不存在");
		}else{
			return true;
		}
	}
	
	function exist_archive_template(){
		if(!file_exists($this->archive_template)){
			$this->addError("archive_template","文章模版不存在");
		}else{
			return true;
		}
	}
	
	function show_attribute($attribute_id){
	 switch($attribute_id){
	    case 'parent_id':
	    	$this->Parent->name;
	    	break;
	    case 'pattern':
	      $pattern=CV::$pattern;
	      return $pattern[$this->pattern];
	      break;
	    case 'permission':
	    	$channels_permission=CV::$channels_permission;
	        return $channels_permission[$this->permission];
	    	break;
	    case 'link_type':
	    	$channels_link_type=CV::$channels_link_type;
	        return $channels_link_type[$this->link_type];
	    	break;
	    case 'list_view':
	      $config_values=ConfigValues::model();
        $list_view=$config_values->get_ralation_values('5');
	      return $list_view[$this->list_view];
	      break;
	    case 'list_sort':
	      $config_values=ConfigValues::model();
	      $sort_select=$config_values->get_ralation_values('4');
	      return $sort_select[$this->list_sort];
	      break;
	    case 'list_sort_type':
	      $list_sort_type=CV::$list_sort_type;
	      return $list_sort_type[$this->list_sort_type];
	      break;
	    case 'is_hidden':
	    	$channels_is_hidden=CV::$channels_is_hidden;
	        return $channels_is_hidden[$this->is_hidden];
	    	break;
	    case 'user_id':
	    	return $this->User->user_login;
	    	break;
	   
	    case 'create_time':
	    	return date('Y-m-d H:i:s',$this->create_time);
	    	break;
	    case 'update_time':
	    	return date('Y-m-d H:i:s',$this->update_time);
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
	
	
	function get_channel_archives($channel_id,$category_id="",$attr="",$order="t.update_time DESC",$pattern="archives"){
		$model_name=Ucfirst($pattern);
	  $model=new $model_name();		
		$conditions=array();
		$params=array();
		if(empty($channel_id)){
			return null;
		}
		$conditions[]="t.channel_id=:channel_id";
		$params[':channel_id']=$channel_id;
		$conditions[]="t.status<>:status";
		$params[':status']='3';
		if(!empty($category_id)){
			$conditions[]="t.category_id=:category_id";
			$params[':category_id']=$category_id;
		}
		if(!empty($attr)){
			$conditions[]="FIND_IN_SET('".$attr."',t.attr)";
		}
		$model_data=$model->with("Channels")->findAll(array('condition'=>implode(" AND ",$conditions),'params'=>$params,'order'=>$order));
		return $model_data;
	}
	
	function get_move_select($parent_id,$level=0,$pattern="archives"){
		$channels_select=array();
		if($parent_id=="0"){
			$channels_select[0]="根栏目";
		}
		$child_datas=$this->get_child_channels($parent_id,'','',$pattern);
		$level++;
		foreach($child_datas as $key => $value){
		  $name="";
		  for($ii=1;$ii<$level;$ii++){
		  	$name.="─";
		  }
		  $name.=$value->name;	
		  $channels_select[$value->id]=$name;
		  $tem_child_datas=$this->get_move_select($value->id,$level,$pattern);
		  if(!empty($tem_child_datas)){
		  	$channels_select=$channels_select+$tem_child_datas;
		  }
		}
		return $channels_select;
	}
	
	
	function get_channel_select($parent_id,$level=0,$pattern="archives"){
		$channels_select=array();
		
		$child_datas=$this->get_child_channels($parent_id,'','',$pattern);
		$level++;
		foreach($child_datas as $key => $value){
		  $name="";
		  for($ii=1;$ii<$level;$ii++){
		  	$name.="─";
		  }
		  $name.=$value->name;	
		  $channels_select[$value->id]=$name;
		  $tem_child_datas=$this->get_channel_select($value->id,$level,$pattern);
		  if(!empty($tem_child_datas)){
		  	$channels_select=$channels_select+$tem_child_datas;
		  }
		}
		return $channels_select;
	}
	
	
	
	function get_child_channels($parent_id,$show='',$ids="",$pattern=""){
		$conditions=array();
		$params=array();
		if(!empty($show)){
			$conditions[]="t.is_hidden=:is_hidden";
			$params[':is_hidden']=$show;
		} 
		if(!empty($pattern)){
			$conditions[]="t.pattern=:pattern";
			$params[':pattern']=$pattern;
		}
		if(!empty($ids)){
			if(strlen($parent_id)){
				$conditions[]=" t.parent_id=:parent_id ";
			  $params[':parent_id']=$parent_id;
			}
			$conditions[]="FIND_IN_SET(t.id,'".$ids."')>0";
			$sort="";
		}else{
			$conditions[]=" t.parent_id=:parent_id ";
			$params[':parent_id']=$parent_id;
			$sort="t.sort ASC";
	  }
		$child_datas=$this->findAll(array('condition'=>implode(" AND ",$conditions),'params'=>$params,'order'=>$sort));
		return $child_datas;
	}
	
  function get_channel_menus($parent_id,$show='',$ids="",$children='n'){
		$child_datas=$this->get_child_channels($parent_id,$show,$ids);
		$attributes=array();
		foreach($child_datas as $key => $value){
			$attributes[]=$value->attributes;
		}
	 
		foreach((array)$attributes as $key => $value){
			if($children=='y'){
				$tem_child_datas=$this->get_channel_menus($value['id'],$show,$ids,$children);
		    $have_children=$this->get_child_channels($value['id'],$show,$ids);
				if(!empty($tem_child_datas)){
		  	   $value['children']=$tem_child_datas;
		    }
			}
		  $value['href']=$this->set_channel_link($value['id']);
		  $attributes[$key]=$value;
		}
		return $attributes;
	}
	
	function set_admin_channel_link($channel_id){
		$channel_data=$this->findByPk($channel_id);
		$pattern=$channel_data->pattern;
		switch($pattern){
        		case 'archives':
        		  if($channel_data->link_type=='3'){
								return $channel_data->link_href;
							}else{
			    			 if($channel_data->link_type=='1'){
    	      					return Yii::app()->homeUrl."/mchannels/list/channel/".$channel_data['id'];
    	     			 }
    	      		if($channel_data->link_type=='2'){
    	      				return Yii::app()->homeUrl."/mchannels/index/channel/".$channel_data['id'];
    	      		}
							}
        		  break;
        		case 'travel':
        		  if($channel_data->link_type=='3'){
								return $channel_data->link_href;
							}else{
			    			 if($channel_data->link_type=='1'){
    	      					return Yii::app()->homeUrl."/travel/list/channel/".$channel_data['id'];
    	     			 }
    	      		if($channel_data->link_type=='2'){
    	      				return Yii::app()->homeUrl."/travel/index/channel/".$channel_data['id'];
    	      		}
							}
        		  break;
        		case 'hotels':
        		  if($channel_data->link_type=='3'){
								return $channel_data->link_href;
							}else{
			    			 if($channel_data->link_type=='1'){
    	      					return Yii::app()->homeUrl."/hotels/list/channel/".$channel_data['id'];
    	     			 }
    	      		if($channel_data->link_type=='2'){
    	      				return Yii::app()->homeUrl."/hotels/index/channel/".$channel_data['id'];
    	      		}
							}
        		  break;
        		case 'downloads':
        		  if($channel_data->link_type=='3'){
								return $channel_data->link_href;
							}else{
			    			 if($channel_data->link_type=='1'){
    	      					return Yii::app()->homeUrl."/downloads/list/channel/".$channel_data['id'];
    	     			 }
    	      		if($channel_data->link_type=='2'){
    	      				return Yii::app()->homeUrl."/downloads/index/channel/".$channel_data['id'];
    	      		}
							}
        		  break;
        		case 'gallery':
        		  if($channel_data->link_type=='3'){
								return $channel_data->link_href;
							}else{
			    			 if($channel_data->link_type=='1'){
    	      					return Yii::app()->homeUrl."/gallery/list/channel/".$channel_data['id'];
    	     			 }
    	      		if($channel_data->link_type=='2'){
    	      				return Yii::app()->homeUrl."/gallery/index/channel/".$channel_data['id'];
    	      		}
							}
        		  break;
        		case 'group':
        		  if($channel_data->link_type=='3'){
								return $channel_data->link_href;
							}else{
			    			 if($channel_data->link_type=='1'){
    	      					return Yii::app()->homeUrl."/group/list/channel/".$channel_data['id'];
    	     			 }
    	      		if($channel_data->link_type=='2'){
    	      				return Yii::app()->homeUrl."/group/index/channel/".$channel_data['id'];
    	      		}
							}
        		  break;
        		default:
        		 	if($channel_data->link_type=='3'){
								return $channel_data->link_href;
							}else{
			    			 if($channel_data->link_type=='1'){
    	      					return Yii::app()->homeUrl."/mchannels/list/channel/".$channel_data['id'];
    	     			 }
    	      		if($channel_data->link_type=='2'){
    	      				return Yii::app()->homeUrl."/mchannels/index/channel/".$channel_data['id'];
    	      		}
							}
        		  break;
    }
	}
	
	function set_channel_link($channel_id){
		$channel_data=$this->findByPk($channel_id);
		$pattern=$channel_data->pattern;
		switch($pattern){
        		case 'archives':
        		  if($channel_data->link_type=='3'){
								return $channel_data->link_href;
							}else{
			    			 if($channel_data->link_type=='1'){
			    			 	    return Yii::app()->getController()->createUrl("mchannels/list",array('channel'=>$channel_data['id']));
    	     			 }
    	      		if($channel_data->link_type=='2'){
    	      			  return Yii::app()->getController()->createUrl("mchannels/index",array('channel'=>$channel_data['id']));	
    	      		}
							}
        		  break;
        		case 'travel':
        		  if($channel_data->link_type=='3'){
								return $channel_data->link_href;
							}else{
			    			 if($channel_data->link_type=='1'){
			    			 	    return Yii::app()->getController()->createUrl("travel/list",array('channel'=>$channel_data['id']));	
    	     			 }
    	      		if($channel_data->link_type=='2'){
    	      			  return Yii::app()->getController()->createUrl("travel/index",array('channel'=>$channel_data['id']));	
    	      		}
							}
        		  break;
        	 case 'hotels':
        		  if($channel_data->link_type=='3'){
								return $channel_data->link_href;
							}else{
			    			 if($channel_data->link_type=='1'){
			    			 	    return Yii::app()->getController()->createUrl("hotels/list",array('channel'=>$channel_data['id']));	
    	     			 }
    	      		if($channel_data->link_type=='2'){
    	      			  return Yii::app()->getController()->createUrl("hotels/index",array('channel'=>$channel_data['id']));	
    	      		}
							}
        		  break;
        		case 'downloads':
        		  if($channel_data->link_type=='3'){
								return $channel_data->link_href;
							}else{
			    			 if($channel_data->link_type=='1'){
			    			 	    return Yii::app()->getController()->createUrl("downloads/list",array('channel'=>$channel_data['id']));	
    	     			 }
    	      		if($channel_data->link_type=='2'){
    	      			  return Yii::app()->getController()->createUrl("downloads/index",array('channel'=>$channel_data['id']));	
    	      		}
							}
        		  break;
        		case 'gallery':
        		  if($channel_data->link_type=='3'){
								return $channel_data->link_href;
							}else{
			    			 if($channel_data->link_type=='1'){
			    			 	    return Yii::app()->getController()->createUrl("gallery/list",array('channel'=>$channel_data['id']));	
    	     			 }
    	      		if($channel_data->link_type=='2'){
    	      			  return Yii::app()->getController()->createUrl("gallery/index",array('channel'=>$channel_data['id']));	
    	      		}
							}
        		  break;
        		  
        		case 'group':
        		  if($channel_data->link_type=='3'){
								return $channel_data->link_href;
							}else{
			    			 if($channel_data->link_type=='1'){
			    			 	    return Yii::app()->getController()->createUrl("group/list",array('channel'=>$channel_data['id']));	
    	     			 }
    	      		if($channel_data->link_type=='2'){
    	      			  return Yii::app()->getController()->createUrl("group/index",array('channel'=>$channel_data['id']));	
    	      		}
							}
        		  break;
        		default:
        		 if($channel_data->link_type=='3'){
								return $channel_data->link_href;
							}else{
			    			 if($channel_data->link_type=='1'){
			    			 	    return Yii::app()->getController()->createUrl("mchannels/list",array('channel'=>$channel_data['id']));
    	      				
    	     			 }
    	      		if($channel_data->link_type=='2'){
    	      			  return Yii::app()->getController()->createUrl("mchannels/index",array('channel'=>$channel_data['id']));	
    	      		}
							}
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
    function get_parents($id){
    	$parents = array();
    	
        $channel = $this->findByPk($id);
        if (!empty($channel))
        {
            if ($channel['parent_id'])
            {
                $tmp = $this->get_parents($channel['parent_id']);
                $parents = array_merge($parents, $tmp);
                $parents[] = $channel['parent_id'];
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
	
//获得搜索时的栏目
 function get_search_channel($parent_id,$level=0,$ids="",$pattern="archives"){
 	  /*
 	  if(empty($ids)){
 	  	$tem_ids=array();
 	  	$condition=array();
 	  	$params=array();
 	  	if(empty($pattern)){
 	  		$condition[]='t.pattern=:pattern';
 	     	$params=array(':pattern'=>$pattern);
 	  	}
 	  	if(strlen($parent_id)){
 	  		$condition[]='t.parent_id=:parent_id';
 	     	$params=array(':parent_id'=>$parent_id);
 	  	}
 	  	$channel_datas=$this->findAll(array('select'=>'t.id,t.parent_id,t.link_type','condition'=>implode(" AND ",$condition),'params'=>$params));
 	  	foreach($channel_datas as $key => $value){
 	  		if(($value->link_type=="1")){
 	  			$tem_ids[]=$value->id;
 	  			$tem_ids[]=$value->parent_id;
 	  		}
 	  	}
 	  	$ids=implode(",",$tem_ids);
 	  }
 	  */
 		$channels_select=array();
		$child_datas=$this->get_child_channels($parent_id,"",$ids,$pattern);
		$level++;
		foreach($child_datas as $key => $value){
		  $name="";
		  for($ii=1;$ii<$level;$ii++){
		  	$name.="─";
		  }
		  $name.=$value->name;	
		  $channels_select[$value->id]=$name;
		  $tem_child_datas=$this->get_search_channel($value->id,$level,$ids,$pattern);
		  if(!empty($tem_child_datas)){
		  	$channels_select=$channels_select+$tem_child_datas;
		  }
		}
		return $channels_select;
 }
}
