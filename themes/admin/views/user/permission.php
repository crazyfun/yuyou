   
   <!--编辑框-->	
    	<div class="edit_content">
    		<?php 
    		  $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'',
          'action'=>"",
	        'enableAjaxValidation'=>false,
         ));
        echo CHtml::hiddenField("user_id",$user_id,array());
        ?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           
	         <div class="content_inline"><div class="content_name">选择角色:</div><div class="content_content">
	         	   <?php echo EHtml::selectCreate("multi","permission_value",$select_permission,$permission_datas,array()); ?>
	         	   
	         </div><div class="content_error"></div></div>
	         <div class="content_button"><?php echo CHtml::submitButton("submit",array("name"=>"button_ok","id"=>"button_ok","value"=>"确定",'class'=>'input_submit'));?><?php echo CHtml::resetButton("reset",array("name"=>"button_reset","id"=>"button_reset","value"=>"取消",'class'=>"input_cancel"));?></div>
	   
    	<?php $this->endWidget(); ?>
    	</div>
    	 <!--编辑框end-->	

    
    



    
    
    
    
    



