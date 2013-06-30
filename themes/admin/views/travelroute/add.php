<div id="page_content">
    <div class="show_right_content">
    <!--用户操作-->
    	<div><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("travelroute/index",array('travel_id'=>$model->travel_id));?>">返回到行程管理</a></span></div></div>
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
         $travel_area=TravelArea::model();
         $travel_area_select=$travel_area->get_select($model->travel_id);
        ?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           <div class="content_title"><?php if($model->id) echo "修改行程"; else echo "添加行程"; ?></div>
           <div class="content_inline"><div class="content_name"></div><div class="content_content">第&nbsp;<?php echo $form->createNumber($model,"route_day",array());?> &nbsp;天</div><div class="content_error"><?php echo $form->error($model,'route_day'); ?></div></div>
           <div class="content_inline"><div class="content_name">主要景点:</div><div class="content_content"><?php echo EHtml::createText("add_travel_route",'',array("id"=>"add_travel_route"));?><a href="javascript:add_travel_area('<?php echo $model->travel_id ?>','<?php echo $model->travel_route ?>');">增加景点</a></div><div class="content_error"></div></div>
           <div class="content_inline"><div class="content_name"></div><div class="content_content" id="travel_route_select"><?php echo EHtml::createMulti("travel_route",$travel_route,$travel_area_select,array('multiple'=>true,'size'=>'5'));?></div><div class="content_error"><?php echo $form->error($model,'travel_route'); ?></div></div>
           <div class="content_inline"><div class="content_name">详细介绍:</div><div class="content_content"><?php $form->createMultitext($model,"route_describe",array());?></div><div class="content_error"><?php echo $form->error($model,'route_describe'); ?></div></div>
	         <div class="content_inline"><div class="content_name">参考航班:</div><div class="content_content"><?php echo $form->createText($model,"route_flight",array());?></div><div class="content_error"><?php echo $form->error($model,'route_flight'); ?></div></div>
	         <div class="content_inline"><div class="content_name">住宿:</div><div class="content_content"><?php echo $form->createText($model,"route_stay",array());?></div><div class="content_error"><?php echo $form->error($model,'route_stay'); ?></div></div>
	         <div class="content_inline"><div class="content_name">餐饮:</div><div class="content_content"><?php echo $form->createText($model,"route_dining",array());?></div><div class="content_error"><?php echo $form->error($model,'route_dining'); ?></div></div>
	         <div class="content_button"><input type="submit" class="input_submit" value="确定" name="button_ok"/><input type="reset" class="input_cancel" value="取消" name="button_reset"/>&nbsp;&nbsp;<a href="<?php echo $this->createUrl("travelroute/add",array('travel_id'=>$model->travel_id));?>" class="input_submit">新增</a></div>
	   
    	<?php $this->endWidget(); ?>
    	</div>
    	 <!--编辑框end-->	
    </div>
</div>

<script language="javascript">
	function add_travel_area(travel_id,travel_route){
  	var travel_area_text=jQuery("#add_travel_route").val();
  	if(travel_area_text){
  	  jQuery.ajax({
			   type: "POST",
			   beforeSend: function(){
			   },
			   url:"/admin.php/main/routearea",
			   data: "travel_area="+travel_area_text+"&travel_id="+travel_id+"&travel_route="+travel_route,
			   dataType:'json',
			   success: function(msg){  
			   	if(msg.flag=='1'){
          	var datas=msg.datas;
            jQuery("#travel_route_select").html(datas.datas);
          }else if(msg.flag=='2'){
          	 jBox.tip(msg.message, 'info');
          }else{
        	
          }
         }
			});
		}else{
			 jBox.tip("景点名称不能为空", 'info');
		}
  	
  }
</script>

    



    
    
    
    
    



