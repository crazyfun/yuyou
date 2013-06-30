
<div class="infor_box">
	
		 <?php 
		   $geterrors=$model->getErrors();
		   if(!empty($geterrors)){
		 ?>
		 <div class="flash_error">
		 	<?php
		   foreach($geterrors as $key => $value){
		 ?>
		    <span class="error_item"><?php echo $value[0];?></span>
		<?php }
		?>
		</div>
		<?php
	      }
	 ?>
	<?php $form=$this->beginWidget('EActiveForm', array(
        					'id'=>'login-form',
        					'action'=>$this->createUrl('login/pop'),
       						 'enableAjaxValidation'=>true,
   							)); 
   							echo CHtml::hiddenField("action","login",array());
   ?>
   
   <div class="login_left"><!--登录-->
      <h2 class="infor_title">登录</h2>
      
      <div class="d_box">
      	
        <ul>
           <li><span class="d_left"><span style="color:#FF0000">*</span>账号：</span><span class="d_right"><?php echo $form->createText($model,"user_login",array());?></span></li>
           <li><span class="d_left"><span style="color:#FF0000">*</span>密码：</span><span class="d_right"><?php echo $form->createPassword($model,"user_password",array());?></span></li>
           <li><span class="d_left"><span style="color:#FF0000">*</span>验证码：</span><span class="d_right"><?php echo $form->createText($model,"imagecode",array('class'=>"w80"));?></span><span class="d_right"><a onclick="document.getElementById('__code__').src = '<?php echo Yii::app()->homeUrl;?>/imagesecurity/code.php?id=' + ++ts; return false"><img id="__code__" src="<?php echo Yii::app()->homeUrl;?>/imagesecurity/code.php?id=<?php echo $ts; ?>" /></a></span></li>
         </ul>
         <input type="submit" class="d_bnt" value="登录"/>&nbsp;&nbsp;

     </div>   
  </div>
<?php $this->endWidget(); ?> 

   <div class="b_line"></div>
   <?php $form=$this->beginWidget('EActiveForm', array(
        					'id'=>'login-form',
        					'action'=>$this->createUrl('login/pop'),
       						 'enableAjaxValidation'=>true,
   							)); 
   							echo CHtml::hiddenField("action","registe",array());
   					
   	?>
   
   <div class="register_right"><!--注册-->
       <h2 class="infor_title">注册</h2>
       <div class="d_box">
       	
        <ul>
           <li><span class="d_left"><span style="color:#FF0000">*</span>用户邮箱：</span><span class="d_right"><?php echo $form->createText($model,"user_email",array());?></span></li>
           <li><span class="d_left"><span style="color:#FF0000">*</span>用户名：</span><span class="d_right"><?php echo $form->createText($model,"user_login",array());?></span></li>
           <li><span class="d_left"><span style="color:#FF0000">*</span>用户密码：</span><span class="d_right"><?php echo $form->createPassword($model,"user_password",array());?></span></li>
           <li><span class="d_left"><span style="color:#FF0000">*</span>确认密码：</span><span class="d_right"><?php echo $form->createPassword($model,"var_user_password",array());?></span></li>
         </ul>
         <input type="submit" class="d_bnt" value="注册"/>
         
     </div>   
   </div><!--//注册-->
   <?php $this->endWidget(); ?> 
</div>
 <script language="javascript">
					var ts = "<?= $ts ?>";
					
</script>