<?php
class GethotelsbedsAction extends  BaseAction{
    public function beforeAction(){
    	  if(Yii::app()->request->isAjaxRequest){
    		  Util::reset_vars();
          return true;
        }else{
        	return false;
        }
    }
    protected function do_action(){
        $start_date=$_REQUEST['start_date'];
        $end_date=$_REQUEST['end_date'];
        $hotels_id=$_REQUEST['hotels_id'];
        $hotels_beds=HotelsBeds::model();
   	    $hotels_beds_datas=$hotels_beds->findAll("hotels_id=:hotels_id",array(':hotels_id'=>$hotels_id));
        $hotels_html='<div class="hotel_infor">
             <dl class="hfor_title"><!--hfor_title-->
                <dt>房型</dt>
                <dd>市场价</dd>
                <dd>誉游价</dd>
                <dd>早餐</dd>
                <dd>宽带</dd>
                <dd>床型</dd>
                <dd>在线预定</dd>
             </dl><!--//hfor_title-->
             <div class="hotel_panes"><!--hotel_panes-->
                 <div class="hotel_pane"><!--hotel_pane-->
             ';
             foreach((array)$hotels_beds_datas as $key => $value){ 
                 		 $room_remain=$value->get_room_remain($value->id);
                     $hotels_html.='<dl>
                      <dt>'$value->show_attribute("name")'</dt>
                      <dd><del>¥'.$value->show_attribute("o_price").'</del></dd>
                      <dd><strong>¥'.$value->show_attribute("price").'</strong></dd>
                      <dd>'.$value->show_attribute("breakfast").'</dd>
                      <dd>'.$value->show_attribute("line").'</dd>
                      <dd>'.$value->show_attribute("bed").'</dd>
                      <dd>';
                      	if($room_remain<=0){
                        	$hotels_html.='<a href="javascript:void(0);" class="hotel_yd_gray">&nbsp;</a>';
                        }else{
                        	$hotels_html.='<a href="'.$this->createUrl("hotelspay/step1",array('id'=>$value->id)).'" class="hotel_yd">&nbsp;</a>';
                         }
                         $hotels_html.='</dd>
                     </dl>';  
                  }      
                $hotels_html.='</div> 
             </div><!--//hotel_panes-->
             <div style="clear:both;"></div>
          </div>';
    	  $result=Util::combo_ajax_message('1',array(),$hotels_html);
        echo $result;
    } 
}
function date_cmp($a, $b)
{
    if ($a['date'] == $b['date']) {
        return 0;
    }
    return ($a['date'] < $b['date']) ? -1 : 1;
}
?>
