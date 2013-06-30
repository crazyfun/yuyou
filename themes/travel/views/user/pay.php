									<div class="membermsg"><!--站内消息-->
                     <b>【通知】</b>您有<font color="#FF0000"><?php $messages=Messages::model(); echo $messages->get_unread_message();?></font>条未读消息<a href="<?php echo $this->createUrl("user/message");?>">查看详情</a>
                    </div>
                    <div class="memberbody"><!--用户内容-->
                      <div class="memmoney">
                         <div class="monfs">
                          <div class="flash_info"><?php $this->widget("FlashInfo");?></div>
                  <?php 
    		 							$form=$this->beginWidget('EActiveForm', array(
	        								'id'=>'',
	        								'enableAjaxValidation'=>false,
	        								'htmlOptions'=>array('id'=>'pay_form'),
         							));
        					?>
        					  <div class="montitle"><span>网上支付</span>选择网银、支付宝、财付通、银联在线等方式进行充值，即时到账</div>
                    
                    <div class="bank_lists">
                    	  <?php
                    	     $pay_lists=array('kuaiqian_abc','kuaiqian_bcom','kuaiqian_boc','kuaiqian_ccb','kuaiqian_cmb','kuaiqian_cmbc','kuaiqian_icbc','kuaiqian_sdb');
                    	     $payment_type=CV::$payment_type;
                    	     foreach($pay_lists as $key => $value){ 
                    	         $bank_data=$payment_type[$value];
                    	  ?>
                    	  		<div class="bank_item"><span class="bank_radio"><?php echo CHtml::radioButton("type",false,array('value'=>$value));?></span><span class="bank_image"><?php echo CHtml::image($cssPath."/images/".$bank_data['image'],$bank_data['name'],array()); ?></span></div>
                    	  <?php } ?>
                    </div>
                    <div class="clear_both"></div>
                    <div class="montitle">
                    	  请选择其他合作支付平台进行支付
                    </div>
                     <div class="bank_lists">
                    	 <?php
                    	     $pay_lists=array('alipay','kuaiqian');
                    	     foreach($pay_lists as $key => $value){ 
                    	         $bank_data=$payment_type[$value];
                    	  ?>
                    	  		<div class="bank_item"><span class="bank_radio"><?php echo CHtml::radioButton("type",false,array('value'=>$value));?></span><span class="bank_image"><?php echo CHtml::image($cssPath."/images/".$bank_data['image'],$bank_data['name'],array()); ?></span></div>
                    	  <?php } ?>
                    	<span class="pay_error"><?php  echo $form->error($model,"type");?></span>
                    </div>
                    
                   <div class="clear_both"></div> 

										<div class="momzf">
													<div class="montop">输入充值金额:<?php echo $form->textField($model,"price",array());?>元(人民币) <span class="pay_error"><?php  echo $form->error($model,"price");?></span></div>
  												<div class="monbnt"><?php echo CHtml::submitButton("提交支付",array('class'=>'memberbnt2'));?></div>
										</div>

									<?php $this->endWidget(); ?>
                      </div>
                    </div>
                    </div>