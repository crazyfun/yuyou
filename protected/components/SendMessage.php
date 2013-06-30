<?php
class SendMessage{
	private  $type='3';
	protected $message_class="";
	protected $id="";
  function __Construct($id=""){
  	$this->id=$id;
  }
  private function _init_message(){
     $this->message_class=new SMS();
  }
  
  //发送会员升级邮件
 public function send_message($id="",$cellphone,$content_array){
 	if(empty($cellphone))
		 return;
	$this->id=empty($id)?$this->id:$id;
	$this->_init_message();
	$content_array['time']=date('Y-m-d H:i:s');
	$content=$this->replace_variable($content_array);
  $content['content']=ltrim($content['content'],"<p>");
  $content['content']=rtrim($content['content'],"</p>");
	$result=$this->message_class->send($cellphone,mb_convert_encoding($content['content'],"gb2312","UTF-8"));
	return $result;
}
 
  //用邮件模板替换
 public function replace_variable($content_array){
 	 $template_data=$this->get_templates_contents();
	 $content=$template_data->templates_content;
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
 	 return array('content'=>$content_content);
 	
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
