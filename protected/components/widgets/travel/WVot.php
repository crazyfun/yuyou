<?php
class WVot extends CWidget
{   
	  public $pattern="";
	  public $id="";
	  public $view="";
    public function run(){
    	  //��ʼ��ҳ����Ҫ��ȫ�ֱ���
      	if(empty($this->pattern)){
    			$this->pattern="archives";
    		}
       $this->render("/wvot/".$this->view,array('pattern'=>$this->pattern,'id'=>$this->id,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
    }    
}
