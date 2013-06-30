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
                        	   <?php $this->widget("FlashInfo");?>
                            </div>
                            <div class="memberli martop20">
                        	   <div class="memberli_left"><span style="color:#FF0000">*</span>新密码：</div>
                              <div class="memberli_right"><?php echo $form->createText($model,"new_password",array('class'=>"input02"));?></div>
                              <div class="msg_er"><?php echo $form->error($model,"new_password");?></div>
                            </div>
                            <div class="memberli martop20">
                        	   <div class="memberli_left"><span style="color:#FF0000">*</span>确认新密码：</div>
                              <div class="memberli_right"><?php echo $form->createText($model,"con_new_password",array());?></div>
                              <div class="msg_er"><?php echo $form->error($model,"con_new_password");?></div>
                            </div>
                            <div class="mbntbox martop20"><!--按钮-->
                            	<?php echo CHtml::submitButton("确认",array('class'=>'memberbnt2'));?>
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
		 <script language="javascript">
       	   jQuery(function(){
       	   	   var validate_flag="<?= $validate_flag ?>";
       	   	   if(validate_flag){
       	   	   	 window.setTimeout(function(){window.location.href="login/index";},2000);
       	   	   }
       	  });
       </script>
</div>
    
    
    
    



