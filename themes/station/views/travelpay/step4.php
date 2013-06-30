	<div class="main_con">
  	<div class="order_top order_top4"></div>
    <div class="ord_hintbox ord_info">
    	   <?php $this->widget("FlashInfo");?>
    	   <p><span class="pay_title">订单号：</span><?php $travel_order_serial=TravelOrderSerial::model();$travel_order_serial_data=$travel_order_serial->find('t.order_id=:order_id',array(':order_id'=>$model->id)); echo $travel_order_serial_data->order_serial;  ?></p> 
         <p><span class="pay_title">线路名称：</span><a  href="<?php echo $this->createUrl("travel/show",array("id"=>$model->Travel->id));?>" target="_blank"><?php echo $model->Travel->title;?></a></p> 
         <p><span class="pay_title">出发时间：</span><?php echo $model->travel_date;?> </p>
         <p><span class="pay_title">总额：</span>¥<?php echo $model->total_price;?>元 </p>
         <p><span class="pay_title">总结算额：</span>¥<?php  $total_settle_price=$model->get_total_settle_price($model->id);echo $total_settle_price;?>元 </p>
         <p><span class="pay_title">利润：</span><?php echo ($model->total_price-$total_settle_price);?>元</p>
    </div><!--//ord_hintbox-->
      
</div>
             
              