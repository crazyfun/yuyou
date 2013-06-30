<?php
class AdminLogin extends CWidget
{
  public $views="";
	public function run(){
		$ts = time();
		$model=new User("AdminLogin");
		// collect user input data
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->admin_login()){
			  //Yii::app()->session->add('permissions_type','59');
				$this->controller->redirect(array('site/index'));
			}
		}
			$travel=Travel::model();
			$travel_datas=$travel->with("StartRegion","EndRegion")->findAll(array('condition'=>"t.status=:status",'params'=>array(':status'=>'2'),'limit'=>20,'order'=>'t.create_time DESC'));
			$travel_order=TravelOrder::model();
			$travel_order_datas=$travel_order->with("Travel")->findAll(array('condition'=>"t.status=6 OR t.status=7",'params'=>array(),'order'=>'t.create_time DESC','limit'=>20));
		
  	$this->render($this->views,array('model'=>$model,'travel_datas'=>$travel_datas,'travel_order_datas'=>$travel_order_datas,'ts'=>$ts));
	}


}

?>




