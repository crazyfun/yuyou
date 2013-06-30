<?php
class StatusAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
		$model=Company::model();
		$id=$_REQUEST['id'];
		$status=$_REQUEST['status'];
		if(!empty($id)){
			switch($status){
				case '1':
				  $user=User::model();
			    $user_update_datas['region_id']='-1';
			    $user_update_datas['admin_status']='1';
			    $user_update_datas['company_id']='0';
			    $user->updateAll($user_update_datas,"company_id=:company_id",array(':company_id'=>$id));
				  break;
				
				default:
				  break;
			}
			$update_datas['status']=$status;
			$model->updateByPk($id,$update_datas);
		}
		$this->controller->redirect($this->controller->createUrl("index",array()));
  } 
}
?>
