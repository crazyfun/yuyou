<div class="main_con">
 <div class="hotel_headline"><?php echo $model->Hotels->title;?></div>
   					
  <div class="hotel_ydleft" style="text-align:center;color:#ff0000;"><!--hot_ydleft-->
  	预定成功,请等待计调确认。
  </div><!--//hot_ydleft-->
  <?php $hotels=Hotels::model();?>
  <div class="hote_right"><!--hote_right-->
     <div class="side_hotel"><!--side_hotel-->
        <img width="200" height="127" alt="<?php echo $model->Hotels->title;?>" src="/<?php echo Util::rename_thumb_file("200","127","",$hotels->get_first_image($model->hotels_id));?>" class="hote_pic"/>
        <p><h2 class="name"><?php echo $model->Hotels->title;?></h2></p>
        <p class="address"><?php echo $model->Hotels->hotel_address;?></p>
     </div><!--//side_hotel-->
     <dl class="side_room">
           <dt><?php echo $model->HotelsBeds->name;?></dt>
           <dd>床型：<?php echo $model->HotelsPrice->show_attribute("bed");?></dd>
           <dd>早餐：<?php echo $model->HotelsPrice->show_attribute("breakfast");?></dd>
           <dd>宽带：<?php echo $model->HotelsPrice->show_attribute("line");?></dd>
      </dl>
  </div><!--//hote_right-->
   <div style="clear:both;"></div>
</div>
