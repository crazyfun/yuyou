<?php
class GroupfavoriteAction extends  BaseAction{
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
        $group_id=$_REQUEST['group_id'];
    	  $group_favorite=new GroupFavorite();
    	  $group_favorite_data=$group_favorite->find("t.user_id=:user_id AND t.group_id=:group_id",array(':user_id'=>$user_id,':group_id'=>$group_id));
    	  if(!empty($group_favorite_data)){
    	  	$result=Util::combo_ajax_message('1',array(),"该产品已经在您的收藏列表中了");
    	  }else{
    	  	$group_favorite->user_id=$user_id;
    	  	$group_favorite->group_id=$group_id;
    	  	if($group_favorite->validate()){
		    	   $result_flag=$group_favorite->insert_datas();
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
