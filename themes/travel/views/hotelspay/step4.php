<div class="main_con">
<div class="w750">
<div class="tg_intr_top"><img src="<?php echo $cssPath;?>/images/tg_intr_top.jpg" /></div>
<div class="tg_intr_center">
   <div class="tg_buy_top"><img src="<?php echo $cssPath;?>/images/tj_sanbu3.gif" /></div>
   <div class="buy_out">
           <?php $this->widget("FlashInfo");?>
           <p><span class="pay_title">付款额：</span>¥<?php echo $price;?>元</p> 
           <p><span class="pay_title">付款方式：</span><?php  $payment_type=CV::$travel_payment_type; $bank_data=$payment_type[$pay_code]; echo $bank_data['name']; ?></p>
           <p><span class="pay_title">付款时间：</span><?php echo date("Y-m-d H:i:s");?> </p>
   </div><!--//buy_out-->
</div>
<div class="tg_intr_bottom"><img src="<?php echo $cssPath;?>/images/tg_intr_bottom.jpg" /></div>
</div><!--//w750-->
<div class="R-r-right">
	    &nbsp;&nbsp;
  </div>

<div class="clear_float"></div>
</div><!--main_con end-->