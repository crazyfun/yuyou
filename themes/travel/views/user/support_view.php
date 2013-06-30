
                    <div class="membermsg"><!--站内消息-->
                        问题详情
                    </div>
                    <div class="memberbody"><!--用户内容-->
                    	<div class="memberlibox">
                        		<div class="memberli">
                        	   	<div class="memberli_left">标题：</div>
                               <div class="memberli_right"><?php echo $model->title;?></div>
                            </div>
                            <div class="memberli">
                        	   	 <div class="memberli_left">类型：</div>
                               <div class="memberli_right"><?php echo $model->ConfigValues->name;?></div> 
                            </div>
               
                        
     <div class="ms_nr">                      	
       <?php foreach($support_content_data as $key => $value){ ?>               
          <div class="submess_text">
              <div class="message_comment"><?php echo $value->content;?></div>
              <div class="m_time"><?php if(!empty($value->href)){?><a href="<?php echo $value->href;?>" title="<?php echo $value->href;?>" target="_blank">查看链接</a><?php } ?><?php if(!empty($value->image)){?>&nbsp;&nbsp;<a title="<?php echo $value->image;?>" href="<?php echo "/".$value->image;?>" target="_blank">查看附件</a><?php } ?>&nbsp;&nbsp;提交时间：<?php echo date("Y-m-d H:i:s",$value->create_time);?></div>
              <?php if(!empty($value->reply_content)){ ?>
              <div class="support_messbg">
                	<div class="messtext">
                		  <div class="m_reply"><?php echo $value->ReplyUser->user_login;?>回复：</div>
                    	<?php echo $value->reply_content;?>
                    	<div class="m_time">回复时间：<?php echo date("Y-m-d H:i:s",$value->reply_time);?></div>
                  </div>  
              </div>
          <?php } ?>
          </div>
      <?php } ?>
   </div>
                            
                                   
                
                        </div>
                    </div>        
                    
                    <div class="membermsg"><!--站内消息-->
                        附加问题
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
         							echo CHtml::hiddenField("id",$model->id,array());
        					?>
        					
        					       <div class="memberli">
                        	   <?php $this->widget("FlashInfo");?>
                          </div>
                        	
                          <div class="memberli"><!--真实姓名-->
                        	   <div class="memberli_left">相关链接：</div>
                               <div class="memberli_right"><?php echo $form->createText($content_model,"href",array());?></div>
                               <div class="msg_er"><?php echo $form->error($content_model,"href");?></div><!--提示信息-->
                            </div>
                            <div class="memberli"><!--性别-->
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
                    	
                      