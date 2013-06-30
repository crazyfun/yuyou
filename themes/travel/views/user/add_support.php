<?php 
  $config_values=ConfigValues::model();
  $type=$config_values->get_ralation_values(10);

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
	        								'htmlOptions'=>array('id'=>'registe_from','enctype'=>'multipart/form-data'),
         							));
        					?>
        					
        					       <div class="memberli">
                        	   <?php $this->widget("FlashInfo");?>
                          </div>
                        	
                          <div class="memberli"><!--真实姓名-->
                        	   <div class="memberli_left">标题：</div>
                               <div class="memberli_right"><?php echo $form->createText($model,"title",array());?></div>
                               <div class="msg_er"><?php echo $form->error($model,"title");?></div><!--提示信息-->
                            </div>
                            <div class="memberli"><!--性别-->
                        	   <div class="memberli_left">类型：</div>
                               <div class="memberli_right"><?php echo $form->createSelect($model,"type",$type,array());?></div>
                               <div class="msg">问题类型请正确选择，这将直接影响处理程度</div>
                               <div class="msg_er"><?php echo $form->error($model,"type");?></div>
                            </div>
                          <div class="memberli">
                        	   <div class="memberli_left">相关链接：</div>
                              <div class="memberli_right"><?php echo $form->createText($content_model,"href",array());?></div>
                              <div class="msg_er"><?php echo $form->error($content_model,"href");?></div>
                            </div>
                            <div class="memberli">
                        	   <div class="memberli_left">详细内容：</div>
                              <div class="memberli_right"><?php echo $form->createTextarea($content_model,"content",array());?></div>
                              <div class="msg_er"><?php echo $form->error($content_model,"content");?></div>
                            </div>
 
                            <div class="memberli">
                        	   <div class="memberli_left">图片附件：</div>
                              <div class="memberli_right"><?php echo $form->createFile($content_model,"image",array());?></div>
                              <div class="msg_er"><?php echo $form->error($content_model,"image");?></div>
                            </div>
                            
                          
                            <div class="mbntbox">
                            	<?php echo CHtml::submitButton("提交",array('class'=>'memberbnt2'));?>
                            	
                            </div>
                            
                            <?php $this->endWidget(); ?> 
                        </div>
                    </div>                               