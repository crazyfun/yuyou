<?php 
define("TOKENKEY","eGZqc234~&*(");
class Token{ 
//得到当前所有的token 
public static function getTokens(){ 
	
	$tokens = $_SESSION[TOKENKEY]; 
	if (empty($tokens) && !is_array($tokens)) { 
		$tokens = array(); 
	} 
	return $tokens; 
} 
// 产生一个新的Token 
public static function granteToken($formName,$key = TOKENKEY ){ 
	Yii::app ()->session->init();
	$token = self::encrypt($formName.":".session_id(),$key); 
	return $token; 
} 

//删除token,实际是向session 的一个数组里加入一个元素，说明这个token以经使用过，以避免数据重复提交。 
public static function dropToken($token){ 
	$tokens = self::getTokens(); 
	$tokens[] = $token; 
	Yii::app()->session->add(TOKENKEY ,$tokens); 
} 

//检查是否为指定的Token 
public static function isToken($token,$formName,$fromCheck = false,$key = TOKENKEY){ 
	$tokens = self::getTokens();
	if (in_array($token,$tokens)) //如果存在，说明是以使用过的token 
		return false; 
	$source = explode(":", self::decrypt($token,$key)); 
	if($fromCheck) 
		return $source[1] == session_id() && $source[0] == $formName; 
	else 
		return $source[0] == $formName;
  
 
} 

//加密token
protected static function keyED($txt,$encrypt_key){ 
		$encrypt_key = md5($encrypt_key); 
		$ctr=0; 
		$tmp = ""; 
		for ($i=0;$i<strlen($txt);$i++){ 
		 if ($ctr==strlen($encrypt_key)) 
		   $ctr=0; 
		 $tmp.= substr($txt,$i,1) ^ substr($encrypt_key,$ctr,1); 
		 $ctr++; 
       } 
       return $tmp; 
} 
//加密token
public static function encrypt($txt,$key){ 
   $encrypt_key = md5(((float) date("YmdHis") + rand(10000000000000000,99999999999999999)).rand(100000,999999)); 
   $ctr=0; 
   $tmp = ""; 
   for ($i=0;$i<strlen($txt);$i++){ 
    if ($ctr==strlen($encrypt_key)) $ctr=0; 
     $tmp.= substr($encrypt_key,$ctr,1) . (substr($txt,$i,1) ^ substr($encrypt_key,$ctr,1)); 
     $ctr++; 
   } 
   return base64_encode(self::keyED($tmp,$key)); 
 } 
//反加密token
  public static function decrypt($txt,$key){ 
     $txt = self::keyED( base64_decode($txt),$key);  
     $tmp = ""; 
    for ($i=0;$i<strlen($txt);$i++){ 
      $md5 = substr($txt,$i,1); 
    $i++; 
    $tmp.= (substr($txt,$i,1) ^ $md5); 
  } 
    return $tmp; 
  } 
} 
?>