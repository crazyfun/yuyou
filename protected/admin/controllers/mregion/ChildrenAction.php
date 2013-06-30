<?php
class ChildrenAction extends BaseAction{
  protected function beforeAction(){
      if(Yii::app()->request->isAjaxRequest){
    		  Util::reset_vars();
          return true;
        }else{
        	return false;
        }
  }
  protected function do_action(){
        $model=Region::model();
        $cate = $model->get_list($_GET['id']);
        $return_array=array();
        foreach ($cate as $key => $val)
        {
        	  $tem=array();
        	  $tem['region_id']=$val->region_id;
        	  $tem['region_name']=$val->region_name;
        	  $tem['open']=$val->open;
        	  $tem['sort_order']=$val->sort_order;
        	  $tem['operate']=$val->get_operate();
            $child = $model->get_list($val->region_id);
            if (!$child || empty($child))
            {
            	  $tem['switchs']=0;
                
            }
            else
            {
            	  $tem['switchs']=1;
                
            }
            $return_array[]=$tem;
        }
       
        echo json_encode($return_array);
      
  } 
}
?>
