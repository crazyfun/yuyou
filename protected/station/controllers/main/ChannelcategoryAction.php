<?php
class ChannelcategoryAction extends  BaseAction{
    public function beforeAction(){
    	  if(Yii::app()->request->isAjaxRequest){
    		  Util::reset_vars();
          return true;
        }else{
        	return false;
        }
    }
    protected function do_action(){
        $channel_id=$_REQUEST['channel_id'];
        if(empty($channel_id)){
        	return;
        }
        $category_id=$_REQUEST['category_id'];
        
        $channels=Channels::model();
        $channels_data=$channels->findByPk($channel_id);
        $channel_category=$channels_data->channel_category;
        if(!empty($channel_category))
        	$channel_category_values=explode(",",$channel_category);
        $channel_category=ChannelCategory::model();
        $channel_category_select=array();
        foreach((array)$channel_category_values as $key => $value){
        			$channel_category_data=$channel_category->findByPk($value);
        			$channel_category_select[$channel_category_data->id]=$channel_category_data->name;
        		}
        $content=CHtml::dropDownList("category_id",$category_id,$channel_category_select,array());
    	  $result=Util::combo_ajax_message('1',array(),$content);
        echo $result;
    } 
}
?>
