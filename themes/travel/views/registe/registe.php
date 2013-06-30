    <?php Yii::app()->clientScript->registerScriptFile('/js/validate.js');?>
<div class="main_con">
  <div class="content">
	<div class="regsiter"><!--会员注册-->
    <div class="membertop"><img src="<?php echo $cssPath;?>/images/page_top.gif" /></div>
     <div class="membercontent">
    	<div class="reg_top"><img src="<?php echo $cssPath;?>/images/re_step1.gif" /></div>
        <div class="memres_info"><!--个人资料-->
        	<div class="memberlibox">
        		 <?php 
    		  $form=$this->beginWidget('EActiveForm', array(
	        	'id'=>'',
          	'action'=>"",
	        	'enableAjaxValidation'=>false,
	        	'htmlOptions'=>array('id'=>'registe_from'),
         ));
         $errors=$model->getErrors();
         $errors_class=array();
         foreach($errors as $key => $value){
         	 if(!empty($value)){
         	 	 $errors_class[$key]="validate_error";
         	 }
         }
				?>
        	                  <div class="memberli martop20"><!--真实姓名-->
                        	    <div class="memberli_left"><span style="color:#FF0000">*</span>用户邮箱：</div>
                               <div class="memberli_right"><?php echo $form->createText($model,"user_email",array());?></div>
                               <div id="user_email_tip" class="<?php echo $errors_class['user_email'];?>"><?php echo $form->error($model,"user_email");?></div> 
                            </div>
                            <div class="memberli martop20">
                        	   <div class="memberli_left"><span style="color:#FF0000">*</span>用户名：</div>
                              <div class="memberli_right"><?php echo $form->createText($model,"user_login",array());?></div>
                              <div  id="user_login_tip" class="<?php echo $errors_class['user_login'];?>"><?php echo $form->error($model,"user_login");?></div> 
                            </div>
                            <div class="memberli martop20">
                        	   <div class="memberli_left"><span style="color:#FF0000">*</span>用户密码：</div>
                              <div class="memberli_right"><?php echo $form->createPassword($model,"user_password",array());?></div>
                              <div  id="user_password_tip" class="<?php echo $errors_class['user_password'];?>"><?php echo $form->error($model,"user_password");?></div> 
                            </div>
                            <div class="memberli martop20">
                        	   <div class="memberli_left"><span style="color:#FF0000">*</span>确认密码：</div>
                              <div class="memberli_right"><?php echo $form->createPassword($model,"var_user_password",array());?></div>
                              <div  id="var_user_password_tip" class="<?php echo $errors_class['var_user_password'];?>"><?php echo $form->error($model,"var_user_password");?></div> 
                            </div>
                            
                            <div class="memberli martop20">
                        	    <div class="memberli_left">&nbsp;</div>
                              <div class="memberli_right"><?php echo $form->createCheck($model,"agreement",array());?>&nbsp;我已经阅读并接受《<a href="javascript:show_agree();"><?php echo Yii::app()->name;?>服务条款</a>》</div>
                              <div id="user_agreement_tip" class="<?php echo $errors_class['agreement'];?>"><?php echo $form->error($model,"agreement");?></div> 
                            </div>

                            <div class="mbntbox martop20"><!--按钮-->
                            	<?php echo CHtml::submitButton("确认注册",array('class'=>'memberbnt2'));?>
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
    <script language="javascript">
    		 jQuery(function($) {
           var validate_obj=new validate([
              {
               'tip_id':'user_login_tip',
               'id':"User_user_login",//验证的ID
               'tip':true,//提示
               'tip_message':'请输入用户名',//提示内容
               'validate':
                 {
                 	'validate_type':'ajax',//验证类型
                 	'validate_url':"/registe/validate/action/userlogin"//验证
                 	
                 }
               
              },
              {
               'tip_id':'user_password_tip',
               'id':"User_user_password",//验证的ID
               'tip':true,//提示
               'tip_message':'请输入密码',//提示内容
               'validate':
                 {
                 	'validate_type':'required',//验证类型
                 	'validate_message':'密码不能为空'//当验证类型是ajax不需要验证内容
                 }
               
              },
              
              {
               'tip_id':'var_user_password_tip',
               'id':"User_var_user_password",//验证的ID
               'tip':true,//提示
               'tip_message':'请输入确认密码',//提示内容
               'validate':
                 {
                 	'validate_type':'compare',//验证类型
                 	'compare_id':'User_user_password',
                 	'validate_message':'确认密码错误'//当验证类型是ajax不需要验证内容
                 }
               
              },
              

              {
               'tip_id':'user_email_tip',
               'id':"User_user_email",//验证的ID
               'tip':true,//提示
               'tip_message':'请输入邮箱',//提示内容
               'validate':
                 {
                 	'validate_type':'ajax',//验证类型
                 	'validate_url':"/registe/validate/action/useremial"//验证
                 	
                 }
               
              },
              
               {
               'tip_id':'real_name_tip',
               'id':"User_real_name",//验证的ID
               'tip':true,//提示
               'tip_message':'请输入真实姓名',//提示内容
               'validate':
                 {
                 	'validate_type':'required',//验证类型
                 	'validate_message':'真实姓名不能为空'//当验证类型是ajax不需要验证内容
                 }
               
              }
  
           ]);
         }); 
         
         function show_agree(){
         	  jQuery.jBox("iframe:/registe/agreement", {
   						 title: "会员协议",
    					 width: 800,
    					 height: 500,
    						buttons: { '关闭': true }
							});
         }

    	</script>