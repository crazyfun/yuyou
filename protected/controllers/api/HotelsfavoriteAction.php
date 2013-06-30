<?php
class HotelsfavoriteAction extends  BaseAction{
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
        $hotels_id=$_REQUEST['hotels_id'];
    	  $hotels_favorite=new HotelsFavorite();
    	  $hotels_favorite_data=$hotels_favorite->find("t.user_id=:user_id AND t.hotels_id=:hotels_id",array(':user_id'=>$user_id,':hotels_id'=>$hotels_id));
    	  if(!empty($hotels_favorite_data)){
    	  	$result=Util::combo_ajax_message('1',array(),"该产品已经在您的收藏列表中了");
    	  }else{
    	  	$hotels_favorite->user_id=$user_id;
    	  	$hotels_favorite->hotels_id=$hotels_id;
    	  	if($hotels_favorite->validate()){
		    	   $result_flag=$hotels_favorite->insert_datas();
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
