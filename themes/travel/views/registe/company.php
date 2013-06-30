<div class="main_con">
   <div class="js_left"><!--商家注册-->
     <h2>商家注册</h2>
       <div class="js_login">
       	 <?php 
       	 
    		  $form=$this->beginWidget('EActiveForm', array(
	        	'id'=>'',
          	'action'=>"",
	        	'enableAjaxValidation'=>false,
	        	'htmlOptions'=>array('id'=>'registe_from'),
         ));
				?>
           <ul>
          
           <li><span class="d_left"><span style="color:#FF0000">*</span>公司名称：</span><span class="d_right"><?php echo $form->createText($model,"company_name",array());?></span><span class="msg_er"><?php echo $form->error($model,"company_name");?></span> </li>
           <li><span class="d_left"><span style="color:#FF0000">*</span>公司性质：</span><span class="d_right"><?php echo $form->createSelect($model,"company_type",CV::$company_registe_type,array());?></span><span class="msg_er"><?php echo $form->error($model,"company_type");?></span></li>
           <li><span class="d_left"><span style="color:#FF0000">*</span>联系人：</span><span class="d_right"><?php echo $form->createText($model,"contact",array());?></span><span class="msg_er"><?php echo $form->error($model,"contact");?></span></li>
           <li><span class="d_left"><span style="color:#FF0000">*</span>联系电话：</span><span class="d_right"><?php echo $form->createText($model,"contact_phone",array());?></span><span class="msg_er"><?php echo $form->error($model,"contact_phone");?></span></li>
           <li><span class="d_left"><span style="color:#FF0000">*</span>所属区域：</span><span class="d_right"><?php echo $form->createAjaxselect($model,"region_id",array('title'=>'可直接选择城市或输入城市','type_value'=>'region','tabs'=>"[{'name':'城市','url':'/api/region','id':'','type':'region'}]",'serviceUrl'=>"/api/mixregion",'multi'=>false,'level'=>3));?></span><span class="msg_er"><?php echo $form->error($model,"region_id");?></span></li>
           <li><span class="d_left"><span style="color:#FF0000">*</span>公司座机：</span><span class="d_right"><?php echo $form->createText($model,"telephone",array());?></span><span class="msg_er"><?php echo $form->error($model,"telephone");?></span></li>
           <li><span class="d_left"><span style="color:#FF0000">*</span>公司地址：</span><span class="d_right"><?php echo $form->createText($model,"address",array());?></span><span class="msg_er"><?php echo $form->error($model,"address");?></span></li>
           <li><span class="d_left"><span style="color:#FF0000">*</span>交通指南：</span><span class="d_right"><?php echo $form->createText($model,"traffic",array());?></span><span class="msg_er"><?php echo $form->error($model,"traffic");?></span></li>
           <li><span class="d_left">公司坐标：</span><span class="d_right"><?php echo $form->createText($model,"coordinate",array('id'=>'coordinate','onclick'=>'javascript:baidu_maps();'));?></span><span class="msg_er"><?php echo $form->error($model,"coordinate");?></span></li>
           <li><span class="d_left">公司邮箱：</span><span class="d_right"><?php echo $form->createText($model,"email",array());?></span><span class="msg_er"><?php echo $form->error($model,"email");?></span></li>
           <li><span class="d_left">QQ1：</span><span class="d_right"><?php echo $form->createText($model,"qq1",array());?></span><span class="msg_er"><?php echo $form->error($model,"qq1");?></span></li>
           <li><span class="d_left">QQ2：</span><span class="d_right"><?php echo $form->createText($model,"qq2",array());?></span><span class="msg_er"><?php echo $form->error($model,"qq2");?></span></li>
           <li><span class="d_left">QQ3：</span><span class="d_right"><?php echo $form->createText($model,"qq3",array());?></span><span class="msg_er"><?php echo $form->error($model,"qq3");?></span></li>
           <li><span class="d_left">银行名称：</span><span class="d_right"><?php echo $form->createText($model,"bank_name",array());?></span><span class="msg_er"><?php echo $form->error($model,"bank_name");?></span></li>
           <li><span class="d_left">户名：</span><span class="d_right"><?php echo $form->createText($model,"bank_owner",array());?></span><span class="msg_er"><?php echo $form->error($model,"bank_owner");?></span></li>
           <li><span class="d_left">银行帐号：</span><span class="d_right"><?php echo $form->createText($model,"bank_account",array());?></span><span class="msg_er"><?php echo $form->error($model,"bank_account");?></span></li>
           <li><span class="d_left">&nbsp;</span><span class="d_right"><?php echo $form->createCheck($model,"agreement",array());?>&nbsp;我已经阅读并接受《<a href="javascript:show_agree();"><?php echo Yii::app()->name;?>商家服务条款</a>》</span><span class="msg_er"><?php echo $form->error($model,"agreement");?></span></li>
         </ul>
         <input type="submit" class="d_bnt" value="注册"/>
         
         <?php $this->endWidget(); ?>
       </div>
   </div><!--//商家注册-->
   <div class="js_right"><!--右边-->
     <p><img width="300" height="200" src="<?php echo $cssPath;?>/images/js1.jpg" /></p>
     <p><img width="300" height="200" src="<?php echo $cssPath;?>/images/js2.jpg" /></p>
     <p><img width="300" height="200" src="<?php echo $cssPath;?>/images/js3.jpg" /></p>
     <p><img width="300" height="200" src="<?php echo $cssPath;?>/images/js4.jpg" /></p>
     <p><img width="300" height="200" src="<?php echo $cssPath;?>/images/js5.jpg" /></p>

   </div><!--//右边-->
   <div class="clear_float"></div>
</div>

<script language="javascript">
    	
        function baidu_maps(){
        	var address=document.getElementById("coordinate").value;
        	set_bmap(address);
        	
        }
        
        
         function show_agree(){
         	  jQuery.jBox("iframe:/registe/companyagreement", {
   						 title: "商家协议",
    					 width: 800,
    					 height: 500,
    						buttons: { '关闭': true }
							});
         }
 </script> 