<?php
  $hotels_order=HotelsOrder::model();
  $hotels_order_data=$hotels_order->findByPk($model->order_id);
  $payment_type=CV::$travel_payment_type;
  $pay_type=array();
  foreach($payment_type as $key => $value){ 
   $pay_type[$key]=$value['name'];     
  }
?>
<div id="page_content">
    <div class="show_right_content">
    <!--用户操作-->
    	<div class=""><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("index",array());?>">返回到订单管理</a></span></div></div>
    <!--用户操作end-->
    <!--编辑框-->	
    	<div class="edit_content">
    		 <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
    		 <?php 
    		     $form = $this->beginWidget('EActiveForm', array('action'=>"",'enableAjaxValidation'=>false,'htmlOptions'=>array('enctype'=>'multipart/form-data')));
    		     echo $form->createHidden($model,'id',array());
    		     echo $form->createHidden($model,'order_id',array());
    		  ?>
           <div class="content_inline">
           	 <div class="content_name">订单总额</div>
           	 <div class="content_content"><?php echo $hotels_order_data->total_price;?></div>
           	 <div class="content_error"></div>
           </div>
	
            <div class="content_inline">
           	 <div class="content_name">付款方式</div>
           	 <div class="content_content"><?php echo $form->createSelect($model,"type",$pay_type,array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'type');?></div>
           </div>
           <div class="content_inline">
           	 <div class="content_name">备注</div>
           	 <div class="content_content"><?php echo $form->createTextarea($model,"comment",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'comment');?></div>
           </div>
           <div class="content_button">
	         	 <input type="submit" class="input_submit" value="确定已付款" name="button_ok"/>
	        </div>
	     <?php $this->endWidget();?>
    	  </div>
    	 <!--编辑框end-->	
    </div>
</div>

