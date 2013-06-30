<?php
 /**
 * EHtml类库 用户操作view层的操作项
 * @author LXF 
 */
class EHtml extends CHtml {
	function __construct(){
		
	}
	/*
	 * 创建Text
	 * @param string $input_name 输入框的名字
	 * @param string $value 内容
	 * @param array $htmlOptions 输入框附加的属性
	 * @param string $attributes_id 输入框附加的字段属性ID
	 * @return string 返回输入框
	 * @auther lxf
	 * @since 1.0.0
	 */
	public static function createText($input_name,$value='',$htmlOptions=array()){
		 
		 if(empty($htmlOptions['id'])){
		    $htmlOptions['id']=	$input_name;
		 }
		 return self::textField($input_name,$value,$htmlOptions);
	}

	/*
	 * 创建数字的Text
	 * @param string $model model的名字
	 * @param string $attribute model的字段
	 * @param array $htmlOptions 输入框附加的属性
	 * @return string 返回输入框
	 * @auther lxf
	 * @since 1.0.0
	 */
	public static function createNumber($input_name,$value='',$htmlOptions=array()){
		 $return_str="";
		 if(empty($htmlOptions['id'])){
		    $htmlOptions['id']=	$input_name;
		 }
		 $return_str.=self::textField($input_name,$value,$htmlOptions);
		 $return_str.="
		    <script language='javascript'>
		       jQuery('#".$input_name."').live('blur',function(){
		           var number_value=jQuery(this).val();
		           if(number_value&&isNaN(number_value)){
		              jQuery(this).val('');
		           }
		       });
		    </script>";
		return $return_str;
	}
	/**
	 * 创建HiddenText
	 * @param string $input_name 输入框的名字
	 * @param string $value 内容
	 * @param array $htmlOptions 输入框附加的属性
	 * @param string $attributes_id 输入框附加的字段属性ID
	 * @return string 返回输入框
	 * @auther lxf
	 * @since 1.0.0
	 */
	public static function createHidden($input_name,$value='',$htmlOptions=array()){
		 if(empty($htmlOptions['id'])){
		    $htmlOptions['id']=	$input_name;
		 }
		 return self::hiddenField($input_name,$value,$htmlOptions);
	}
	/**
	 * 创建PasswordText
	 * @param string $input_name 输入框的名字
	 * @param string $value 内容
	 * @param array $htmlOptions 输入框附加的属性
	 * @param string $attributes_id 输入框附加的字段属性ID
	 * @return string 返回输入框
	 * @auther lxf
	 * @since 1.0.0
	 */

	public static function createPassword($input_name,$value='',$htmlOptions=array()){
		 if(empty($htmlOptions['id'])){
		    $htmlOptions['id']=	$input_name;
		 }
		 return self::passwordField($input_name,$value,$htmlOptions);
	}
		/**
	 * 创建FileText
	 * @param string $input_name 输入框的名字
	 * @param string $value 内容
	 * @param array $htmlOptions 输入框附加的属性
	 * @param string $attributes_id 输入框附加的字段属性ID
	 * @return string 返回输入框
	 * @auther lxf
	 * @since 1.0.0
	 */

	public static function createFile($input_name,$value='',$htmlOptions=array()){
		
		 if(empty($htmlOptions['id'])){
		    $htmlOptions['id']=	$input_name;
		 }
		 //是否显示图片的编辑按钮
		 if(!isset($htmlOptions['edit'])){
		 	 $htmlOptions['edit']=true;
		 }
		 $return_str=self::fileField($input_name,"",$htmlOptions);
		 //显示图片并编辑图片
		 if($htmlOptions['edit']&&!empty($value)){
		 	  $select_checkbox=self::checkBox("select_".$input_name,true,array());
		 	  $return_str.="<div class='content_img'><img src='".(Yii::app()->homeUrl."/".$value)."' width='160' height='80'/>".$select_checkbox."选择";
		 	  if($htmlOptions['is_cope']){
		 	    $return_str.="&nbsp;&nbsp;<input type='button' name='crop' value='裁剪' class='operate_green' onclick=\"javascript:window.open('/api/crop?image_name=".$value."&crop_size=&crop_aspect=','裁剪图片', 'height=500, width=1000, top=0, left=0, toolbar=no, menubar=no, scrollbars=yes, resizable=no,location=no, status=no');\"/>";
		 	  }
		 	  $return_str.="</div>";
		 }
		 return $return_str;
	}
		/**
	 * 创建FileText
	 * @param string $model model的名字
	 * @param string $attribute model的字段
	 * @param array $htmlOptions 输入框附加的属性
	 * @return string 返回输入框
	 * @auther lxf
	 * @since 1.0.0
	 */
	public static function createUploadfile($input_name,$value='',$htmlOptions=array()){
		 if(empty($htmlOptions['id'])){
		    $htmlOptions['id']=	$input_name;
		 }

		 //是否显示图片的编辑按钮
		 if(!isset($htmlOptions['edit'])){
		 	 $htmlOptions['edit']=true;
		 }
		 $return_str=self::fileField($input_name,"",$htmlOptions);
		 //显示图片并编辑图片
		 if($htmlOptions['edit']&&!empty($value)){
		 	  $select_checkbox=self::checkBox("select_".$input_name,true,array());
		 	  $upload_file=explode("/",$value);
	      $upload_name=end($upload_file);
		 	  $return_str.="<div class='content_img'>".$select_checkbox."&nbsp;&nbsp;".CHtml::link($upload_name,"/".$value,array());
		 	  $return_str.="</div>";
		 }
		 return $return_str;
	}
	
	
	 /*
	 * 创建image显示
	 * @param string $input_name alert的名字
	 * @param string $value图片连接
	 * @param array $htmlOptions 输入框附加的属性
	 * @return string 返回image显示
	 * @auther lxf
	 * @since 1.0.0
	 */
	public static function createImage($input_name,$value='',$htmlOptions=array()){
		 if(empty($htmlOptions['id'])){
		    $htmlOptions['id']=	$input_name;
		 }
		 return CHtml::image($value,$input_name,$htmlOptions);
	}
	
	
	
	/**
	 * 创建TextareaText
	 * @param string $input_name 输入框的名字
	 * @param string $value 内容
	 * @param array $htmlOptions 输入框附加的属性
	 * @param string $attributes_id 输入框附加的字段属性ID
	 * @return string 返回输入框
	 * @auther lxf
	 * @since 1.0.0
	 */
	public static function createTextarea($input_name,$value='',$htmlOptions=array()){
		if(empty($htmlOptions['id'])){
		    $htmlOptions['id']=	$input_name;
		 }
		 return self::textArea($input_name,$value,$htmlOptions);
	}
	/**
	 * 创建Select
	 * @param string $input_name 输入框的名字
	 * @param string $select Select输入框的选择项
	 * @param array $value 输入框选择的数组
	 * @param array $htmlOptions 输入框附加的属性
	 * @param string $attributes_id 输入框附加的字段属性ID
	 * @return string 返回输入框
	 * @auther lxf
	 * @since 1.0.0
	 */
	public static function createSelect($input_name,$select="",$value,$htmlOptions=array()){
		if(empty($htmlOptions['id'])){
		    $htmlOptions['id']=	$input_name;
		 }
		return self::dropDownList($input_name,$select,$value,$htmlOptions);
	}
	
	/**
	 * 创建multiselect
	 * @param string $model model的名字
	 * @param string $attribute model的字段
	 * @param array $data 输入框选择的数组
	 * @param array $htmlOptions 输入框附加的属性
	 * @return string 返回输入框
	 * @auther lxf
	 * @since 1.0.0
	 */
	public static function createMulti($input_name,$select,$value,$htmlOptions=array()){
		if(empty($htmlOptions['id'])){
		    $htmlOptions['id']=	$input_name;
		 }
		if(!isset($htmlOptions['multiple'])){
		 	$htmlOptions['multiple']=true;
		}
		return self::listBox($input_name,$select,$value,$htmlOptions);
	}
	
	/**
	 * 创建CheckBox
	 * @param string $input_name 输入框的名字
	 * @param string $select checkbox是否选择
	 * @param array $htmlOptions 输入框附加的属性
	 * @param string $attributes_id 输入框附加的字段属性ID
	 * @return string 返回输入框
	 * @auther lxf
	 * @since 1.0.0
	 */
	public static function createCheck($input_name,$select,$htmlOptions=array()){
		if(empty($htmlOptions['id'])){
		    $htmlOptions['id']=	$input_name;
		 }
		 if(empty($htmlOptions['separator'])){
			$htmlOptions['separator']="&nbsp;";
		}
		return self::checkBox($input_name,$select,$htmlOptions);
	}
	
	/**
	 * 创建CheckBoxList
	 * @param string $input_name 输入框的名字
	 * @param string $select checkbox输入框的选择项
	 * @param array $value 输入框选择的数组
	 * @param array $htmlOptions 输入框附加的属性
	 * @param string $attributes_id 输入框附加的字段属性ID
	 * @return string 返回输入框
	 * @auther lxf
	 * @since 1.0.0
	 */
	public static function createCheckbox($input_name,$select="",$value,$htmlOptions=array()){
		if(empty($htmlOptions['id'])){
		    $htmlOptions['id']=	$input_name;
		 }
		 if(empty($htmlOptions['separator'])){
			$htmlOptions['separator']="&nbsp;";
		}
		return self::checkBoxList($input_name,$select,$value,$htmlOptions);
	}
	/**
	 * 创建Radio
	 * @param string $input_name 输入框的名字
	 * @param string $select Radio输入框的选择项
	 * @param array $value 输入框选择的数组
	 * @param array $htmlOptions 输入框附加的属性
	 * @param string $attributes_id 输入框附加的字段属性ID
	 * @return string 返回输入框
	 * @auther lxf
	 * @since 1.0.0
	 */
	public static function createRadio($input_name,$select="",$value,$htmlOptions=array()){
		if(empty($htmlOptions['id'])){
		    $htmlOptions['id']=	$input_name;
		 }
		if(empty($htmlOptions['separator'])){
			$htmlOptions['separator']="&nbsp;";
		}
		return self::radioButtonList($input_name,$select,$value,$htmlOptions);
	}
	/**
	 * 创建Date
	 * @param string $input_name 输入框的名字
	 * @param array $value 输入框内容
	 * @param array $htmlOptions 输入框附加的属性
	 * @param string $attributes_id 输入框附加的字段属性ID
	 * @return string 返回时间输入框
	 * @auther lxf
	 * @since 1.0.0
	 */
	public static function createDate($input_name,$value="",$htmlOptions=array()){
		if(empty($htmlOptions['dateFmt'])){
			$htmlOptions['dateFmt']="yyyy-MM-dd";
		}
		if(empty($htmlOptions['id'])){
		    $htmlOptions['id']=	$input_name;
		 }
		 $extern_str="";
		 if($htmlOptions['doubleCalendar']){
		 	 $extern_str='doubleCalendar:true,';
		 }
		if(!empty($htmlOptions['minDate'])){
		 	$extern_str.='minDate:"'.$htmlOptions['minDate'].'",';
		}
		if(!empty($htmlOptions['maxDate'])){
			$extern_str.='maxDate:"'.$htmlOptions['maxDate'].'",';
		}

		if(empty($htmlOptions['onclick'])){
			$htmlOptions['onclick']='javascript:WdatePicker({'.$extern_str.'dateFmt:"'.$htmlOptions['dateFmt'].'",startDate:"'.$value.'",readOnly:true});';
		}
		Yii::app()->clientScript->registerScriptFile('/js/My97DatePicker/WdatePicker.js');
		return self::textField($input_name,$value,$htmlOptions);
	}
	
	/**
	 * 创建Multitext
	 * @param string $input_name 输入框的名字
	 * @param array $value 输入框内容
	 * @param array $htmlOptions 输入框附加的属性
	 * @param string $attributes_id 输入框附加的字段属性ID
	 * @return string 返回富文本输入框
	 * @auther lxf
	 * @since 1.0.0
	 */
	public static function createMultitext($input_name,$value="",$htmlOptions=array()){
		if(empty($htmlOptions['id'])){
		    $htmlOptions['id']=	$input_name;
		 }
		 if(empty($htmlOptions['toobar'])){
		   	$htmlOptions['toobar']="Default";
		 }
		 
		if(empty($htmlOptions['width'])){
		 	$htmlOptions['width']="600px";
		}
		
		if(empty($htmlOptions['height'])){
		 	$htmlOptions['height']="400px";
		}
		return Yii::app()->getController()->widget('application.extensions.fckeditor.FCKEditorWidget',array(
   					'name'=>$input_name,
   					'value'=>$value,
   					"height"=>$htmlOptions['height'],
    				"width"=>$htmlOptions['width'],
    				"toolbarSet"=>$htmlOptions['toobar'], # EXISTING(!) Toolbar (see: fckeditor.js)
    				"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",# Path to fckeditor.php
    				"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",# Realtive Path to the Editor (from Web-Root)
          ));
	}
	
/**
	 * 创建autocomplete
	 * @param string $input_name 输入框的名字
	 * @param string $select隐藏框的内容
	 * @param array $value 输入框内容
	 * @param array $htmlOptions 输入框附加的属性
	 * @param string $attributes_id 输入框附加的字段属性ID
	 * @return string 返回自动完成的输入框
	 * @auther lxf
	 * @since 1.0.0
	 */
	public static function createAuto($input_name,$select="",$value="",$htmlOptions=array()){
		if(empty($htmlOptions['id'])){
		    $htmlOptions['id']=	$input_name;
		}
		Yii::app()->clientScript->registerCssFile('/js/autocompleted/styles.css');
		Yii::app()->clientScript->registerScriptFile("/js/autocompleted/jquery.autocomplete-min.js");
		$return_str="";
		$real_input=self::createHidden($input_name,$select,array());
		if(empty($htmlOptions['autocomplete'])){
			$htmlOptions['autocomplete']="off";
		}

		$screen_input=self::createText("show_".$input_name,$value,array());
		$javascript_str="<script language='javascript'>
		jQuery(document).ready(function(){
		 jQuery('#show_".$input_name."').autocomplete({ 
    	  serviceUrl:'".$htmlOptions['serviceUrl']."',
    	  minChars:1, 
    	  delimiter: /(,|;)\s*/, 
    	  maxHeight:400,
    	  width:490,
    	  zIndex: 9999,
    	  deferRequestBy: 0, 
    	  noCache: true, 
    	  onSelect: function(value, data){
    	  	jQuery('#".$input_name."').val(data.id);
    	  }
    });
    })
     jQuery('#show_".$input_name."').live('keyup',function(){
     
      var this_val=jQuery(this).val();
      if(!this_val){
    	   jQuery('#".$input_name."').val('');
      }	
  	
    });
    
    </script>";
		$return_str.=$real_input.$screen_input.$javascript_str;
		return $return_str;
	}	
	
		   /**
	 * 创建autocomplete多选框
	 * @param string $model model的名字
	 * @param string $attribute model的字段
	 * @param array $data 输入框选择的值
	 * @param array $htmlOptions 输入框附加的属性
	 * @return string 返回时间输入框
	 * @auther lxf
	 * @since 1.0.0
	 */
	public static function createMultiauto($input_name,$select="",$value="",$htmlOptions=array()){

		if(empty($htmlOptions['id'])){
		    $htmlOptions['id']=	$input_name;
		}
		Yii::app()->clientScript->registerCssFile('/js/autocompleted/styles.css');
		Yii::app()->clientScript->registerScriptFile("/js/autocompleted/jquery.autocomplete-min.js");
		$return_str="";
		if(empty($htmlOptions['autocomplete'])){
			$htmlOptions['autocomplete']="off";
		}
		$screen_input=self::createText("show_".$input_name,'',array())."<div id='show_auto_".$htmlOptions['id']."' class='multiselector'>".$value."</div>";
		$javascript_str="<script language='javascript'>
		jQuery(document).ready(function(){
		 jQuery('#show_".$input_name."').autocomplete({ 
    	  serviceUrl:'".$htmlOptions['serviceUrl']."',
    	  minChars:1, 
    	  delimiter: /(,|;)\s*/, 
    	  maxHeight:400,
    	  width:490,
    	  zIndex: 9999,
    	  deferRequestBy: 0, 
    	  noCache: true, 
    	  onSelect: function(value, data){
    	  	var item=\"<div class='multiname'><a href='javascript:void();' onclick='javascript:this.parentNode.parentNode.removeChild(this.parentNode);'>\"+data.name+\"</a><input type='hidden' id='' name='".$input_name."[]' value='\"+data.id+\"'/></div>\";
    	  	var show_auto_obj=jQuery('#show_auto_".$htmlOptions['id']."');
    	  	show_auto_obj.html(show_auto_obj.html()+item);
    	  	
    	  }
    });
    })
    </script>";
		$return_str.=$screen_input.$javascript_str;
		return $return_str;
		
	}
	
	
			   /**
	 * 创建autocomplete多选框
	 * @param string $model model的名字
	 * @param string $attribute model的字段
	 * @param array $data 输入框选择的值
	 * @param array $htmlOptions 输入框附加的属性
	 * @return string 返回时间输入框
	 * @auther lxf
	 * @since 1.0.0
	 */
	public static function createAjaxselect($input_name,$value,$htmlOptions=array()){

  	Yii::app()->clientScript->registerScriptFile('/js/jQuery.selectbox.js');	
  	Yii::app()->clientScript->registerCssFile('/js/autocompleted/styles.css');
  	Yii::app()->clientScript->registerScriptFile("/js/autocompleted/jquery.autocomplete-min.js");
  	$hidden_htmlOptions=array();
  	if(empty($htmlOptions['id'])){
  		$hidden_htmlOptions['id']=$input_name."_condition";
  	}else{
  		$hidden_htmlOptions['id']=$htmlOptions['id'];
  	}

  	if(empty($htmlOptions['type_value'])){
  		$htmlOptions['type_value']="region";
  	}
  	
  	
		$return_str="";
		$return_str.=self::createHidden($input_name,$value,$hidden_htmlOptions);
		$return_str.=self::createHidden($input_name."_type",$htmlOptions['type_value'],array('id'=>$input_name."_type"));
		
		$return_str.=self::createText($input_name."_text",$htmlOptions['text_value'],array('id'=>$input_name."_text"));
		$javascript_str='<script language="javascript">jQuery(function(){jQuery("#'.$input_name.'_text").selectBox({
	 	  "type":"'.$input_name.'_type",
	 	  "hidden":"'.$hidden_htmlOptions['id'].'",
	 	  "title":"'.$htmlOptions['title'].'",
	 	  "tabs":'.$htmlOptions['tabs'].',
	 	  "serviceUrl":"'.$htmlOptions['serviceUrl'].'",';
	 	if($htmlOptions['multi']){
	 		$javascript_str.='"multi":true,';
	 	}else{
	 		$javascript_str.='"multi":false,';
	 	}
	 	  $javascript_str.='"level":'.$htmlOptions['level'].'});
	 	  
	 	  jQuery("#'.$input_name.'_text").bind("blur",function(){
	 	  var type_value=jQuery("#'.$hidden_htmlOptions['id'].'").val();
	 	  if(!type_value){
	 	     jQuery(this).val("");
	 	     jQuery("#'.$hidden_htmlOptions['id'].'").val("");
	 	     jQuery("#'.$input_name.'_type").val("");
	 	     
	 	  }
	 	
	 	});
	 	
	 		jQuery("#'.$input_name.'_text").live("keyup",function(){
      var this_val=jQuery(this).val();
      if(!this_val){
    	   jQuery(this).val("");
	 	     jQuery("#'.$hidden_htmlOptions['id'].'").val("");
	 	     jQuery("#'.$input_name.'_type").val("");
      }	
    });
    
    
	 	  
	 	  });</script>';

		$return_str.=$javascript_str;
		return $return_str;
	}	
	
	
	/**
	 * 创建各种类型的输入框
	 * @param string $type 输入框的类型
	 * @param string $input_name 输入框的名字
	 * @param string $select 输入框的选择项
	 * @param array $value 输入框选择的数组
	 * @param array $htmlOptions 输入框附加的属性
	 * @param string $attributes_id 输入框附加的字段属性ID
	 * @return string 根据$type类型返回一个合适输入框
	 * @auther lxf
	 * @since 1.0.0
	 */
	public static function selectCreate($type,$input_name,$select="",$value,$htmlOptions=array()){

		$select_function="create".ucfirst($type);
		if(empty($value)&&($type!='auto')&&($type!='multiauto')){
			return self::$select_function($input_name,$select,$htmlOptions);
		}else{
			return self::$select_function($input_name,$select,$value,$htmlOptions);
		}
		
	}
}
?>
