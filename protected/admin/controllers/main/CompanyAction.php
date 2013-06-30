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
      $type=$_REQUEST['type'];
      $condition=array();
      $params=array();
      $condition[]="t.company_name LIKE '%$query%'";
      $condition[]="t.status=:status";
      $params[':status']='2';
      if(!empty($type)){
      	$condition[]="t.company_type = :type";
        $params[':type']=$type;
      }
   		$company=new Company();
   		$company_datas=$company->with("Region")->findAll(array('condition'=>implode(" AND " ,$condition),'params'=>$params));
   		$suggestions=array();
   		$datas=array();
   		foreach($company_datas as $key => $value){
   			array_push($suggestions,$value->company_name."(".$value->Region->region_name.$value->show_attribute("company_type").")");
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
