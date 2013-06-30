      <?php 
    		  $form=$this->beginWidget('EActiveForm', array(
	        'id'=>'',
          'action'=>"",
	        'enableAjaxValidation'=>false,
         ));
         echo CHtml::hiddenField("code",$code,array());
        ?>
<ul class="contacter">
	               
          	   	  <li><h3>我要留言</h3></li>
          	   	  <li class="contacter_flash"><?php $this->widget("FlashInfo");?></li>
          	   	  <li><div class="contacter_name"><span class="contacter_required">*</span>标题</div><div class="contacter_content"><?php echo $form->createText($model,"title",array());?></div><div class="contacter_error"><?php echo $model->getError("title");?></div></li>
          	   	  <li>
          	   	    <div class="contacter_name"><span class="contacter_required">*</span>类别</div><div class="contacter_content">
          	   	  	  <?php
          	   	  	     echo $form->createSelect($model,"message_type",$message_type,array());
          	   	  	  ?>
                    </div>
                    <div class="contacter_error"><?php echo $model->getError("message_type");?></div>
                  </li>
                  
                  <li><div class="contacter_name"><span class="contacter_required">*</span>姓名</div><div class="contacter_content"><?php echo $form->createText($model,"contacter",array());?></div><div class="contacter_error"><?php echo $model->getError("contacter");?></div></li>
                  
                  <li><div class="contacter_name"><span class="contacter_required">*</span>联系方式</div><div class="contacter_content"><?php echo $form->createText($model,"contacter_phone",array());?></div><div class="contacter_error"><?php echo $model->getError("contacter_phone");?></div></li>
                  
                  <li><div class="contacter_name"><span class="contacter_required">*</span>详细内容</div><div class="contacter_content"><?php echo $form->createTextarea($model,"comment",array());?></div><div class="contacter_error"><?php echo $model->getError("comment");?></div></li>
                  <?php if($code=="Y"){ ?>
                   <li><div class="contacter_name"><span class="contacter_required">*</span>验证码</div><div class="contacter_content"><?php echo EHtml::createText("imagecode",$imagecode,array());?></div><div class="contacter_code"><a onclick="document.getElementById('__code__').src = '<?php echo Yii::app()->homeUrl;?>/imagesecurity/code.php?id=' + ++ts; return false"><img id="__code__" src="<?php echo Yii::app()->homeUrl;?>/imagesecurity/code.php?id=<?php echo $ts; ?>" /></a></div><div class="contacter_error"><?php echo $model->getError("imagecode");?></div></li>
                  <?php } ?>
          	      <li><div class="contacter_button"><?php echo CHtml::submitButton("提交",array());?></div></li>
</ul>
<?php $this->endWidget(); ?>
 <script language="javascript">
					ts = "<?= $ts ?>";
					
</script>
