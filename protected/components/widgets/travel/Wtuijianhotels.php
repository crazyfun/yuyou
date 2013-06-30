<?php
class Wtuijianhotels extends CWidget
{
	  public $category="";
	  public $attr="";
	  public $limit="";
	  public $sort="";
	  public $sort_type="";
	  public $view="";
	  public $brand_id="";
    public function run(){
       $this->render("/wtuijianhotels/".$this->view,array('attr'=>$this->attr,'limit'=>$this->limit,'sort'=>$this->sort,'sort_type'=>$this->sort_type,'brand_id'=>$this->brand_id,'category'=>$this->category));
    }
}
