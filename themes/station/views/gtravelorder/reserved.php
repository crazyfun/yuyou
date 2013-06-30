

<div id="page_content">
    <div class="show_right_content">
    <!--用户操作-->
    	
    <!--用户操作end-->
    <!--编辑框-->	
    	<div class="edit_content">
    		
    		
    		 <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
    		 <?php 
    		     $form = $this->beginWidget('EActiveForm', array('action'=>"",'enableAjaxValidation'=>false,'htmlOptions'=>array('enctype'=>'multipart/form-data')));
    		     echo $form->createHidden($model,'id',array());
    		     echo CHtml::hiddenField("status",'status',array());
    		  ?>
    		
           <div class="content_inline">
           	 <div class="content_name">预留到</div>
           	 <div class="content_content"><?php echo $form->createDate($model,"reserved_date",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'reserved_date');?></div>
           </div>
					
           
           <div class="content_button">
	         	 <input type="submit" class="input_submit" value="确定" name="button_ok"/>
	         	 <input type="reset" class="input_cancel" value="取消" name="button_reset"/>
	        </div>
	     <?php $this->endWidget();?>
    	  </div>
    	 <!--编辑框end-->	
    </div>
</div>