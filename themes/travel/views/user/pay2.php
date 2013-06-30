                 <div class="memberbody"><!--用户内容-->
                    	<div class="memberlibox">
                    			<div class="memberli">
                    				  <?php $this->widget("FlashInfo");?>
                    			</div>
                        	<div class="memberli">
                        	   <div class="memberli_left">余额：</div>
                               <div class="memberli_right"><?php echo $model->conpon;?></div>
                            </div>
                            <div class="memberli">
                        	   <div class="memberli_left">您选择的支付方式：</div>
                               <div class="memberli_right"><?php  $payment_type=CV::$payment_type; $bank_data=$payment_type[$banker]; echo CHtml::image($cssPath."/images/".$bank_data['image'],$bank_data['name'],array()); ?></div>
                            </div>
                            <div class="memberli">
                        	   <div class="memberli_left">充值余额：</div>
                               <div class="memberli_right"><?php echo $price;?>元（人民币）</div>
                            </div>
                            <div class="mbntbox">
                                <?php echo $pay_online;?>
                            </div>
                          
                         
                        </div>
                    
                    </div>                