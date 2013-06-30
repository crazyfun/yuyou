<?php echo $ucsynlogin;?>
<div class="main_con">
<div class="content">
	<div class="regsiter"><!--会员注册-->
    <div class="membertop"><img src="<?php echo $cssPath;?>/images/page_top.gif" /></div>
     <div class="membercontent">
    	<div class="reg_top"><img src="<?php echo $cssPath;?>/images/re_step2.gif" /></div>
        <div class="memres_info"><!--个人资料-->
        	
        	<?php 
    	    $cssPath=$this->get_css_path(); 
    		  $form=$this->beginWidget('EActiveForm', array(
	        'id'=>'',
          'action'=>$this->createUrl("registe/registe2"),
	        'enableAjaxValidation'=>false,
	        'htmlOptions'=>array('id'=>'registe_from'),
         ));
         echo $form->createHidden($model,"id",array());

        ?>
        <div class="memberlibox">
                        	<div class="memberli"><!--头像-->
                        	     <div class="memberli_left">头像：</div>
                               <div class="memberli_right">
                               	  <?php echo $uc_avatarflash; ?>
          
                               	</div>
                            </div>
                          <div class="memberli"><!--真实姓名-->
                        	   <div class="memberli_left">真实姓名：</div>
                               <div class="memberli_right"><?php echo $form->createText($model,"real_name",array());?></div>
                               <div class="msg_er"><?php echo $form->error($model,"real_name");?></div> 
                               
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
                        	   <div class="memberli_left">地址：</div>
                              <div class="memberli_right"><?php echo $form->createText($model,"address",array('class'=>'input02'));?></div>
                              <div class="msg_er"><?php echo $form->error($model,"address");?></div>
                            </div>
                            <div class="mbntbox">
                            <?php echo CHtml::submitButton("保存",array('class'=>'memberbnt2'));?>	
                        	  <a href="<?php echo $this->createUrl("registe/registe3"); ?>" class="mbnta">跳过此步</a></div>
                        </div>  
                        
               <?php $this->endWidget(); ?>         
        </div>
        <div style="clear:both"></div>
    </div>
    <div class="memberbot"><img src="<?php echo $cssPath;?>/images/page_bot.gif" /></div>
    </div>

</div>
<!--end content-->
</div>