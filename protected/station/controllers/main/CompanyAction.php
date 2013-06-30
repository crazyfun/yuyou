<?php
class CompanyAction extends  BaseAction{
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
   		$company=new Company();
   		$company_datas=$company->findAll(array('condition'=>"company_name LIKE '%$query%' AND t.status=:status",'params'=>array(':status'=>'2')));
   		$suggestions=array();
   		$datas=array();
   		foreach($company_datas as $key => $value){
   			array_push($suggestions,$value->company_name);
   			$tem_array=array();
   			$tem_array['id']=$value->id;
   			$tem_array['name']=$value->company_name;
   			array_push($datas,$tem_array);
   		}
   		$ajax_array=array('query'=>$query,'suggestions'=>$suggestions,'data'=>$datas);
   		echo json_encode($ajax_array);
    } 
}
?>
