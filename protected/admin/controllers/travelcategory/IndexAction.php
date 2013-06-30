<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){
       $model=TravelCategory::model();
     /* 取得地区 */
        $categorys = $model->get_list(0);
        foreach ($categorys as $key => $val)
        {
            $categorys[$key]['switchs'] = 0;
            if ($model->get_list($val['category_id']))
            {
                $categorys[$key]['switchs'] = 1;
            }
        }
        
	      $this->display('index',array('categorys'=>$categorys));
  } 
}
?>
