<div id="page_content">
    <div class="show_right_content">
    <!--用户操作-->
    	<div><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("traveldate/index",array('travel_id'=>$model->travel_id));?>">返回到出发时间管理</a></span></div></div>
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
         echo $form->hiddenField($model,"travel_id",array());
        ?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           <div class="content_title"><?php if($model->id) echo "修改出发时间"; else echo "添加出发时间"; ?></div>
           <div class="content_inline"><div class="content_name">出发时间:</div><div class="content_content"><?php echo $form->createDate($model,"travel_date",array());?></div><div class="content_error"><?php echo $form->error($model,'travel_date'); ?></div></div>
           <div class="content_inline"><div class="content_name">时间类型:</div><div class="content_content"><?php echo $form->createRadio($model,"date_type",array('1'=>'规律日期','2'=>'日期段'),array('class'=>'date_type',"separator"=>"&nbsp;"));?></div><div class="content_error"><?php echo $form->error($model,'date_type'); ?></div></div>
           <div class="content_inline" id="regular_date1" ><div class="content_name">规律日期:</div><div class="content_content"><?php echo $form->createSelect($model,"type_value1",CV::$regular_month,array());?>&nbsp;&nbsp;<?php echo $form->createSelect($model,"type_value2",CV::$regular_day,array());?></div><div class="content_error"></div></div>
           <div class="content_inline" id="regular_date2" style="display:none;"><div class="content_name">日期段:</div><div class="content_content"><?php echo $form->createDate($model,"type_period_value1",array());?>到<?php echo $form->createDate($model,"type_period_value2",array());?></div><div class="content_error"></div></div>
           <div class="content_inline"><div class="content_name">成人价钱:</div><div class="content_content"><?php echo $form->createNumber($model,"adult_price",array());?>元</div><div class="content_error"><?php echo $form->error($model,'adult_price'); ?></div></div>
           <div class="content_inline"><div class="content_name">儿童价钱:</div><div class="content_content"><?php echo $form->createNumber($model,"child_price",array());?>元</div><div class="content_error"><?php echo $form->error($model,'adult_price'); ?></div></div>
           <div class="content_inline"><div class="content_name">成人结算价:</div><div class="content_content"><?php echo $form->createNumber($model,"fa_price",array());?>元</div><div class="content_error"><?php echo $form->error($model,'fa_price'); ?></div></div>
	         <div class="content_inline"><div class="content_name">儿童结算价:</div><div class="content_content"><?php echo $form->createNumber($model,"fc_price",array());?>元</div><div class="content_error"><?php echo $form->error($model,'fc_price'); ?></div></div>
	         <div class="content_inline"><div class="content_name">座位:</div><div class="content_content"><?php echo $form->createNumber($model,"seats",array());?>人</div><div class="content_error"><?php echo $form->error($model,'seats'); ?></div></div>
	         <div class="content_inline"><div class="content_name">成团人数:</div><div class="content_content"><?php echo $form->createNumber($model,"group",array());?>人</div><div class="content_error"><?php echo $form->error($model,'group'); ?></div></div>
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
    
    



    
    
    
    
    



