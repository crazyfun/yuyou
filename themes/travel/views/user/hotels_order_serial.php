<?php if($is_order_serial){ ?>                   
 <div class="zf_box">
   <div class="zf_main">
      <p>您的订单号为<font size="14px;" color="#ff0000;"><?php echo $order_serial;?></font>,请牢记你的订单号以便顺利出游。</p>
   </div>
</div>
<?php }else{ ?>
                  <?php 
    		 							$form=$this->beginWidget('EActiveForm', array(
	        								'id'=>'',
          								'action'=>"",
	        								'enableAjaxValidation'=>false,
	        								'htmlOptions'=>array('id'=>'registe_from'),
         							));
         							echo CHtml::hiddenField("id",$id,array());
         							echo CHtml::hiddenField("action","send",array());
        					?>
        					 <div class="zf_box">
   								<div class="zf_main">
        					<div class="memberli">
                        	   <?php $this->widget("FlashInfo");?>
                          </div>
                          <div class="memberli"><!--真实姓名-->
                          	<div class="memberli_left">支付密码：</div>
                               <div class="memberli_right"><?php echo CHtml::passwordField("pay_password",'',array());?></div>
                            </div>
                            
                            <div class="mbntbox">
                            	<?php echo CHtml::submitButton("查看",array('class'=>'memberbnt2'));?>
                  </div>
                 </div>
</div>
 <?php $this->endWidget(); ?> 
<?php } ?>  


                               