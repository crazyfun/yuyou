<?php

class SendMail{
	private $type='1';
	protected $mail_template="";
	protected $phpMail="";
	protected $id="";
	protected $email_layout="";
	protected $controller="";
  function __Construct($id=""){
  	$this->mail_template=new EmailTemplates();
  	$this->phpMail=new PhpMail("HTML",'');
  	$this->id=$id;    	
  	$this->email_layout="email/main";
  	$this->controller=new Controller("email");
  	$this->controller->layout=$this->email_layout;
  }
  private function _init_mail(){
  	$sys_config=SysConfig::model();
		$all_sys_config=$sys_config->get_all_syscfg();
		$this->phpMail->Username = $all_sys_config['sfc_mail_user'];
		$this->phpMail->Password = $all_sys_config['sfc_mail_psw'];
		$this->phpMail->Host = $all_sys_config['sfc_mail_host'];
		$this->phpMail->Port = $all_sys_config['sfc_mail_port'];
		$this->phpMail->CharSet = 'UTF-8';
  }
  
  //设置layout
  public function set_layout($layout=""){
  	if(!empty($layout)){
  		$this->email_layout=$layout;
  		$this->controller->layout=$this->email_layout;
  	}
  }
 
 
  //发送会员升级邮件
 public function send_mail($id="",$email,$content_array,$title_array=array()){
 	if(empty($email))
		 return;
	$this->id=empty($id)?$this->id:$id;
	$this->_init_mail();
	$content_array['time']=date('Y-m-d H:i:s');
	$content=$this->replace_variable($content_array,$title_array);
	$email_content=$this->controller->render("../email/email",array('email_datas'=>$content['content']), true);
  $result=$this->phpMail->sendMail($email,$content['title'],$email_content);
	return $result;
}


 
 
  //用邮件模板替换
 public function replace_variable($content_array,$title_array){
 	 $template_data=$this->get_templates_contents();
	 $title=$template_data->templates_title;
	 $content=$template_data->templates_content;
	 if(!empty($title_array)){
	 	$title_key=array();
	 	$title_value=array();
	 	foreach((array)$title_array as $key => $value){
	 		$key_name="{"."$".$key."}";
	 		array_push($title_key,$key_name);
	 		array_push($title_value,$value);
	 	}
	 	$title_content=str_replace($title_key, $title_value, $title);
	}
	if(!empty($content_array)){
		$content_key=array();
	 	$content_value=array();
	 	foreach((array)$content_array as $key => $value){
	 		$key_name="{"."$".$key."}";
	 		array_push($content_key,$key_name);
	 		array_push($content_value,$value);
	 	}
	 	$content_content=str_replace($content_key, $content_value, $content);
	}
 	 return array('title'=>$title_content,'content'=>$content_content);
 	
 }
 //获得邮件模板
 private function get_templates_contents(){
 	 if(empty($this->id))
 	    return;
 	 $template=EmailTemplates::model();
 	 $template_data=$template->find('id=:id AND type=:type',array(':id'=>$this->id,':type'=>$this->type));
   return $template_data;
 }
 
 

 public function get_id(){
 	return $this->id;
 }
 public function set_id($id){
 	 $this->id=$id;
 }
     /* 取得变量的名字 */
 public function getVarName(&$variable){ 
     $save = $variable; 
     $allvar = $GLOBALS;
     foreach($allvar as $k=>$v) {
       if ($variable == $v) { 
          if ($variable == $GLOBALS[$k]) {
          	//还原变量值
            $variable = $save;
            return $k;
        }
     }
   }
 }

}


?>
