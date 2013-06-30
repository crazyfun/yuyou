<?php
/**
 * 邮件发送
 */
class SMS{
	private $pcurl = null;
	private $user = null;
	private $passwd = null;
	private $sms_api_url = 'http://www.smsadmin.cn/smsmarketing/wwwroot/api/';
	
	public function __construct($user=null, $passwd=null){
		$config = Yii::app()->getParams();
		$this->user = is_null($user)?$config['phone_name']:$user;
		$this->passwd = is_null($passwd)?$config['phone_password']:$passwd;
		$this->pcurl = curl_init();
		curl_setopt($this->pcurl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($this->pcurl, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($this->pcurl, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($this->pcurl, CURLOPT_AUTOREFERER, true);
		//curl_setopt($this->pcurl, CURLOPT_FOLLOWLOCATION, 1 );
		curl_setopt($this->pcurl, CURLOPT_POST, 0);
	}
	
	public function send($phoneCode, $massage){
  
		$url = $this->sms_api_url.'get_send';
		$params = array('mobile'=>$phoneCode, 'msg'=>$massage);
		$callstr = $this->getNvpStr($params);
		return $this->sendRequest($url, $callstr);
	}
	
	
	private function getNvpStr($params){
		$nvpStr = '';
		$params = array_merge(array('uid'=>$this->user, 'pwd'=>$this->passwd), $params);
		
		foreach($params as $key=>$value){
			if(is_string($value))
				$value = urlencode($value);
			$nvpStr .= "&{$key}=" . $value;
		}
		return $nvpStr;
	}
	
	private function sendRequest($url, $nvpreq){
		curl_setopt($this->pcurl, CURLOPT_URL,$url.'?'.$nvpreq);
		//curl_setopt($this->pcurl,CURLOPT_POSTFIELDS,$nvpreq);
		
		//getting response from server
		$response = curl_exec($this->pcurl);
		return $response;
	}
}