<?php 
  $cssPath=$this->controller->get_css_path();
?>
<!--HOLD旅游登录界面 五-->
<body class="login_body">
	
	
<div class="b_top_bg">
<div class="b_top">
    <div class="b_logo">&nbsp;</div>
    <div class="b_text">
         
    </div>
</div>
</div><!--//头部-->
<div class="b_con_bg">
  <div class="b_con_box">
          <div class="b_con_loginbox"><!--登录框-->
             <div class="b_con_login">
               <h2><span><a href="/login/index">会员登录</a></span><span><a href="javascript:void(0);" class="b_ona">商户登录</a></span></h2>
               <div class="b_login_li"> 
               	<?php $form=$this->beginWidget('CActiveForm', array(
        					'id'=>'login-form',
        					'enableAjaxValidation'=>true,
        				)); ?>
                 <ul>
                   <li><span class="d_left">账号：</span><span class="d_right"><?php echo $form->textField($model,"user_email",array("class"=>"w_mz"));?></span><span class="msg_er"><?php echo $form->error($model,"user_email");?></span></li>
                   <li><span class="d_left">密码：</span><span class="d_right"><?php echo $form->passwordField($model,"user_password",array("class"=>"w_mz"));?></span><span class="msg_er"><?php echo $form->error($model,"user_password");?></span></li>
                   <li><span class="d_left">验证码：</span><span class="d_right"><?php echo $form->textField($model,"imagecode",array("class"=>"w_mz"));?></span><span class="d_right"><a onclick="document.getElementById('__code__').src = 'http://admin.lypub.com/imagesecurity/code.php?id=' + ++ts; return false"><img id="__code__" src="<?php echo 'http://admin.lypub.com/imagesecurity/code.php?id='.$ts;?>" /></a></span><span class="msg_er"><?php echo $form->error($model,"imagecode");?></span></li>
                   <li><span class="d_left">&nbsp;</span><span class="d_right">两周内不再登录<?php echo $form->checkBox($model,'rememberme',array('class'=>'content_checkbox'));?></span><span class="msg_er"></span></li>
                 </ul>
                 <?php echo CHtml::submitButton("登录",array('class'=>"d_bnt"));?>
                 <?php $this->endWidget(); ?>
               </div>
               <!--//b_login_li-->
            </div>
          </div>
          
           <div style="clear:both"></div>
          
  </div>
 <div style="clear:both"></div>
</div>
</body>
<script language="javascript">
	ts = "<?= $ts ?>";
</script>