<?php
class WVot extends CWidget
{   
	  public $pattern="";
	  public $id="";
	  public $view="";
    public function run(){
    	  //初始化页面需要的全局变量
      	if(empty($this->pattern)){
    			$this->pattern="archives";
    		}
       $this->render("/wvot/".$this->view,array('pattern'=>$this->pattern,'id'=>$this->id,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
    }    
}
