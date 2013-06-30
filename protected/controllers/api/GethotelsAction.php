<?php
class GethotelsAction extends  BaseAction{
    public function beforeAction(){
    	  if(Yii::app()->request->isAjaxRequest){
    		  Util::reset_vars();
          return true;
        }else{
        	return false;
        }
    }
    protected function do_action(){
    	  $category=$_REQUEST['category'];
    	  $end_region=$_REQUEST['end_region'];
    	  $attr=$_REQUEST['attr'];
    	  $limit=$_REQUEST['limit'];
    	  $sort=$_REQUEST['sort'];
    	  $sort_type=$_REQUEST['sort_type'];
    	  $view=$_REQUEST['view'];
    	  $brand_id=$_REQUEST['brand_id'];
    	  if(empty($view)){
    	  	$view="tejia";
    	  }
    	  $travel=Hotels::model();
    	  $travel_datas=$travel->get_hotels_datas($category,$end_region,$attr,$limit,$sort,$sort_type,$brand_id);
    	  switch($view){
    	  	case 'tejia':
    	  	   $hotels_html='<ul>';
    	  foreach($travel_datas as $key => $value){
    	  	$hotels_html.='<li><a title="'.$value->title.'" href="'.$value->set_channel_link("hotels",$value->id).'"><img src="/'.Util::rename_thumb_file("196","105","",$value->get_first_image($value->id)).'" width="196" height="105" alt="'.$value->title.'" /></a><h2><a title="'.$value->title.'" href="'.$value->set_channel_link("hotels",$value->id).'">'.Util::cutstr($value->title,"20",false).'</a></h2><p>'.Util::cutstr($value->scontent,"40",true).'</p></li>';
    	  }
    	  $hotels_html.="</ul>";

    	  	  break;
    	  case 'tuijian':
    	     $hotels_html='<div class="h_hot"><div class="h_hotli">';
    	  foreach($travel_datas as $key => $value){
    	  	$hotels_html.='<div class="hot_img"><img width="130" height="130" src="/'.Util::rename_thumb_file("130","130","",$value->get_first_image($value->id)).'" /></div><div class="h_htb1"><h2><a href="'.$value->set_channel_link("hotels",$value->id).'" title="'.$value->title.'">'.$value->title.'</a></h2><p>'.$value->get_hotels_level().'</p><p class="h_htext">'.$value->scontent.'</p></div><div class="h_htb2"><p><span class="h_icon3">原价￥<b><s>'.$value->get_hotels_o_price($value->id).'</s>起</b></span><span class="h_sprice">现价￥<b><s>'.$value->get_hotels_price($value->id).'</s>起</b></span></p></div><div class="h_line"></div>';
    	  }
    	  $hotels_html.="</div></div>";
    	    break;
    	  case 'brand':
    	   $hotels_html=' <div class="h_ztlist"><ul>';
          foreach($travel_datas as $key => $value){
    	  	  $hotels_html.='<li><a href="'.$value->set_channel_link("hotels",$value->id).'" title="'.$value->title.'"><img width="106" height="72" src="/'.Util::rename_thumb_file("106","72","",$value->get_first_image($value->id)).'" /></a>
                    <div class="h_ztr">
                       <h2><a href="'.$value->set_channel_link("hotels",$value->id).'" title="'.$value->title.'">'.Util::cutstr($value->title,"10",false).'</a></h2>
                       <p>'.$value->show_attribute("hotel_region").'</p>
                       <p>'.$value->get_hotels_level().'</p>
                    </div>
                </li>';
    	   }
                
                
         $hotels_html.="</ul></div>";       
                
                
    	    break;
    	    
    	  	default:
    	  	$hotels_html='<ul>';
    	  foreach($travel_datas as $key => $value){
    	  	$hotels_html.='<li><a title="'.$value->title.'" href="'.$value->set_channel_link("hotels",$value->id).'"><img src="/'.Util::rename_thumb_file("196","105","",$value->get_first_image($value->id)).'" width="196" height="105" alt="'.$value->title.'" /></a><h2><a title="'.$value->title.'" href="'.$value->set_channel_link("hotels",$value->id).'">'.Util::cutstr($value->title,"20",false).'</a></h2><p>'.Util::cutstr($value->scontent,"40",true).'</p></li>';
    	  }
    	  $hotels_html.="</ul>";
    	  	  break;
    	  	
    	  }
    	  $result=Util::combo_ajax_message('1',array(),$hotels_html);
        echo $result;
    } 
}
?>
