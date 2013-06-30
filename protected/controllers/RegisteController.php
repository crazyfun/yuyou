<?php
class RegisteController extends Controller
{
	public $breadcrumbs=array();
  public function filters() {
		return array(

		);
	}

 public function actions(){
 	  $controller_path="application.controllers.registe.";
		return array(
		  'index'=>$controller_path."IndexAction",
		  'registe2'=>$controller_path."Registe2Action",
		  'registe3'=>$controller_path."Registe3Action",
		  'validate'=>$controller_path."ValidateAction",
		  'agreement'=>$controller_path."AgreementAction",
		  'company'=>$controller_path.'CompanyAction',
		  'companyagreement'=>$controller_path.'CompanyagreementAction',
		);
	}
	
		public function f($msg_code){ 
     if($msg_code == CV::SUCCESS){
       $this->set_flash("操作成功",$msg_code);
     }
     if($msg_code == CV::FAIL){
     	 $this->set_flash("操作失败",$msg_code);
     }
     
   }
}
