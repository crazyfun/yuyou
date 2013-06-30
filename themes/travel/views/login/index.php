<div class="main_con">
<div class="content">
	<div class="login_bg"><!--登录-->
		
		
						<?php $form=$this->beginWidget('EActiveForm', array(
        					'id'=>'login-form',
        					'action'=>$this->createUrl('login/index'),
       						 'enableAjaxValidation'=>true,
   							)); ?>
            <div class="b_con_login">
               <h2><span><a href="javascript:void(0);" class="b_ona">会员登录</a></span><span><a href="/station.php" >商户登录</a></span></h2>
               <div class="b_login_li"> 
                 <ul>
                   <li><span class="d_left">账号：</span><span class="d_right"><?php echo $form->createText($model,"user_login",array());?></span><span class="msg_er"><?php echo $form->error($model,"user_login");?></span></li>
                   <li><span class="d_left">密码：</span><span class="d_right"><?php echo $form->createPassword($model,"user_password",array());?></span><span class="msg_er"><?php echo $form->error($model,"user_password");?></span></li>
                   <li><span class="d_left">验证码：</span><span class="d_right"><?php echo $form->createText($model,"imagecode",array('class'=>"yz_input"));?></span>&nbsp;&nbsp;<span class="d_right"><a onclick="document.getElementById('__code__').src = '<?php echo Yii::app()->homeUrl;?>/imagesecurity/code.php?id=' + ++ts; return false"><img id="__code__" src="<?php echo Yii::app()->homeUrl;?>/imagesecurity/code.php?id=<?php echo $ts; ?>" /></a></span><span class="msg_er"><?php echo $form->error($model,"imagecode");?></span></li>
                 </ul>
                  <div class="mbntbox martop20">
                		 <?php echo CHtml::submitButton("登录",array('class'=>'memberbnt2'));?>
                 		<a href="<?php echo $this->createUrl("registe/index");?>" class="memberbnt3">立即注册</a>
                 	</div>
               </div>
               <!--//b_login_li-->
            </div>
            <?php $this->endWidget(); ?> 
            
            

    </div>
</div>
<!--end content-->
</div>
 <script language="javascript">
					var ts = "<?= $ts ?>";
					
</script>