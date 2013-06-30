<?php
class Wjingxuantuijiantravel extends CWidget
{
	  public $title="";
	  public $channel_id="";
	  public $attr="";
	  public $limit="";
	  public $sort="";
	  public $sort_type="";
	  public $view="";
    public function run(){
       $this->render("/wjingxuantuijiantravel/".$this->view,array('title'=>$this->title,'channel_id'=>$this->channel_id,'attr'=>$this->attr,'limit'=>$this->limit,'sort'=>$this->sort,'sort_type'=>$this->sort_type));
    }
}
