<div id="page_content">
    <div class="show_right_content">
    <!--用户操作-->
    	<div><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("hotelsprice/index",array('bed_id'=>$model->bed_id));?>">返回到房型价格管理</a></span></div></div>
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
         echo $form->hiddenField($model,"bed_id",array());
        ?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           <div class="content_title"><?php if($model->id) echo "修改房型"; else echo "添加房型"; ?></div>
           <div class="content_inline"><div class="content_name">价格:</div><div class="content_content"><?php echo $form->createNumber($model,"price",array());?>元</div><div class="content_error"><?php echo $form->error($model,'price'); ?></div></div>
           <div class="content_inline"><div class="content_name">价格说明:</div><div class="content_content"><?php echo $form->createTextarea($model,"price_desc",array());?></div><div class="content_error"><?php echo $form->error($model,'price_desc'); ?></div><div class="content_tip">详细描述节假日或具体的日期的房价差</div></div>
           <div class="content_inline"><div class="content_name">原价:</div><div class="content_content"><?php echo $form->createNumber($model,"o_price",array());?>元</div><div class="content_error"><?php echo $form->error($model,'o_price'); ?></div></div>
           <div class="content_inline"><div class="content_name">结算价:</div><div class="content_content"><?php echo $form->createNumber($model,"settle_price",array());?>元</div><div class="content_error"><?php echo $form->error($model,'settle_price'); ?></div></div>
	         <div class="content_inline"><div class="content_name">结算价说明:</div><div class="content_content"><?php echo $form->createTextarea($model,"settle_price_desc",array());?></div><div class="content_error"><?php echo $form->error($model,'settle_price_desc'); ?></div><div class="content_tip">详细描述节假日或具体的日期的结算房价差</div></div>
	         <div class="content_inline"><div class="content_name">宽带:</div><div class="content_content"><?php echo $form->createSelect($model,"line",CV::$HOTELS_LINE,array());?></div><div class="content_error"><?php echo $form->error($model,'line'); ?></div></div>
	         <div class="content_inline"><div class="content_name">床型:</div><div class="content_content"><?php echo $form->createSelect($model,"bed",CV::$HOTELS_BED,array());?>人</div><div class="content_error"><?php echo $form->error($model,'bed'); ?></div></div>
	         <div class="content_inline"><div class="content_name">早餐:</div><div class="content_content"><?php echo $form->createSelect($model,"breakfast",CV::$HOTELS_BREAKFAST,array());?>人</div><div class="content_error"><?php echo $form->error($model,'breakfast'); ?></div></div>
	         <div class="content_inline"><div class="content_name">房间数:</div><div class="content_content"><?php echo $form->createNumber($model,"numbers",array());?></div><div class="content_error"><?php echo $form->error($model,'numbers'); ?></div></div>
	         <div class="content_button"><input type="submit" class="input_submit" value="确定" name="button_ok"/><input type="reset" class="input_cancel" value="取消" name="button_reset"/></div>
	   
    	<?php $this->endWidget(); ?>
    	</div>
    	 <!--编辑框end-->	
    </div>
</div>
<script language="javascript">
    	  jQuery(document).ready(function(){
    	  	  var date_type="<?= $model->date_type ?>";
    	  	  if(date_type=="2"){
    	  	  	  jQuery("#regular_date2").show();
    	  	  		jQuery("#regular_date1").hide();
    	  	  }
    	  	  jQuery(".date_type").bind("click",function(){
    	  	  	var date_type_value=jQuery(this).val();
    	  	  	if(date_type_value=='1'){
    	  	  		jQuery("#regular_date1").show();
    	  	  		jQuery("#regular_date2").hide();
    	  	  	}else{
    	  	  		jQuery("#regular_date2").show();
    	  	  		jQuery("#regular_date1").hide();
    	  	  	}
    	  	  });
    	  });
    </script>
    
    



    
    
    
    
    



