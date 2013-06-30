<?php
class WebComment extends CWidget
{
	   public $model_id="";
	   public $user_flag="";
	   public $content_id="";
	   public $input_type="";
	   public $level="";
     public function run(){
    	 	$this->render("web_comment",array('model_id'=>$this->model_id,'user_flag'=>$this->user_flag,'input_type'=>$this->input_type,'content_id'=>$this->content_id,'level'=>$this->level));
    }
  
}
