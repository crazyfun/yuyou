<?php
class DeleteAction extends  BaseAction{
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
    	  $table_id=$_REQUEST['table_id'];
    	  $id=$_REQUEST['id'];
    	  if(!empty($table_id)){
    	  	$model=new $model($table_id);
    	  }else{
    	  	$model=new $model();
    	  }
    	  
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
