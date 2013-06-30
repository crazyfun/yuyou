<?php

class ConsumeTemp{
  private $type='2';
	protected $id="";

  function __Construct($id=""){
  	$this->id=$id;    	
  }
 
 
 function consume($id="",$user_id,$type,$value,$replace_array){
 	 if(!empty($id)){
 	 	  $this->id=$id;
 	 }
 
 	  $coupon_resume=CouponResume::model();
 	 	$user=User::model();
		$user_data=$user->findByPk($user_id);
			 
		switch($type){
			case '1':
			  $user_data->conpon=$user_data->conpon+$value;
			  $result=$user_data->save();
			  if($result){
			  	$coupon_resume->id=null;
			  	$coupon_resume->setIsNewRecord(true);
			  	$coupon_resume->user_id=$user_id;
			  	$coupon_resume->type=$type;
			  	$coupon_resume->value=$value;
			  	$coupon_resume->remain=$user_data->conpon;
			  	$coupon_resume->comment=$this->replace_variable($replace_array);
			  	$coupon_resume->insert_datas();
			  }
			  
			  break;
			case '2':
			  $user_data->conpon=$user_data->conpon-$value;
			  $result=$user_data->save();
			  if($result){
			  	$coupon_resume->id=null;
			  	$coupon_resume->setIsNewRecord(true);
			  	$coupon_resume->user_id=$user_id;
			  	$coupon_resume->type=$type;
			  	$coupon_resume->value=$value;
			  	$coupon_resume->remain=$user_data->conpon;
			  	$coupon_resume->comment=$this->replace_variable($replace_array);
			  	$coupon_resume->insert_datas();
			  }
			  break;
			default:
			  break;
		}
		
 }
 
 //用模板替换
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
 	 return $content_content;
 }
 //获得模板
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
