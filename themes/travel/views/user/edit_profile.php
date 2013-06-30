<?php
	$config_values=ConfigValues::model();
  $investment_style_select=$config_values->get_ralation_values('8');
  
?>
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
                        	   <div class="memberli_left">头像：</div>
                               <div class="memberli_right">
                               	<?php echo $uc_avatarflash; ?>
                               	</div>
                            </div>
                          <div class="memberli"><!--真实姓名-->
                        	   <div class="memberli_left">真实姓名：</div>
                               <div class="memberli_right"><?php echo $form->createText($model,"real_name",array());?></div>
                               <div class="msg_er"><?php echo $form->error($model,"real_name");?></div><!--提示信息-->
                            </div>
                            <div class="memberli"><!--性别-->
                        	   <div class="memberli_left">性别：</div>
                               <div class="memberli_right"><?php echo $form->createSelect($model,"genter",CV::$sex,array());?></div>
                               <div class="msg_er"><?php echo $form->error($model,"genter");?></div>
                            </div>
                          <div class="memberli">
                        	   <div class="memberli_left">生日：</div>
                              <div class="memberli_right"><?php echo $form->createDate($model,"birthday",array());?></div>
                              <div class="msg_er"><?php echo $form->error($model,"birthday");?></div>
                            </div>
                            <div class="memberli">
                        	   <div class="memberli_left">手机号码：</div>
                              <div class="memberli_right"><?php echo $form->createText($model,"cell_phone",array());?></div>
                              <div class="msg_er"><?php echo $form->error($model,"cell_phone");?></div>
                            </div>
 
                            <div class="memberli">
                        	   <div class="memberli_left">身份证号码：</div>
                              <div class="memberli_right"><?php echo $form->createText($model,"code",array());?></div>
                              <div class="msg_er"><?php echo $form->error($model,"code");?></div>
                            </div>
                            
                            
                            <div class="memberli">
                        	   <div class="memberli_left">地址：</div>
                              <div class="memberli_right"><?php echo $form->createText($model,"address",array());?></div>
                               <div class="msg_er"><?php echo $form->error($model,"address");?></div>
                            </div>
                            <div class="mbntbox">
                            	<?php echo CHtml::submitButton("修改",array('class'=>'memberbnt2'));?>
                            	<?php echo CHtml::resetButton("重置",array('class'=>'memberbnt3'));?>
                            </div>
                            
                            <?php $this->endWidget(); ?> 
                        </div>
                    </div>              