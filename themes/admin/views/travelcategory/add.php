<div id="page_content">
    <div class="show_right_content">
    <!--用户操作-->
    	<div><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("travelcategory/index");?>">返回到分类管理</a></span></div></div>
    <!--用户操作end-->
    <!--编辑框-->	
    	<div class="edit_content">
    		<?php 
    		  $form=$this->beginWidget('EActiveForm', array(
	        'id'=>'',
          'action'=>"",
	        'enableAjaxValidation'=>false,
         ));
         echo $form->hiddenField($model,"category_id");
         echo $form->hiddenField($model,"parent_id");
        ?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           <div class="content_title"><?php if($model->category_id) echo "修改分类"; else echo "添加分类"; ?></div>
           <div class="content_inline"><div class="content_name">名称:</div><div class="content_content"><?php echo $form->createText($model,"category_name",array());?></div><div class="content_error"><?php echo $form->error($model,'category_name'); ?></div></div>
	         <div class="content_inline"><div class="content_name">排序:</div><div class="content_content"><?php echo $form->createNumber($model,"sort_order",array());?></div><div class="content_error"><?php echo $form->error($model,'sort_order'); ?></div></div>

	         <div class="content_button"><input type="submit" class="input_submit" value="确定" name="button_ok"/><input type="reset" class="input_cancel" value="取消" name="button_reset"/>&nbsp;&nbsp;<a href="<?php echo $this->createUrl("travelcategory/add",array('pid'=>$model->parent_id));?>" class="input_submit">新增</a></div>
	   
    	<?php $this->endWidget(); ?>
    	</div>
    	 <!--编辑框end-->	
    </div>
</div>
