<?php
/** 
* @file class.tomHttp.php
* 获得tom邮箱通讯录列表
* @author jvones<jvones@gmail.com>
* @date 2009-09-26
**/
define("COOKIEJAR", tempnam("./tmp", "t1_"));

class tomHttp
{

	public function checklogin($username, $password)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://login.mail.tom.com/cgi/login");
		curl_setopt($ch, CURLOPT_USERAGENT, USERAGENT);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIEJAR);
		curl_setopt($ch, CURLOPT_TIMEOUT, TIMEOUT);
		$fileds = "user=".$username."&pass={$password}";
		$fileds .= "&style=0&verifycookie";
		$fileds .= "&type=0&url=http://bjweb.mail.tom.com/cgi/login2";
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fileds);
		ob_start();
		curl_exec($ch);
		$result = ob_get_contents();
		ob_end_clean();
		curl_close($ch);
		/*if (preg_match("/warning|", $result))
		{
			return 0;
		}*/
		return 1;
	}

	public function getAddressList($username, $password)
	{
		if (!$this->checklogin($username, $password))
		{
			return 0;
		}
		$this->_readcookies(COOKIEJAR, $res);
		if ($res['Coremail'] == "")
		{
			return 0;
		}
		$sid = substr(trim($res['Coremail']), -16);
		$url = "http://bjapp2.mail.tom.com/cgi/ldvcapp";
		$url .= "?funcid=address&sid=".$sid."&showlist=all&listnum=0";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, USERAGENT);
		curl_setopt($ch, CURLOPT_TIMEOUT, TIMEOUT);
		curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIEJAR);
		ob_start();
		curl_exec($ch);
		$res = ob_get_contents();
		ob_end_clean();
		curl_close($ch);
		//file_put_contents('./res.txt',$res);
		$pattern = "/([\\w_-])+@([\\w])+([\\w.]+)/";
		if (preg_match_all($pattern, $res, $tmpres, PREG_PATTERN_ORDER))
		{
			$result = array_unique($tmpres[0]);
		}
		return $result;
	}
	
	public function _readcookies( $file, &$result )
	{
		$fp = fopen( $file, "r" );
		while ( !feof( $fp ) )
		{
			$buffer = fgets( $fp, 4096 );
			$tmp = split( "\t", $buffer );
			$result[trim( $tmp[5] )] = trim( $tmp[6] );
		}
		return 1;
	}
}

?>