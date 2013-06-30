<?php
class FlashInfo extends CWidget
{

    public function run(){
        if($this->_render(CV::SUCCESS)){
            return ;
        }
        if($this->_render(CV::TIP)){
            return ;
        }
        if($this->_render(CV::FAIL)){
            return ;
        }
    }
    private function _render($type){
        $flash = Yii::app()->user->getFlash($type);
        if(!empty($flash)){
            $this->render('flash_info',array('type'=>$type,'flash'=>$flash));
            return true;
        }
        return false;
    }
}
