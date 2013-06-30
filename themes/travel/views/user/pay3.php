              <div class="memberbody"><!--用户内容-->
                    	<div class="memberlibox">
        					       <div class="memberli"><!--头像-->
                        	   <?php $this->widget("FlashInfo");?>
                          </div>
                        	<div class="memberli"><!--头像-->
                        	   <div class="memberli_left">充值余额：</div>
                               <div class="memberli_right">
                               <?php echo $price;?>元（人民币）
                               	</div>
                            </div>
                            <div class="memberli"><!--真实姓名-->
                        	   <div class="memberli_left">充值方式：</div>
                               <div class="memberli_right"><?php  $payment_type=CV::$payment_type; $bank_data=$payment_type[$pay_code]; echo CHtml::image($cssPath."/images/".$bank_data['image'],$bank_data['name'],array()); ?></div>
                            </div>
                            
                             <div class="memberli"><!--真实姓名-->
                        	   <div class="memberli_left">充值时间：</div>
                               <div class="memberli_right"><?php echo date("Y-m-d H:i:s");?></div>
                            </div>
                           
                        </div>
                    </div>         