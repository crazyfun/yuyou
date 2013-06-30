<?php
class Wreply extends CWidget
{
	public $view="";
	public $limit="";
  public function run(){
  	$cssPath=$this->controller->get_css_path();
    $jsPath=$this->controller->get_js_path(); 
	  $condition=array();
		$params=array();
		$page_params=array(); 
		$condition[]="t.status=:status";
		$params[':status']='2';
		$page_params['status']='2';
	  //定义排序类
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.create_time DESC";
  	$sort->params=$page_params;
  	$model=new ContacterMessage();
  	//生成ActiveDataProvider对象
  	$dataProvider=new CActiveDataProvider($model,array(
				'criteria'=>array(
			  	'condition'=>implode(' AND ',$condition),
			 	 	'params'=>$params,
			  	'with'=>array('ReplayUser'),
			  	'together'=>true,
		    ),
				'pagination'=>array(
          'pageSize' => $this->limit,
          'params' => $page_params,
      	),
      	'sort'=>$sort,
		));
		
	$dataProvide_data=$dataProvider->getData();
		foreach($dataProvide_data as $key => $value){
		  $value['create_time']=date('Y-m-d',$value['create_time']);
		  $value['replay_time']=date('Y-m-d',$value['replay_time']);
		  $value['message_type']=$value->show_attribute("message_type");
		  $value['contacter_sex']=$value->show_attribute("contacter_sex");
      $dataProvide_data[$key]=$value;
		}
		$dataProvider->data=$dataProvide_data;
		
		
   $this->render("wreply",array('view'=>$this->view,'model'=>$model,'dataProvider'=>$dataProvider,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
  }
}
