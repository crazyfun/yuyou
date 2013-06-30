<?php
class DownloadsAction extends  BaseAction{
    public function beforeAction(){
    	  if(Yii::app()->request->isAjaxRequest){
    		  Util::reset_vars();
          return true;
        }else{
        	return false;
        }
    }
    protected function do_action(){
    	 $id=$_REQUEST['id'];
    	 $model=Downloads::model();
       $model_data=$model->findByPk($id);
       $model_data->downloads_times=$model_data->downloads_times+1;
       $model_data->save();
    } 
}
?>
