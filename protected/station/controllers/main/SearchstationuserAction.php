<?php
class SearchstationuserAction extends  BaseAction{
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
   		$region_user_data=$user->findByPk(Yii::app()->user->id);
   		$user_datas=$user->findAll(array('condition'=>"real_name LIKE '%$query%' AND t.company_id=:company_id",'params'=>array(':company_id'=>$region_user_data->company_id)));
   		$suggestions=array();
   		$datas=array();
   		foreach($user_datas as $key => $value){
   			array_push($suggestions,$value->real_name);
   			$tem_array=array();
   			$tem_array['id']=$value->id;
   			$tem_array['name']=$value->real_name;
   			array_push($datas,$tem_array);
   		}
   		$ajax_array=array('query'=>$query,'suggestions'=>$suggestions,'data'=>$datas);
   		echo json_encode($ajax_array);
    } 
}
?>
