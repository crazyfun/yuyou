<?php
class ClearflushAction extends  BaseAction{
    public function beforeAction(){
    	  if(Yii::app()->request->isAjaxRequest){
    		  Util::reset_vars();
          return true;
        }else{
        	return false;
        }
    }
    protected function do_action(){
    	  $result_flag=Yii::app()->cache->flush();
    	  $result=Util::combo_ajax_message('1',array(),"成功清除缓存");
        echo $result;
    } 
}
?>
