<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
       $model=Region::model();
     /* 取得地区 */
        $regions = $model->get_list(0);
        foreach ($regions as $key => $val)
        {
            $regions[$key]['switchs'] = 0;
            if ($model->get_list($val['region_id']))
            {
                $regions[$key]['switchs'] = 1;
            }
        }
        
	      $this->display('index',array('regions'=>$regions));
  } 
}
?>
