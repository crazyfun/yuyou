<?php
class Step1Action extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_group_page();
        $sys_config=SysConfig::model();
		    $all_syscfg_values=$sys_config->get_all_syscfg();
        WebConfig::set_seo_content(array('seo_title'=>$all_syscfg_values['sfc_home_title']),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action(){
   	  //初始化页面需要的全局变量
   	  $cssPath=$this->controller->get_css_path();
      $jsPath=$this->controller->get_js_path(); 
      $action=$_REQUEST['action'];
      $id=$_REQUEST['id'];
      $model=Group::model();
      $model_data=$model->findByPk($id);
      $group_order=new GroupOrder();
      if(Yii::app()->user->isGuest){
      	$this->controller->redirect($this->controller->createUrl("/login/index"));
      	exit();
      }
      if(empty($id)){
      	$this->controller->redirect($this->controller->createUrl("/error/error404"));
      	exit();
      }
      if($model_data->open=='1'||$model_data->open=='3'){
      	$this->controller->redirect($this->controller->createUrl("/error/errorover"));
      	exit();
      }
      if($action=="save"){
      	$amount=$_REQUEST['amount'];
      	$cell_phone=$_REQUEST['cell_phone'];
      	$group_order->amount=$amount;
      	$group_order->group_id=$id;
      	$group_order->total_price=$amount*$model_data->price;
      	$group_order->cell_phone=$cell_phone;
      	$group_order->order_serial="G".Util::randStr(6,"NUMBER").$id;
      	$group_order->validate();
      	if($group_order->validate()){
      		$result=$group_order->insert_datas();
		    	if($result){
		    		$group_order->updateByPk($group_order->id,array('order_serial'=>("G".Util::randStr(6,"NUMBER").$group_order->id)));
		    		$this->controller->redirect($this->controller->createUrl("grouppay/step2",array('id'=>$group_order->id)));
		    	}
      	}
      }
      	if($model_data->open!=2&&$model_data->status!=2){
      		$this->controller->redirect($this->controller->createUrl("/error/error404"));
      	}
      	$user=User::model();
      	$user_data=$user->findByPk(Yii::app()->user->id);
      	$this->display("step1",array('model'=>$model_data,'user_data'=>$user_data,'group_order'=>$group_order,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
      
   }

}
?>