<div class="main_con">
 <div class="hotel_headline"><?php echo $model->Hotels->title;?></div>

   
   
   <?php 
    		 							$form=$this->beginWidget('EActiveForm', array(
	        								'id'=>'',
          								'action'=>"",
	        								'enableAjaxValidation'=>false,
	        								'htmlOptions'=>array('id'=>'registe_from'),
         							));
         							echo EHtml::createHidden("hotels_price_id",$model->id,array());
         							echo EHtml::createHidden("start_date",$hotels_order->start_date,array());
         							echo EHtml::createHidden("end_date",$hotels_order->end_date,array());
         							
         							
        					?>
        					
        					
        					
  <div class="hotel_ydleft"><!--hot_ydleft-->
    <div class="hotel_box"><!--hotel_box-->
    	
      <div class="hotel_title"><h2>预订信息</h2></div>
           <?php $this->widget("FlashInfo");?>
           <table width="100%" cellspacing="0" cellpadding="0" border="0" class="hotel_tb">
            <tr>
             <th>房型名称：</th>
             <td class="h_m"></td>
             <td><?php echo $model->HotelsBeds->name;?></td>
             <td>&nbsp;</td>
           </tr>
           
           <tr>
             <th>床型：</th>
             <td class="h_m"></td>
             <td><?php echo $model->show_attribute("bed");?></td>
             <td>&nbsp;</td>
           </tr>
           <tr>
            <th>入住日期：</th>
            <td class="h_m">*</td>
            <td><strong><?php echo $hotels_order->start_date;?></strong>至 <strong><?php echo $hotels_order->end_date;?></strong></td>
             <td class="hotels_error"><?php echo $form->error($hotels_order,"start_date");?>&nbsp;&nbsp;<?php echo $form->error($hotels_order,"end_date");?></td>
         </tr>
         <tr>
           <th>早餐：</th>
           <td class="h_m"></td>
           <td><?php echo $model->show_attribute("breakfast");?></td>
            <td>&nbsp;</td>
       </tr>
       <tr>
    <th>预订间数：</th>
    <td class="h_m">*</td>
    <td><label>
    	
    	<?php echo EHtml::createSelect("numbers",$hotels_order->numbers,array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'更多'),array('class'=>'hotels_numbers','id'=>"hotels_numbers",'style'=>'width:80px;'));?>
      
     </label>间 ×¥ <span id="sigle_price"><?php echo $model->price;?>（单间总价） =<strong class="hotel_yprice">¥<span id="total_price"></span></strong><br/><font color="#ff0000"><?php echo $model->settle_price_desc;?></font></td>
     	 <td class="hotels_error"><?php echo $form->error($hotels_order,"numbers");?></td>
  </tr>
  <tr>
    <th>入住人数：</th>
    <td class="h_m"></td>
    <td><label>
    	<?php echo EHtml::createSelect("live_numbers",$hotels_order->live_numbers,array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'更多'),array('class'=>'hotels_live_numbers','id'=>"hotels_live_numbers",'style'=>'width:80px;'));?>人</label></td>
  <td>&nbsp;</td>
  </tr>
  <tr>
    <th>入住人：</th>
    <td class="h_m">*</td>
    <td><label>
    	<?php echo $form->createText($hotels_order,"live_contacter",array('class'=>'hotel_yinput'));?>
    </label></td>
    <td class="hotels_error"><?php echo $form->error($hotels_order,"live_contacter");?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="h_m"></td>
    <td><span style="color:#666;">至少填1人，最多填1人。</span></td>
    <td>&nbsp;&nbsp;</td>
  </tr>
 
  
</table>

     </div><!--//hotel_box-->
     <div class="hotel_box"><!--hotel_box-->
       <div class="hotel_title"><h2>其他信息</h2></div>
           <table width="100%" cellspacing="0" cellpadding="0" border="0" class="hotel_tb">
            <tr>
             <th>到店时间：</th>
             <td class="h_m">*</td>
             <td><label>
             	 <?php echo $form->createDate($hotels_order,"start_time",array('dateFmt'=>'HH:mm:ss','style'=>"width:80px;"));?>
             </label></td>
             <td class="hotels_error"><?php echo $form->error($hotels_order,"start_time");?></td>
           </tr>
           <tr>
            <th></th>
            <td class="h_m"></td>
            <td style="color:#666;">早最晚时间相隔不可超过3小时。(通常酒店14点办理入住，早到可能需要等待)</td>
            <td>&nbsp;</td>
         </tr>
         <tr>
           <th>更多需求：</th>
           <td class="h_m"></td>
           <td><?php echo $form->createTextarea($hotels_order,"commment",array());?></td>
           <td class="hotels_error"><?php echo $form->error($hotels_order,"commment");?></td>
       </tr>
</table>

     </div><!--//hotel_box-->
     <div class="hotel_box"><!--hotel_box-->
       <div class="hotel_title"><h2>联系信息</h2></div>
           <table width="100%" cellspacing="0" cellpadding="0" border="0" class="hotel_tb">
            <tr>
             <th>联系人：</th>
             <td class="h_m">*</td>
             <td><?php echo $form->createText($hotels_order,"contacter",array('class'=>'hotel_yinput'));?></td>
             <td class="hotels_error"><?php echo $form->error($hotels_order,"contacter");?></td>
           </tr>
         
         <tr>
           <th>联系手机：</th>
           <td class="h_m">*</td>
           <td><label>
           	<?php echo $form->createText($hotels_order,"contacter_phone",array('class'=>'hotel_yinput'));?>
           
           </label></td>
           <td class="hotels_error"><?php echo $form->error($hotels_order,"contacter_phone");?></td>
       </tr>
       <tr>
           <th>固定电话 ：</th>
           <td class="h_m"></td>
           <td><label>
             	<?php echo $form->createText($hotels_order,"contacter_telephone",array('class'=>'hotel_yinput'));?>
           </label></td>
           <td class="hotels_error"><?php echo $form->error($hotels_order,"contacter_telephone");?></td>
           
       </tr>
       <tr>
           <th>Email ：</th>
           <td class="h_m"></td>
           <td><label>
            <?php echo $form->createText($hotels_order,"email",array('class'=>'hotel_yinput'));?>
           </label>建议填写，了解最新促销资讯</td>
           <td class="hotels_error"><?php echo $form->error($hotels_order,"email");?></td>
       </tr>
</table>
     </div><!--//hotel_box-->
    <input type="submit" class="hotel_ybnt" value="提交订单"/>
  </div><!--//hot_ydleft-->
  <?php $this->endWidget(); ?>
  <?php $hotels=Hotels::model();?>
  <div class="hote_right"><!--hote_right-->
     <div class="side_hotel"><!--side_hotel-->
        <img width="200" height="127" alt="<?php echo $model->Hotels->title;?>" src="/<?php echo Util::rename_thumb_file("200","127","",$hotels->get_first_image($model->hotels_id));?>" class="hote_pic"/>
        <p><h2 class="name"><?php echo $model->Hotels->title;?></h2></p>
        <p class="address"><?php echo $model->Hotels->hotel_address;?></p>
     </div><!--//side_hotel-->
     <dl class="side_room">
           <dt><?php echo $model->HotelsBeds->name;?></dt>
           <dd>床型：<?php echo $model->show_attribute("bed");?></dd>
           <dd>早餐：<?php echo $model->show_attribute("breakfast");?></dd>
           <dd>宽带：<?php echo $model->show_attribute("line");?></dd>
      </dl>
  </div><!--//hote_right-->
   <div style="clear:both;"></div>


</div>

<script language="javascript">
	jQuery(function(){
    cul_total();
		jQuery("select.hotels_numbers").live("change",function(){
			 var select_val=jQuery(this).val();
			 switch(select_val){
			 	 case '5':
			 	   jQuery(this).replaceWith("<input id='hotels_numbers' type='text' class='hotels_numbers' name='numbers' value='0' style='width:80px;'/>");
			 	   cul_total();
			 	   break;
			 	 default:
			 	   cul_total();
			 	   break;
			 }
		});
		jQuery("input.hotels_numbers").live("change",function(){
			  cul_total();
		});
		
		
		jQuery("select.hotels_live_numbers").live("change",function(){
			 var select_val=jQuery(this).val();
			 switch(select_val){
			 	 case '5':
			 	   jQuery(this).replaceWith("<input id='hotels_live_numbers' type='text' class='hotels_live_numbers' name='live_numbers' value='0' style='width:80px;'/>");
			 	   break;
			 	 default:
			 	   break;
			 }
		});
		
		

	});
	
	function cul_total(){
		var sigle_price=parseFloat(jQuery("#sigle_price").html());
		var hotels_numbers=parseFloat(jQuery("#hotels_numbers").val());
		jQuery("#total_price").html(sigle_price*hotels_numbers);
	}
</script>