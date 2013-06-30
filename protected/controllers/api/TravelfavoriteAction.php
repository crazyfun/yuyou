<?php
class TravelfavoriteAction extends  BaseAction{
    public function beforeAction(){
    	  if(Yii::app()->request->isAjaxRequest){
    		  Util::reset_vars();
          return true;
        }else{
        	return false;
        }
    }
    protected function do_action(){
        $user_id=Yii::app()->user->id;
        $travel_id=$_REQUEST['travel_id'];
    	  $travel_favorite=new TravelFavorite();
    	  $travel_favorite_data=$travel_favorite->find("t.user_id=:user_id AND t.travel_id=:travel_id",array(':user_id'=>$user_id,':travel_id'=>$travel_id));
    	  if(!empty($travel_favorite_data)){
    	  	$result=Util::combo_ajax_message('1',array(),"该产品已经在您的收藏列表中了");
    	  }else{
    	  	$travel_favorite->user_id=$user_id;
    	  	$travel_favorite->travel_id=$travel_id;
    	  	if($travel_favorite->validate()){
		    	   $result_flag=$travel_favorite->insert_datas();
		    	   if($result_flag){
		    	      $result=Util::combo_ajax_message('1',array(),"收藏成功");
		    	   }else{
		    	   	$result=Util::combo_ajax_message('1',array(),"收藏成功");
		    	   }
		      }else{
		      	 $result=Util::combo_ajax_message('1',array(),"收藏失败");
		      }
    	  	
    	  }
        echo $result;
    } 
}
?>
