<?php
class IndexAction extends BaseAction{
	protected function beforeAction(){
        return true;
    }
   protected function do_action(){
   	  if(Yii::app()->request->isAjaxRequest){
        $pid = empty($_GET['pid']) ? 0 : $_GET['pid'];
        switch ($_GET['type'])
        {
            case 'region':
                $region=Region::model();
                $regions = $region->get_list($pid);
                $return_array=array();
                foreach ($regions as $key => $region)
                {
                	  $tem=array();
                    $tem['region_id'] = $region['region_id'];
                    $tem['region_name']= htmlspecialchars($region['region_name']);
                    $return_array[]=$tem;
                }
                echo Util::combo_ajax_message('s',$return_array,"");
                
                break;
           default:
               break;
              
        }
      }
  }

}
?>