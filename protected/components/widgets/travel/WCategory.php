<?php
class WCategory extends CWidget
{
		public $pattern="";
    public $view="";
    public $channel="";
    public $ids="";
    public $parent="";
    public $select="";
    public function run(){
    	 $category=$_REQUEST['category'];
    	  //初始化页面需要的全局变量
   	   $cssPath=$this->controller->get_css_path();
       $jsPath=$this->controller->get_js_path(); 
       $content=array();
       $category_model=ChannelCategory::model();
       if(!empty($this->channel)){
         $channels=Channels::model();
         $channel_data=$channels->findByPk($this->channel);
         $channel_category=$channel_data->channel_category;
         $channel_category=explode(",",$channel_category);
         foreach($channel_category as $key => $value){
            $category_datas=$category_model->get_category($this->pattern,$value,$this->channel,$this->ids);
            $content=array_merge($content,$category_datas);	
         }
       }
       $category_datas=$category_model->get_category($this->pattern,$this->parent,$this->channel,$this->ids);
       $content=array_merge($content,$category_datas);
       $this->render("/category/".$this->view,array('content'=>$content,'category'=>$category,'select'=>$this->select,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
    }    
   
}
