<?php
class GettravelAction extends  BaseAction{
    public function beforeAction(){
    	  if(Yii::app()->request->isAjaxRequest){
    		  Util::reset_vars();
          return true;
        }else{
        	return false;
        }
    }
    protected function do_action(){
    	  $channel_id=$_REQUEST['channel_id'];
    	  $end_region=$_REQUEST['end_region'];
    	  $attr=$_REQUEST['attr'];
    	  $linetype=$_REQUEST['linetype'];
    	  $limit=$_REQUEST['limit'];
    	  $sort=$_REQUEST['sort'];
    	  $sort_type=$_REQUEST['sort_type'];
    	  $view=$_REQUEST['view'];
    	  if(empty($view)){
    	  	$view="tuijian";
    	  }
    	  $travel=Travel::model();
    	  $travel_datas=$travel->get_travel_datas($channel_id,$end_region,$attr,$linetype,$limit,$sort,$sort_type);
    	  switch($view){
    	  	case 'tuijian':
    	  	   $travel_html='<table cellpadding="0" cellspacing="0" width="100%">';
    	  foreach($travel_datas as $key => $value){
    	  	$travel_html.='<tr><td><a title="'.$value->title.'" href="'.$value->set_channel_link("travel",$value->id).'">'.$value->title.'</a></td><td width="105"><span class="price">￥<b>'.$value->get_travel_price($value->id).'</b>起</span></td></tr>';
    	  	
    	  }
    	  $travel_html.="</table>";
    	  	  break;
    	  	case 'jingxuantuijian':
    	  	$travel_html='<ul>';
    	  foreach($travel_datas as $key => $value){
    	  				$travel_html.='<li>
                   <div class="main_rb_tjleft">
                     <h2><a title="'.$value->title.'" href="'.$value->set_channel_link("travel",$value->id).'">'.$value->title.'</a></h2>
                     <p>'.$value->scontent.'</p>
                   </div>
                   <div class="main_rb_tjright"><a href="javascript:get_travel_date(\''.$value->id.'\');">查看团期</a></div>
                   <div class="main_rb_tjcenter"><span class="rb_price">'.$value->get_travel_price($value->id).'</span>起</div>
                </li>';
    	  }
    	  $travel_html.="</ul>";
    	  	  break;
    	  	default:
    	  	$travel_html='<table cellpadding="0" cellspacing="0" width="100%">';
    	  foreach($travel_datas as $key => $value){
    	  	$travel_html.='<tr><td><a title="'.$value->title.'" href="'.$value->set_channel_link("travel",$value->id).'">'.$value->title.'</a></td><td width="105"><span class="price">￥<b>'.$value->get_travel_price($value->id).'</b>起</span></td></tr>';
    	  	
    	  }
    	  $travel_html.="</table>";
    	  	  break;
    	  	
    	  }
    	 
    	  
    	  $result=Util::combo_ajax_message('1',array(),$travel_html);
        echo $result;
    } 
}
?>
