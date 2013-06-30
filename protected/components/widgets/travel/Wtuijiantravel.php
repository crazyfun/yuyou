<?php
class Wtuijiantravel extends CWidget
{
	  public $channel_id="";
	  public $attr="";
	  public $limit="";
	  public $sort="";
	  public $sort_type="";
	  public $view="";
    public function run(){
       $this->render("/wtuijiantravel/".$this->view,array('channel_id'=>$this->channel_id,'attr'=>$this->attr,'limit'=>$this->limit,'sort'=>$this->sort,'sort_type'=>$this->sort_type));
    }
}
