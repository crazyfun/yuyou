<?php
class BaseAction extends CAction {
    protected function beforeAction(){
        return true;
    }
    protected function afterAction(){
        return true;
    }
    public function run(){
        $before=$this->beforeAction();
        if($before){
            $this->do_action();
        }
        $after=$this->afterAction();
    }
    //显示
    public function display($view,$params=NULL,$flag=false){
    	if($flag){
    		return $this->controller->render($view,$params,$flag);
    	}else{
    		$this->controller->render($view,$params,$flag);
    	}
        
    }
    //显示partial
    public function display_partial($view,$params=NULL,$flag=false,$processOutput=false){
    	if($flag){
        return $this->controller->renderPartial($view,$params,$flag,$processOutput);
      }else{
      	$this->controller->render($view,$params,$flag);
      }
    }
    //显示Dynamic
    public function display_dynamic($callback){
        $this->controller->renderDynamic($callback);
    }
    //动作
    protected function do_action(){
    }
    
    

    
}
?>
