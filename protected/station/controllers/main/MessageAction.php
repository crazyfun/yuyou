<?php
class MessageAction extends  BaseAction{
    public function beforeAction(){
    	  if(Yii::app()->request->isAjaxRequest){
    		  Util::reset_vars();
          return true;
        }else{
        	return false;
        }
    }
    protected function do_action(){
    	  $query=$_REQUEST['query'];
			  $ajax_array=array('query'=>$query,'suggestions'=>array('1','2'),'data'=>array(array('id'=>'1'),array('id'=>'2')));
        echo json_encode($ajax_array); 
    } 
}
?>
