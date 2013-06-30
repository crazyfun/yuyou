<?php
class SearchItems extends CWidget
{
	public $model_name="";
	public $user_operate="";
	public $search_datas="";
	public $dataprovider="";
	public $attributes="";
	public $operates="";
	public $checked_all="";
	public $ajax="";
	public function run(){
		$user_operate=$this->combo_user_operate();
		$dataProvider=$this->combo_data_provider();
		$operates=$this->combo_operates();
		//$model_name=$this->model_name;
		//$model=new $model_name();
  	$this->render("search_items",array('user_operate'=>$user_operate,'search_datas'=>$this->search_datas,'dataProvider'=>$dataProvider,'operates'=>$operates));
	}

	public function combo_data_provider(){
		$attributes=array();
		if($this->checked_all){
			$attributes[]=array('class'=>'CCheckBoxColumn','name'=>'id','value'=>'$data->id','selectableRows' => 2,'checkBoxHtmlOptions' => array('name'=>'id[]'));
		}
		foreach($this->attributes as $key => $value){
			$attributes[]=$value;
		}
		return array('dataProvider'=>$this->dataprovider,'ajaxUpdate'=>$this->ajax,'pager'=>array('class'=>'LinkListPager'),'columns'=>$attributes);
	}
	
	public function combo_operates(){
		
		if(empty($this->operates[0])){
			return NULL;
		}
		$operates="";
		foreach($this->operates as $key => $value){
			$operates.='<span><a href="'.$value['value'].'">'.$value['name'].'</a></span>';
		}
		return $operates;
	}
	
	public function combo_user_operate(){
		if(empty($this->user_operate[0])){
			return NULL;
		}
		$user_operate="";
		foreach($this->user_operate as $key => $value){
			$user_operate.='<span><a href="'.$value['value'].'">'.$value['name'].'</a></span>';
		}
		return $user_operate;
	}
  
}

?>




