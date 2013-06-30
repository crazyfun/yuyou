<?php
class Wspace extends CWidget
{
    public function run(){
    	 	require_once('config.inc.php');
  			require_once('uc_client/client.php');
    	 $login_status=LoginStatus::model();
    	 $login_status_datas=$login_status->findAll(array(
    	   'select'=>'distinct(t.create_id) as create_id,COUNT(t.create_id) as count_create_id',
    	   'condition'=>'User.admin_status=:admin_status',
    	   'params'=>array(':admin_status'=>'1'),
    	   'group'=>'t.create_id',
    	   'limit'=>'10',
    	   'order'=>'count_create_id DESC',
    	   'with'=>array("User"),
    	   'together'=>true,
    	 ));

       $this->render("/wspace/index",array('content'=>$login_status_datas));
    }
}
