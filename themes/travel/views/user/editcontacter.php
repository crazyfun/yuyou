
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
         							echo $form->createHidden($model,"user_id",array());
        					?>
        					
        					       <div class="memberli"><!--头像-->
                        	   <?php $this->widget("FlashInfo");?>
                          </div>
                        	
                          <div class="memberli"><!--真实姓名-->
                        	   <div class="memberli_left">联系人姓名：</div>
                               <div class="memberli_right"><?php echo $form->createText($model,"contacter",array());?></div>
                               <div class="msg_er"><?php echo $form->error($model,"contacter");?></div><!--提示信息-->
                            </div>
                            <div class="memberli"><!--性别-->
                        	   <div class="memberli_left">联系电话：</div>
                               <div class="memberli_right"><?php echo $form->createText($model,"contacter_phone",array());?></div>
                               <div class="msg_er"><?php echo $form->error($model,"contacter_phone");?></div>
                            </div>
                          <div class="memberli">
                        	   <div class="memberli_left">证件类型：</div>
                              <div class="memberli_right"><?php echo $form->createSelect($model,"code_type",CV::$code_type,array());?></div>
                              <div class="msg_er"><?php echo $form->error($model,"code_type");?></div>
                            </div>
                            <div class="memberli">
                        	   <div class="memberli_left">证件号码：</div>
                              <div class="memberli_right"><?php echo $form->createText($model,"code_value",array());?></div>
                              <div class="msg_er"><?php echo $form->error($model,"code_value");?></div>
                            </div>
 
                            <div class="memberli">
                        	   <div class="memberli_left">是否是儿童：</div>
                              <div class="memberli_right"><?php echo $form->createCheck($model,"is_child",array('value'=>'1'));?></div>
                              <div class="msg_er"><?php echo $form->error($model,"is_child");?></div>
                            </div>

                            <div class="mbntbox">
                            	<?php echo CHtml::submitButton("保存",array('class'=>'memberbnt2'));?>
                            	<?php echo CHtml::resetButton("重置",array('class'=>'memberbnt3'));?>
                            </div>
                            
                            <?php $this->endWidget(); ?> 
                        </div>
                    </div>              