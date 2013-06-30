<div id="page_content">
    <div class="show_right_content">
    <!--用户操作-->
    	<div><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("hotelsbeds/index",array('hotels_id'=>$model->hotels_id));?>">返回到房型管理</a></span></div></div>
    <!--用户操作end-->
    <!--编辑框-->	
    	<div class="edit_content">
    		<?php 
    		  $form=$this->beginWidget('EActiveForm', array(
	        'id'=>'',
          'action'=>"",
	        'enableAjaxValidation'=>false,
         ));
         echo $form->hiddenField($model,"id",array());
         echo $form->hiddenField($model,"hotels_id",array());
        ?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           <div class="content_title"><?php if($model->id) echo "修改房型"; else echo "添加房型"; ?></div>
           <div class="content_inline"><div class="content_name">房型名称:</div><div class="content_content"><?php echo $form->createText($model,"name",array());?></div><div class="content_error"><?php echo $form->error($model,'name'); ?></div></div>
	         <div class="content_button"><input type="submit" class="input_submit" value="确定" name="button_ok"/><input type="reset" class="input_cancel" value="取消" name="button_reset"/></div>
	   
    	<?php $this->endWidget(); ?>
    	</div>
    	 <!--编辑框end-->	
    </div>
</div>

    



    
    
    
    
    



