<?php
class PermissiondAction extends  BaseAction{
    public function beforeAction(){
    	  if(Yii::app()->request->isAjaxRequest){
    		  Util::reset_vars();
          return true;
        }else{
        	return false;
        }
    }
    protected function do_action(){
    	  $model=$_REQUEST['model'];
    	  $id=$_REQUEST['id'];
    	  $model=new $model();
    	  Util::remove_auth($id);
    	  $result=$model->delete_table_datas($id);
    	  if($result){
    	  	$result=Util::combo_ajax_message('1',array('id'=>$id),"删除成功");
    	  }else{
    	  	$result=Util::combo_ajax_message('2',array('id'=>$id),"删除失败");
    	  }
        echo $result;
    } 
}
?>
