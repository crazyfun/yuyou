<div class="main_con">
<div class="content">
	<div class="regsiter"><!--会员注册-->
    <div class="membertop"><img src="<?php echo $cssPath;?>/images/page_top.gif" /></div>
     <div class="membercontent">
        <div class="memres_info"><!--个人资料-->
        	<div class="memberlibox">
        		 <?php 
    		  $form=$this->beginWidget('EActiveForm', array(
	        	'id'=>'',
          	'action'=>"",
	        	'enableAjaxValidation'=>false,
	        	'htmlOptions'=>array('id'=>'registe_from'),
         ));
       
				?>
                            <div class="memberli martop20">
                        	   <div class="memberli_left"><span style="color:#FF0000">*</span>用户名：</div>
                              <div class="memberli_right"><?php echo $form->createText($model,"user_login",array());?></div>
                              <div class="msg_er"><?php echo $form->error($model,"user_login");?></div>
                            </div>
                            <div class="memberli martop20">
                        	   <div class="memberli_left"><span style="color:#FF0000">*</span>用户邮箱：</div>
                              <div class="memberli_right"><?php echo $form->createText($model,"user_email",array());?></div>
                              <div class="msg_er"><?php echo $form->error($model,"user_email");?></div>
                            </div>
                           
                            <div class="mbntbox martop20"><!--按钮-->
                            	<?php echo CHtml::submitButton("提交",array('class'=>'memberbnt2'));?>
                            </div>
                            
                <?php $this->endWidget(); ?>            
            </div> 
                        
                         
        </div>
        <div style="clear:both"></div>
    </div>
    <div class="memberbot"><img src="<?php echo $cssPath;?>/images/page_bot.gif" /></div>
    </div>

</div>
<!--end content--> 
</div> 


    
    
    
    



