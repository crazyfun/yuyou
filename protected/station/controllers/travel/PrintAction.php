<?php
class PrintAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_print_page();
        return true;
    }
   protected function do_action(){
   	$cssPath=$this->controller->get_css_path();
    $jsPath=$this->controller->get_js_path();
    $id=$_REQUEST['id'];
    if(empty($id)){
    	$this->controller->redirect("/error/error404");
    }
     $model=Travel::model();
     $model=$model->findByPk($id);
     $this->display("print",array('cssPath'=>$cssPath,'jsPath'=>$jsPath,'model'=>$model));
   }

}
?>