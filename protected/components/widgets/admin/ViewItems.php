<?php
class ViewItems extends CWidget
{
	public $model="";
	public $view_datas="";
	public function run(){
  	$this->render("view_items",array('model'=>$this->model,'view_datas'=>$this->view_datas));
	}


  
}

?>




