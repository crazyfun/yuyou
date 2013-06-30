<?php
class SearchuserAction extends  BaseAction{
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
   		$user=new User();
   		$user_datas=$user->findAll(array('condition'=>"user_login LIKE '%$query%'",'params'=>array()));
   		$suggestions=array();
   		$datas=array();
   		foreach($user_datas as $key => $value){
   			array_push($suggestions,$value->user_login);
   			$tem_array=array();
   			$tem_array['id']=$value->id;
   			$tem_array['name']=$value->user_login;
   			array_push($datas,$tem_array);
   		}
   		$ajax_array=array('query'=>$query,'suggestions'=>$suggestions,'data'=>$datas);
   		echo json_encode($ajax_array);
    } 
}
?>
