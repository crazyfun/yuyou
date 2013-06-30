<?php
class DateAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_page();
        return true;
    }
   protected function do_action(){
   	$cssPath=$this->controller->get_css_path();
    $jsPath=$this->controller->get_js_path();
		$id=$_REQUEST['id'];
		if(empty($id)){
			$this->controller->redirect("/error/error404");
		}

		$this->display("date",array('cssPath'=>$cssPath,'jsPath'=>$jsPath,"id"=>$id));

   }

}
?>