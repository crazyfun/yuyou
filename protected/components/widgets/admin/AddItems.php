<?php
class AddItems extends CWidget
{
	public $model="";
	public $user_operate="";
	public $add_datas="";
	public $operates="";
	public $name="";
	public function run(){
		$user_operate=$this->combo_user_operate();
		$operates=$this->combo_operates();
  	$this->render("add_items",array('model'=>$this->model,'add_datas'=>$this->add_datas,'user_operate'=>$user_operate,'operates'=>$operates,'name'=>$this->name));
	}

	public function combo_operates(){
		if(empty($this->operates[0])){
			return NULL;
		}
		$operates="";
		foreach($this->operates as $key => $value){
			$operates.='<span><a class="operate_button" href="'.$value['value'].'">'.$value['name'].'</a></span>';
		}
		return $operates;
	}
	
	public function combo_user_operate(){
		if(empty($this->user_operate[0])){
			return NULL;
		}
		$user_operate="";
		foreach($this->user_operate as $key => $value){
			$user_operate.='<span><a  href="'.$value['value'].'">'.$value['name'].'</a></span>';
		}
		return $user_operate;
	}
  
}

?>




