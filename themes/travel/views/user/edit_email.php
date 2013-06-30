               <div class="membermsg"><!--站内消息-->
                     <b>【通知】</b>您有<font color="#FF0000"><?php $messages=Messages::model(); echo $messages->get_unread_message();?></font>条未读消息<a href="<?php echo $this->createUrl("user/message");?>">查看详情</a>
                    </div>
                    <div class="memberbody"><!--用户内容-->
                    	<div class="memberlibox">
                    		
                  <?php 
    		 							$form=$this->beginWidget('EActiveForm', array(
	        								'id'=>'',
          								'action'=>"",
	        								'enableAjaxValidation'=>false,
	        								'htmlOptions'=>array('id'=>'registe_from'),
         							));
         							echo $form->createHidden($model,"id",array());
        					?>
        					
        					       <div class="memberli"><!--头像-->
                        	   <?php $this->widget("FlashInfo");?>
                          </div>
                        	<div class="memberli"><!--头像-->
                        	   <div class="memberli_left">邮箱：</div>
                               <div class="memberli_right">
                               	<?php echo $user_email;?>
                               	</div>
                            </div>
                          <div class="memberli"><!--真实姓名-->
                        	   <div class="memberli_left"><span class="memberli_required">*</span>新邮箱：</div>
                               <div class="memberli_right"><?php echo $form->createText($model,"user_email",array());?></div>
                               <div class="msg_er"><?php echo $form->error($model,"user_email");?></div><!--提示信息-->
                            </div>

                            <div class="mbntbox">
                            	<?php echo CHtml::submitButton("修改",array('class'=>'memberbnt2'));?>
                            	<?php echo CHtml::resetButton("重置",array('class'=>'memberbnt3'));?>
                            </div>
                            
                            <?php $this->endWidget(); ?> 
                        </div>
                    </div>              
                 
    
    



    
    
    
    
    



