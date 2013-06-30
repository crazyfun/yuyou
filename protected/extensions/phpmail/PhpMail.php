<?php
class PhpMail{
    public $type="";//发送内容
    private $_phpmailer="";//classphpmailer
    public $Username="";//用户
    public $Password="";//密码
    public $Host="";//host
    public $Port="";//port
    public $CharSet="UTF-8";//encode
    //初始化类
    function __Construct($type="",$pluginDir=""){	
    	$this->type=empty($type)?"HTML":$type;
    	$this->_phpmailer=new PHPMailer();
    	$this->setPluginDir("");
			$this->_phpmailer->ClearAddresses();
			$this->_phpmailer->ClearAllRecipients();
			$this->_phpmailer->ClearAttachments();
			$this->_phpmailer->ClearBCCs();
			$this->_phpmailer->ClearCCs();
			$this->_phpmailer->ClearCustomHeaders();
			$this->_phpmailer->ClearReplyTos();
			$this->setSleep("");
			$this->_phpmailer->IsSMTP();
			$this->setHtml("");
			$this->_phpmailer->SMTPAuth = true;
    }
    //初始化mail类
    public function init_phpmailer(){
				$this->_phpmailer->Username = $this->Username;
				$this->_phpmailer->Password = $this->Password;
				$this->_phpmailer->From = $this->Username;
				$this->_phpmailer->FromName = "易途旅游网";//$this->Username;
				$this->_phpmailer->Host = $this->Host;
				$this->_phpmailer->Port = $this->Port;
				$this->_phpmailer->CharSet = $this->CharSet;
    }
    //发送邮件
    public function sendMail($email,$subject,$content){
    	$this->init_phpmailer();
    	$this->_phpmailer->Subject=$subject;
			$this->_phpmailer->Body = $content;
			$this->_phpmailer->AddAddress($email, '');
			$result = $this->_phpmailer->Send();
			return $result;
    }
    //发送render出来的内容的邮件
    public function sendRender($email,$subject,$path="",$view,$params=array()){
    	$content=Yii::app()->getController()->render($path.$view,$params,true);
    	$this->sendMail($email,$subject,$content);
    }
    //发送数据库里面的内容
    public function sendDatabase($email,$subject,$content,$params){
    	$content=$this->_replace_variable($content,$params);
    	$this->sendMail($email,$subject,$content);
    }
//增加密送邮件
    public function AddBCC($bcc_email="",$tag=""){
    	$this->_phpmailer->AddBCC($bcc_email,$tag);
    }
    //增加附件
    public function AddAttachment($path, $name = '', $encoding = 'base64', $type = 'application/octet-stream'){
    	$this->_phpmailer->AddAttachment($path,$name,$encoding,$type);
    }
    //设置间隔时间
    public function setSleep($timeout=""){
    	$this->_phpmailer->sleep_time=empty($timeout)?10:$timeout;
    }
    //设置插件的路径
    public function setPluginDir($pluginDir){
    	$this->_phpmailer->pluginDir=empty($pluginDir)?"extensions/phpmail/":$pluginDir;
    }
 //设置发送内容
    public function setHtml($type){
    	 if(!empty($type))
    	     $this->type=$type;
    		if($this->type=="TEXT"){
				   $this->_phpmailer->IsHTML(false);
				}else{
					$this->_phpmailer->IsHTML(true);
				}
    }
   //用邮件模板替换
  private function _replace_variable($content,$replace_array){
	 $replace_key=array();
	 $replace_value=array();
	 foreach((array)$replace_array as $key => $value){
	 	$key_name="{{"."$".$key."}}";
	 	array_push($replace_key,$key_name);
	 	array_push($replace_value,$value);
	 }
 	 $content=str_replace($replace_key, $replace_value, $content);
 	 return $content;
 }
 //魔术方法
    public function _set($key,$value){
    	$this->$key=$value;
    }
    public function _get($key){
    	return $this->$key;
    }

  }




?>
