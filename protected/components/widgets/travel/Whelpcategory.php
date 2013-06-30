<?php
class Whelpcategory extends CWidget
{
	  public $view="";
    public function run(){
    	 $category=Information::model();
    	 $category_datas=$category->get_whelp_categorys();
       $this->render("/whelpcategory/".$this->view,array('model'=>$category,'category_datas'=>$category_datas));
    }
}
