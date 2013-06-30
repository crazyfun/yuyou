
<div class="main_con">
  	<div class="order_top order_top5"></div>
    <div class="ord_hintbox ord_info">
    	   <?php $this->widget("FlashInfo");?>
         <p><span class="pay_title">付款额：</span>¥<?php echo $price;?>元</p> 
         <p><span class="pay_title">付款方式：</span><?php  $payment_type=CV::$travel_payment_type; $bank_data=$payment_type[$pay_code]; echo $bank_data['name']; ?></p>
         <p><span class="pay_title">付款时间：</span><?php echo date("Y-m-d H:i:s");?> </p>
        
    </div><!--//ord_hintbox-->
</div>

              