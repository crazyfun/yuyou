<div id="page_content">
    <div class="show_right_content">
    <!--用户操作-->
    	<div><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("travelimages/index",array('travel_id'=>$model->travel_id));?>">返回到线路图片管理</a></span></div></div>
    <!--用户操作end-->
    <!--编辑框-->	
    	<div class="edit_content">
    		<?php 
    		  $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'',
          'action'=>"",
	        'enableAjaxValidation'=>false,
	        'htmlOptions'=>array('id'=>'insertimage-form'),
         ));
         echo $form->hiddenField($model,"id");
         echo $form->hiddenField($model,"travel_id");
         echo CHtml::hiddenField("image_ids",$str_image_ids,array('id'=>'image_ids'));
         $travel_area=TravelArea::model();
         $travel_area_select=$travel_area->get_select($model->travel_id);
        ?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           <div class="content_title"><?php if($model->id) echo "修改线路图片"; else echo "添加线路图片"; ?></div>
           
            <div class="content_inline"><div class="content_name">线路景区</div><div class="content_content">
	            <?php echo $form->dropDownList($model,"travel_area_id",$travel_area_select,array());?>
	         </div><div class="content_error"><?php echo $form->error($model,'travel_area_id'); ?></div></div>
	         	
	         	
           <div class="content_inline"><div class="content_name">选择图片</div><div>
	         <iframe frameborder="0" src="/admin.php/images/selectimages" style="width:100%;height:480px;"></iframe>
	         
    		   </iframe>
	         </div><div class="content_error"><?php echo $form->error($model,'image_id'); ?></div></div>
         
	         <div class="content_button"><input type="button" onclick="javascript:submit_travel_images();" class="input_submit" value="确定" name="button_ok"/><input type="reset" class="input_cancel" value="取消" name="button_reset"/></div>
    	<?php $this->endWidget(); ?>
    	</div>
      <!--编辑框end-->	
    </div>
</div>

 <script language="javascript">
    	   var select_images=new Array();
    	   jQuery(document).ready(function(){
    	   	  var str_image_ids="<?= $str_image_ids ?>";
    	   	  if(str_image_ids){
    	   	    var image_ids=str_image_ids.split(",");
    	   	    for(var ii=0;ii<image_ids.length;ii++){
    	   	  	  select_images.push(image_ids[ii]);
    	   	    }
    	   	  }
    	   	  
    	   });
    	   function submit_travel_images(){
    	   	var select_images_str=select_images.join(",");
    	   	jQuery("#image_ids").val(select_images_str);
    	   	document.getElementById("insertimage-form").submit();
    	  }
    </script>
    
    



    
    
    
    
    



