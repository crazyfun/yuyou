<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class AController extends CController{
	public $region_id="";
	public $company_id="";
  public function FilteraccessControl($filterChain) {
  	if(Yii::app()->user->isGuest){
  		$this->redirect($this->createUrl("site/login"),array());
  		exit();
  	}
    $controller_id=$this->id;
    $action_id=$this->action->id;
    $access_operation=ucfirst($controller_id).ucfirst($action_id);
		 if(!Yii::app()->user->checkAccess($access_operation))
     {
        $this->redirect($this->createUrl("error/error403"));
     }
     
    $user=User::model();
    $user_data=$user->findByPk(Yii::app()->user->id);
    if(!empty($user_data->company_id)){
    	$company=Company::model();
      $this->company_id=$user_data->company_id;
      $company_data=$company->findByPk($user_data->company_id);
      $this->region_id=$company_data->region_id;
    }else{
    	$this->redirect($this->createUrl("error/error403"));
    }
    
		$filterChain->run();
	}
	
			/*
	  设置成功信息
	*/
	public function set_flash($msg,$flash){
		 switch($flash){
		 		case CV::SUCCESS_ADMIN_OPERATE:
		 		     Yii::app()->user->setFlash(CV::SUCCESS_ADMIN_OPERATE,$msg);
		 				break;
		 		case CV::FAILED_ADMIN_OPERATE:
		 		    Yii::app()->user->setFlash(CV::FAILED_ADMIN_OPERATE,$msg);
		 				break;
		 		case CV::TIP:
		 		    Yii::app()->user->setFlash(CV::TIP,$msg);
		 		    break;
		 		default:
		 				break;	
		 	
		 }
	}
	
	
    /**
     * 设置成功的提示信息
     */
   public function sf($msg){
       Yii::app()->user->setFlash(CV::SUCCESS_ADMIN_OPERATE,$msg); 
    }
    /**
     * 设置失败的提示信息
     */
    public function ff($msg){
       Yii::app()->user->setFlash(CV::FAILED_ADMIN_OPERATE,$msg);
    }
    /**
     * 设置提示性的提示信息
     */
  public function tf($msg){
    Yii::app()->user->setFlash(CV::TIP,$msg);
  }  
	public function init_login_page(){
		
		$this->layout="login";
		Util::reset_vars();
	}
    	//初始化需要的数据
	function init_main_page(){	
		$this->layout="main";
		Util::reset_vars();
	}
	function init_page(){
		$this->layout="none";
		Util::reset_vars();
	}
function init_print_page(){	
		$this->layout="print";
		Util::reset_vars();
	}
	/*
	* 根据themes名称获得css的路径
	* @return string css的路径
	* @auther lxf
	* @version 1.0.0
	*/
	function get_css_path(){
	
		return Yii::app()->getTheme()->baseUrl."/css";
	}
	/*
	* 根据themes名称获得js的路径
	* @return string css的路径
	* @auther lxf
	* @version 1.0.0
	*/
	function get_js_path(){
		return Yii::app()->getTheme()->baseUrl."/js";
	}
}
?>
