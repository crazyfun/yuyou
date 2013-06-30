<?php
class Util{
	//过滤用户提交过来的值只能过滤到三维数组
	public static function reset_vars(){
		if(!empty($_REQUEST)){
			foreach((array)$_REQUEST as $key => $value){
				self::safe_var($key);
			}
		}
	}
	public static function safe_var($var,$var2=""){
		if(strlen(strval($var2))){
			if(is_array($_REQUEST[$var][$var2])){
				foreach($_REQUEST[$var][$var2] as $key => $value){
					$_REQUEST[$var][$var2][$key]=self::encode($value);
				}
			}else{
				$_REQUEST[$var][$var2]=self::encode($_REQUEST[$var][$var2]);  
			}
		}else{
			if(is_array($_REQUEST[$var])){
				foreach((array)$_REQUEST[$var] as $key => $value){
					self::safe_var($var,$key);
				}
			}else{
				$_REQUEST[$var]=self::encode($_REQUEST[$var]);
			}
		}
	}	

	public static function encode($val){
		$return_value=trim($return_value);
		$return_value=CHtml::encode($val);
		$return_value=addSlashes($return_value);
		return $return_value;
	}
/*******************************************
	取得当前時間
********************************************/
	public static function current_time($type) {
		switch ($type) {
		  case 'mysql':
				$d = date('Y-m-d H:i:s');
			  return $d;
			  break;
		 case 'timestamp':
				$d = time();
				return $d;
			  break;
		}
	}
    //建目录函数，其中参数$directoryName最后没有"/"，
    //要是有的话，以'/'打散为数组的时候，最后将会出现一个空值
    public static function makeDirectory($directoryName) {
        $directoryName = str_replace("\\","/",$directoryName);
        $dirNames = explode('/', $directoryName);
        $total = count($dirNames) ;
        $temp = '';
        for($i=0; $i < $total; $i++) {
            $temp .= $dirNames[$i].'/';
            if (!is_dir($temp)) {
                $oldmask = umask(0);
                
                if (!mkdir($temp, 0777)) exit("不能建立目录 $temp"); 
                umask($oldmask);
            }
        }
        return true;
    }
    
    
 public static function copyDir($dirFrom,$dirTo)  
 {  
     //如果遇到同名文件无法复制，则直接退出  
     if(is_file($dirTo)){  
         echo("无法建立目录 $dirTo");  
     }  
     if(!file_exists($dirTo)){  
         self::makeDirectory($dirTo);  
     }  
    $handle = @opendir($dirFrom);    
    while (false !== ($file = @readdir($handle))) {  
		if($file == '.' || $file== '..'){
			continue;
		}
        $fileFrom = $dirFrom."/".$file;  
        $fileTo = $dirTo."/".$file;  
        if(is_dir($fileFrom)){ 
            self::copyDir($fileFrom,$fileTo);  
        } else { 
            @copy($fileFrom,$fileTo);  
        }  
    }  
 }  
    //删除文件
    public static function deleteFile($file_name,$file_path=""){
    	$file=empty($file_path)?$file_name:$file_path."/".$file_name;
    	if(is_file($file)&&file_exists($file)){
    		unlink($file);
    	}
    }
    
    
    //删除dir
    public static function deleteDir($delete_path){
    	 $handle = @opendir($delete_path);    
       while (false !== ($file = @readdir($handle))) {  
		     if($file == '.' || $file== '..'){
			      continue;
		     }
		     $file_name=$delete_path."/".$file;
		     if(is_dir($file_name)){ 
		     	  self::deleteDir($file_name);
		     }else{
		     	  self::deleteFile($file,$delete_path);
		     }
		   }
		  @chmod($delete_path, 0777);
  	  @rmdir($delete_path);
    }


    //hash内容
    public static function hc($content, $salt=null) {
        if(strlen($salt)){
            return md5 ( $salt . md5 ( $content ) );
        }else {
            return md5($content);
        }
    }

    /*-------------------------------------------
     # 产生随机字串，可用来自动生成密码
     # 默认长度6位 字母和数字混合
     # $format ALL NUMBER CHAR 字串组成格式
     */
    public static  function randStr($len = 6, $format = 'ALL') {
        switch ($format) {
        case 'ALL' :
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~';
            break;
        case 'CHAR' :
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-@#~';
            break;
        case 'NUMBER' :
            $chars = '0123456789';
            break;
        default :
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            break;
        }
        mt_srand ( ( double ) microtime () * 1000000 * getmypid () );
        $password = "";
        while ( strlen ( $password ) < $len )
            $password .= substr ( $chars, (mt_rand () % strlen ( $chars )), 1 );
        return $password;
    }
   /*
	* 创建用户的密码加密的钥匙
	* @param string $salt用户的密钥
	* @return string 返回用户密钥和网站公钥的md5值
	* @auther lxf
	* @version 1.0.0
	*/
    public static function createSalt($salt){
    	$config = Yii::app()->getParams();
    	$web_salt=$config['web_salt'];
    	return self::hc($salt,$web_salt);
    }
    //判断是否为Email
    public static function ie($user_email) {
        $chars = "/^([a-z0-9+_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,6}\$/i";
        if (strpos ( $user_email, '@' ) !== false && strpos ( $user_email, '.' ) !== false) {
            if (preg_match ( $chars, $user_email )) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    //验证号码时候是手机号码或者电话号码$phone_type:All:全部验证 cell:手机 tele:座机 tc:小灵通
    public static function is_phone($user_phone,$phone_type='All'){
    
    	switch($phone_type){
    		case 'tele':
    		    //座机验证规则
    	     $telephone=preg_match("/^(((\d{3}))|(\d{3}-))?((0\d{2,3})|0\d{2,3}-)?[1-9]\d{6,8}$/",$user_phone);
    	     if($telephone)
    	        return true;
    	     else
    	        return false;
    		   break;
    		case 'cell':
    		   //手机号码验证规则
    	    $cell_phone =preg_match("/(?:13\d{1}|1[548][01356789])\d{8}$/",$user_phone);
    	    if($cell_phone)
    	      return true;
    	    else
    	      return false;
    		   break;
    		case 'tc':
    		   	//小灵通验证规则
          	$tcphone=preg_match("/^1[3,5]\d{9}$/",$user_phone);
          	if($tcphone)
          	  return true;
          	else
          	  return false;
    		   break;
    		default:
    		   //手机号码验证规则
    	    $telephone=preg_match("/^(((\d{3}))|(\d{3}-))?((0\d{2,3})|0\d{2,3}-)?[1-9]\d{6,8}$/",$user_phone);
        	//座机验证规则
        	$cell_phone=preg_match("/(?:13\d{1}|1[548][01356789])\d{8}$/",$user_phone);
        	//小灵通验证规则
         	$tcphone=preg_match("/^1[3,5]\d{9}$/",$user_phone);
         	if($cell_phone||$telephone||$tcphone){
         		return true;
         	}else{
         		return false;
         	}
    		   break;
    	}
    
    	return true;
   }
   
   


   
 //验证邮编
 
 function validate_zip($user_zip){
 	$zip=preg_match("/^[0-9]{6}$/",$user_zip);
 	return $zip;
}
    
//验证省份证号码    
function validation_filter_id_card($id_card)
{
		if(strlen($id_card) == 18)
		{
			return self::idcard_checksum18($id_card);
		}elseif((strlen($id_card) == 15)){
			$id_card = self::idcard_15to18($id_card);
			return self::idcard_checksum18($id_card);
		}else{
			return false;
		}

	}
	// 计算身份证校验码，根据国家标准GB 11643-1999
	function idcard_verify_number($idcard_base)
	{
		if(strlen($idcard_base) != 17)
		{
			return false;
		}
		//加权因子
		$factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
		//校验码对应值
		$verify_number_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
		$checksum = 0;
		for ($i = 0; $i < strlen($idcard_base); $i++)
		{
			$checksum += substr($idcard_base, $i, 1) * $factor[$i];
		}
		$mod = $checksum % 11;
		$verify_number = $verify_number_list[$mod];
		return $verify_number;
	}
	// 将15位身份证升级到18位
	function idcard_15to18($idcard){
		if (strlen($idcard) != 15){
			return false;
		}else{
			// 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码
			if (array_search(substr($idcard, 12, 3), array('996', '997', '998', '999')) !== false){
				$idcard = substr($idcard, 0, 6) . '18'. substr($idcard, 6, 9);
			}else{
				$idcard = substr($idcard, 0, 6) . '19'. substr($idcard, 6, 9);
			}
		}
		$idcard = $idcard . self::idcard_verify_number($idcard);
		return $idcard;
	}
	// 18位身份证校验码有效性检查
	function idcard_checksum18($idcard){
		if (strlen($idcard) != 18){ return false; }
			$idcard_base = substr($idcard, 0, 17);
		if (self::idcard_verify_number($idcard_base) != strtoupper(substr($idcard, 17, 1))){
			return false;
		}else{
			return true;
		}
	} 

//截取字符串长度
function cutstr($string, $length, $havedot=false,$charset="utf-8") {
	//判断长度
	if(strlen($string) <= $length) {
		return $string;
	}
	$wordscut = '';
	if($charset == 'utf-8') {
		//utf8编码
		$n = 0;
		$tn = 0;
		$noc = 0;
		while ($n < strlen($string)) {
			$t = ord($string[$n]);
			if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
				$tn = 1;
				$n++;
				$noc++;
			} elseif(194 <= $t && $t <= 223) {
				$tn = 2;
				$n += 2;
				$noc += 2;
			} elseif(224 <= $t && $t < 239) {
				$tn = 3;
				$n += 3;
				$noc += 2;
			} elseif(240 <= $t && $t <= 247) {
				$tn = 4;
				$n += 4;
				$noc += 2;
			} elseif(248 <= $t && $t <= 251) {
				$tn = 5;
				$n += 5;
				$noc += 2;
			} elseif($t == 252 || $t == 253) {
				$tn = 6;
				$n += 6;
				$noc += 2;
			} else {
				$n++;
			}
			if ($noc >= $length) {
				break;
			}
		}
		if ($noc > $length) {
			$n -= $tn;
		}
		$wordscut = substr($string, 0, $n);
	} else {
		for($i = 0; $i < $length - 3; $i++) {
			if(ord($string[$i]) > 127) {
				$wordscut .= $string[$i].$string[$i + 1];
				$i++;
			} else {
				$wordscut .= $string[$i];
			}
		}
	}
	//省略号
	if($havedot) {
		return $wordscut.'...';
	} else {
		return $wordscut.'&nbsp;';
	}
}

	//等比例剪切图片
	public static function cut_image($width,$height,$image_path,$image_name){
		$image_name=preg_replace("|^[\/,\/\/]|i","",$image_name);
		if(!empty($image_path)){
		  $image = Yii::app()->image->load($image_path."/".$image_name);
	  }else{
	  	$image =Yii::app()->image->load($image_name);
	  	
	  }
		$image->resize($width, $height);
		$image->save(self::rename_thumb_file($width,$height,$image_path,$image_name)); 
	}


	//剪切一定宽度和高度的图片
	public static function crop_image($width,$height,$image_path,$image_name,$top = 'center', $left = 'center'){
		$image_name=preg_replace("|^[\/|\/\/]|i","",$image_name);
		if(!empty($image_path)){
		  $image = Yii::app()->image->load($image_path."/".$image_name);
	  }else{
	  	$image =Yii::app()->image->load($image_name);
	  	
	  }
		$image->crop($width, $height, $top, $left);
		$image->save(self::rename_thumb_file($width,$height,$image_path,$image_name)); 
	}

	//重命名文件名
	public static function  rename_file($file_name){
		if(empty($file_name))
			return;
		$explode_array=explode(".",$file_name);
		$implode_array=array();
		array_push($implode_array,time());
		array_push($implode_array,end($explode_array));
		return implode('.',$implode_array);
	}
	
	//重命名剪切的图片
	public static function rename_thumb_file($width,$height,$file_path,$file_name){
		if(empty($file_path)){
		   $file_explode=explode("/",$file_name);
		   $file_name=array_pop($file_explode);
		   $file_path=implode("/",$file_explode)."/";
		}else{
			$file_path.="/";
		}
		$explode_array=explode(".",$file_name);
		$implode_array=array();
		$thumb_name=$file_path."_".$width."_".$height."_".$explode_array[0]."_thumb";
		array_push($implode_array,$thumb_name);
		array_push($implode_array,end($explode_array));
		return implode('.',$implode_array);
	}

	//获取客户端的IP
	 public static function getIp(){
		if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
			$ip = getenv("HTTP_CLIENT_IP");
		else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
			$ip = getenv("REMOTE_ADDR");
		else if (strlen($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
			$ip = $_SERVER['REMOTE_ADDR'];
		else
			$ip = "unknown";
		return($ip);
	} 
	
	 /*
	 * 组合json数据
	 * @param int $result 1:操作成功,2:操作失败
	 * @param array $datas 1:附带返回的数据
	 * @param string $message 1:附带返回的的信息
	 * @return string 返回一个json数据的字符串
	 * @auther lxf
	 * @version 1.0.0
	 */
	 public static function combo_ajax_message($result,$datas,$message){
	 	 $json_array=array();
	 	 $json_array['flag']=$result;
	 	 $json_array['datas']=$datas;
	 	 $json_array['message']=$message;
	 	 
	 	 return json_encode($json_array);
	 }
	 
	 /*
	 * 组合搜索的select值
	 * @param array $com_array 组合的array
	 * @param array $sour_array 源array
	 * @return array 返回一个组合后的array
	 * @auther lxf
	 * @version 1.0.0
	 */
	public static function com_search_item($com_array,$sour_array){
		  $return_array=array();
		  foreach($com_array as $key => $value){
		  	$return_array[$key]=$value;
		  }
		  foreach($sour_array as $key => $value){
		  	$return_array[$key]=$value;
		  }
		  return $return_array;
	}

	/*
	 * 移除用户的角色和角色的 item
	 * @param int $permissions_id 角色id
	 * @auther lxf
	 * @version 1.0.0
	 */
	public static function remove_auth($permissions_id){
		$model=new Permissions();
		$user=new User();
		$model_values=$model->get_table_datas($permissions_id);
    $permissions_name=$model_values->permissions_name;
    $user_datas=$user->findAll(array('select'=>'id','condition'=>"FIND_IN_SET('".$permissions_id."',permissions)>0",'params'=>array()));
		$auth=Yii::app()->authManager;
		$item_children=$auth->getItemChildren($permissions_name);
		foreach($item_children as $key => $value){
			
			$auth->removeItemChild($permissions_name,$value->name);
		}
		$auth->removeAuthItem($permissions_name);
		foreach($user_datas as $key => $value){
			$auth->revoke($permissions_name,$value->id);
		}
	}
	
	/*
	 * 验证内容是否填写正确 验证类型有：cell_phone 手机号码  tele_phone 座机号码  tc_phone小灵通    code_id身份证号码验证   zip 邮政编码验证 email 邮箱验证
	 * @param array $datas 验证的数组array(array('name'=>'user_phone','value'=>$_POST['user_phone@202'],'type'=>'cell_phone'),array('name'=>'user_codeid','value'=>$_POST['user_codeid@203'],'type'=>'code_id'));
	 * @return array 返回一个验证规则的数组
	 * @auther lxf
	 * @version 1.0.0
	 */
	public static function validate_datas($datas){
		if(empty($datas)){
			return;
		}
		$return_errors=array();
		foreach($datas as $key => $content){
			
			$value=$content['value'];
			$name=$content['name'];
			if(empty($value)){
				continue;
			}
			$type=$content['type'];
			switch($type){
				case 'cell_phone':
				   $flag=self::is_phone($value,'cell');
				   if(!$flag){
				   	$return_errors[$name]="手机号码格式不正确";
				   }
				  break;
			  case 'tele_phone':
			    $flag=self::is_phone($value,'tele');
				   if(!$flag){
				   	$return_errors[$name]="电话号码格式不正确";
				   }
			    break;
			   case 'tc_phone':
			    $flag=self::is_phone($value,'tc');
				   if(!$flag){
				   	$return_errors[$name]="小灵通格式不正确";
				   }
			    break;
			    case 'code_id':
			    $flag=self::validation_filter_id_card($value);
				   if(!$flag){
				   	$return_errors[$name]="身份证号码格式不正确";
				   }
			    break;
			    case 'zip':
			    $flag=self::validate_zip($value);
				   if(!$flag){
				   	$return_errors[$name]="邮政编码格式不正确";
				   }
			    break;
			    case 'email':
			    $flag=self::ie($value);
				   if(!$flag){
				   	$return_errors[$name]="邮箱格式不正确";
				   }
			    break;
			  default:
			    break;
			}
		}
		
		return $return_errors;
	}
	
	/*
	 * 上传一个图片
	 * @param string $file_name 图片名称
	 * @param string $file_dir 上传图片的路径
	 * @param array $thumb 切割图片的尺寸"400*300,200*200"
	 * @return array 上传后的图片的路径
	 * @auther lxf
	 * @version 1.0.0
	 */
	public static function UploadFile($file_name,$file_dir,$thumb=""){
		  if(!empty($_FILES[$file_name]['name'])){
		   $upload_file=CUploadedFile::getInstancesByName($file_name);
		   $upload_file=$upload_file[0];
			 if(!is_dir($file_dir)){
			 	  self::makeDirectory($file_dir);
			 }
			 $image_name=self::rename_file($upload_file->name);
			 $upload_dir=$file_dir."/".$image_name;
			 if($upload_file!=null){
			   $result=$upload_file->saveAs($upload_dir);
			 }
			if($result){
				if(!empty($thumb)){
					$thumb_explode=explode(",",$thumb);
					foreach($thumb_explode as $key => $value){
						$size_thumb=explode("*",$value);
						$width=$size_thumb[0];
						$height=$size_thumb[1];
						self::cut_image($width,$height,$file_dir,$image_name);
					}
				}
			  return $upload_dir; 	
			}else{
				return null;
			}
		}else{
			return null;
		}				
						
	}

	
/*
	 * 将数组转换为字符串
	 * @param string $array 需要转换的数组
	 * @return int $level 转换的层级
	 * @return string 转换后的字符串
	 * @auther lxf
	 * @version 1.0.0
	 */
public static function  arrayeval($array, $level = 0) {
	$space = '';
	$evaluate = "Array $space(";
	$comma = $space;
	foreach($array as $key => $val) {
		$key = is_string($key) ? '\''.addcslashes($key, '\'\\').'\'' : $key;
		$val = !is_array($val) && (!preg_match("/^\-?\d+$/", $val) || strlen($val) > 12) ? '\''.addcslashes($val, '\'\\').'\'' : $val;
		if(is_array($val)) {
			$evaluate .= "$comma$key => ".arrayeval($val, $level + 1);
		} else {
			$evaluate .= "$comma$key => $val";
		}
		$comma = ",$space";
	}
	$evaluate .= "$space)";
	return $evaluate;
}


/*
	 * 将数组转换为url字符串
	 * @param string $array 需要转换的数组
	 * @return string 转换后的字符串
	 * @auther lxf
	 * @version 1.0.0
	 */
public static function  implode_arrayeval($array) {
	if(empty($array)){
		return NULL;
	}
	$return_str="";
	foreach($array as $key => $value){
		if(is_array($value)){
			if(empty($return_str)){
			    $return_str.=self::implode_arrayeval($value);
			}else{
				  $return_str.="&".self::implode_arrayeval($value);
			}
		}else{
		 if(empty($return_str)){
			 $return_str.=strval($key)."=".strval($value);
		 }else{
			$return_str.="&".strval($key)."=".strval($value);
		 }
		}
	}
	return $return_str;
}


/*
	 * 移除数组中的特定的值
	 * @param array $array 数组
	 * @param string $val 特定的值
	 * @param string $replace 替换的值
	 * @return array 移除或替换后的array
	 * @auther lxf
	 * @version 1.0.0
	 */
public static function splice_array($array,$val,$replace='') {
	if(empty($array)||empty($val)){
  	return;	
	}
	$return_array=array();
	
	foreach($array as $key => $value){
		if($value==$val){
			if(!empty($replace)){
				$return_array[$key]=$replace;
			}
		}else{
			$return_array[$key]=$value;
		}
	}
	
	return $return_array;
}


/*
	 * 判断用户是否登录了
	 * @params int $user_id检测是否与当前用户登录相同 
	 * @return flag 登录了返回true  或者返回false
	 * @auther lxf
	 * @version 1.0.0
	 */
public static function check_user($user_id=""){
	$login_user_id=Yii::app()->user->id;
	if(!empty($user_id)){
		if($login_user_id==$user_id){
			return true;
		}else{
			return false;
		}
	}else{
		if($login_user_id){
			return true;
		}else{
			return false;
		}
		
	}
}

public static function check_filter_ip(){
	$ip=self::getIp();
	$sys_config=new SysConfig();
	$sys_config_datas=$sys_config->get_syscfg_val("sfc_filter_ip");
	$sfc_filter_ip=$sys_config_datas['sfc_filter_ip'];
	if(!empty($sfc_filter_ip)){
		$sfc_filter_ip_arr=explode(",",$sfc_filter_ip);
		foreach($sfc_filter_ip_arr as $key => $value){
			$preg_ip_str=str_replace(array("*",'.'), array("(\d*){1,3}","\."),$value);
			$ip_preg="/^".$preg_ip_str."$/i";
			if(preg_match($ip_preg,$ip)){
				return true;
			}else{
				continue;
			}
		}
		return false;
	}else{
		return false;
	}
	
}
	
	
 public static function diff_days($max_time,$current_time="",$elaps='d'){
    	  $current_time=!empty($current_time)?$current_time:time();
    	  $__DAYS_PER_WEEK__       = (7);
        $__DAYS_PER_MONTH__       = (30);
        $__DAYS_PER_YEAR__       = (365);
        $__HOURS_IN_A_DAY__      = (24);
        $__MINUTES_IN_A_DAY__    = (1440);
        $__SECONDS_IN_A_DAY__    = (86400);
        //计算天数差
        $__DAYSELAPS = ($max_time - $current_time) / $__SECONDS_IN_A_DAY__ ;
        switch ($elaps) {
            case "y"://转换成年
                $__DAYSELAPS =  $__DAYSELAPS / $__DAYS_PER_YEAR__;
                break;
            case "M"://转换成月
                $__DAYSELAPS =  $__DAYSELAPS / $__DAYS_PER_MONTH__;
                break;
            case "w"://转换成星期
                $__DAYSELAPS =  $__DAYSELAPS / $__DAYS_PER_WEEK__;
                break;
            case "h"://转换成小时
                $__DAYSELAPS =  $__DAYSELAPS * $__HOURS_IN_A_DAY__;
                break;
            case "m"://转换成分钟
                $__DAYSELAPS =  $__DAYSELAPS * $__MINUTES_IN_A_DAY__;
                break;
            case "s"://转换成秒
                $__DAYSELAPS =  $__DAYSELAPS * $__SECONDS_IN_A_DAY__;
                break;
        }
       return ceil($__DAYSELAPS);
    }
    
public static function format_diff_day($max_time,$current_time="",$precision='d'){
    	 $current_time=!empty($current_time)?$current_time:time();
    	 $_diff = array('y'=>'年','M'=>'个月','d'=>'天','w'=>'周','s'=>'秒','h'=>'小时','m'=>'分钟');
    	 return self::diff_days($max_time,$current_time).$_diff[$precision].'前';
}
    
    //判断用户是否拥有权限
	public static function is_permission($itemname,$item,$controller=""){
		$auth=Yii::app()->authManager;
		$controller_id=empty($controller)?Yii::app()->getController()->getId():$controller;
    $access_operation=ucfirst($controller_id).ucfirst($item);
    $hasitemchild=false;
    foreach((array)$itemname as $key => $value){
    	if($auth->hasItemChild($value,$access_operation)){
    		$hasitemchild=true;
    		break;
    	}
    }
		return $hasitemchild;
	}
	
	
	/**
 * 创建像这样的查询: "IN('a','b')";
 *
 * @access   public
 * @param    mix      $item_list      列表数组或字符串,如果为字符串时,字符串只接受数字串
 * @param    string   $field_name     字段名称
 * @author   wj
 *
 * @return   void
 */
public static function db_create_in($item_list, $field_name = '')
{
    if (empty($item_list))
    {
        return $field_name . " IN ('') ";
    }
    else
    {
        if (!is_array($item_list))
        {
            $item_list = explode(',', $item_list);
            foreach ($item_list as $k=>$v)
            {
                $item_list[$k] = intval($v);
            }
        }

        $item_list = array_unique($item_list);
        $item_list_tmp = '';
        foreach ($item_list AS $item)
        {
            if ($item !== '')
            {
                $item_list_tmp .= $item_list_tmp ? ",'$item'" : "'$item'";
            }
        }
        if (empty($item_list_tmp))
        {
            return $field_name . " IN ('') ";
        }
        else
        {
            return $field_name . ' IN (' . $item_list_tmp . ') ';
        }
    }
  }

  public static function br2nl($message){
  	$message = str_replace("<br />","",$message);
  	$message = str_replace("<br/>","",$message);
  	$message = str_replace("<BR/>","",$message);
  	$message = str_replace("<BR />","",$message);
  	$message = str_replace("<bR />","",$message);
  	$message = str_replace("<bR/>","",$message);
  	$message = str_replace("<Br/>","",$message);
  	$message = str_replace("<Br />","",$message);
		return $message;
}

public static function httpdownloadimages($content,$savepath="",$http=false,$first=false){
  	 if(!empty($content))
		 {
		 	  if(empty($savepath)){
		 	  	$savepath="upload/temp";
		 	  }

				$img_array = array();
				$img_upload_array=array();
				preg_match_all("/(src|SRC)=[\"|'| ]{0,}(([^\",^\'].*)\.(gif|jpg|jpeg|bmp|png))/isU",$content,$img_array);
				$img_array = array_unique($img_array[2]);
				set_time_limit(0);
				$milliSecond = time();
				if(!is_dir($savepath)) self::makeDirectory($savepath);
				if($first){
					$first_image="";
				}
				foreach($img_array as $key =>$value)
				{
					if(preg_match("|^(http:\/\/(www\.)?)|i",$value)){
						if($http){
							$value = trim($value);
							$get_file = @file_get_contents($value);
							$rndFileName = $savepath."/".$milliSecond.".".substr($value,-3,3);
							if($get_file)
							{
								$fp = @fopen($rndFileName,"x+");
								@fwrite($fp,$get_file);
								@fclose($fp);
							}
							if($first&&$key==0){
							
								$first_image=$rndFileName;
							}
							$content = ereg_replace($value,"/".$rndFileName,$content);
					 }
					}else{
						if($first&&$key==0){
							$first_image=ltrim($value,"/");
						}
					}    
				}	
				return array('content'=>$content,'image'=>$first_image);
			}else{
				return null;
			}
  }
 public static function get_payment($code,$company_id=0)
{
	$model=Payment::model();
    $payment=$model->find("pay_code=:pay_code AND enabled = :enabled  AND company_id=:company_id",array('pay_code'=>$code,':enabled'=>'2',':company_id'=>$company_id));
    $return_payment=array();
    if ($payment)
    {
        $config_list = unserialize($payment->pay_config);

        foreach ($config_list AS $config)
        {
            $return_payment[$config['name']] = $config['value'];
        }
    }
    return $return_payment;
} 
  
  //去掉文件的扩展 取得文件的名称
  public static function get_file_name($file_path){
  	$file_path=str_replace("//","/",$file_path);
  	$tem_file_path=explode("/",$file_path);
  	$file=end($tem_file_path);
  	$tem_file=explode(".",$file);
  	return $tem_file[0];
  }
  
  public static function view_permission($permission){
  	
  	switch($permission){
  		case '2':
  		  $user_id=Yii::app()->user->id;
  		  if(empty($user_id)){
  		  	Yii::app()->getController()->redirect("login/index");
  		  }else{
  		  	return true;
  		  }
  		  break;
  		default:
  		  return true;
  		  break;
  	}
  }
public static function curPageURL()
{
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on")
    {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80")
    {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    }
    else
    {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

function get_discount($price,$o_price){
	$diff_num=$price/$o_price;
	$discount=$diff_num*10;
	return substr(strval($discount),0,3);
	
}


 
}



?>
