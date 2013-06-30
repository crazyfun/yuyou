<?php
class Error500Action extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_page();
        return true;
    }
   protected function do_action(){
	      $this->display('error_500', array());
  }
}
?>
