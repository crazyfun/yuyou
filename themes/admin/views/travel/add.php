<?php 
  Yii::app()->clientScript->registerScriptFile('/js/jQuery.selectbox.js');	
  Yii::app()->clientScript->registerCssFile('/js/autocompleted/styles.css');
  Yii::app()->clientScript->registerScriptFile("/js/autocompleted/jquery.autocomplete-min.js");
  $channels=Channels::model();
  $channels_select=$channels->get_channel_select('0','0',"travel");
  $config_values=ConfigValues::model();
  $travel_att_select=$config_values->get_select_values('1');
  $budget=$config_values->get_ralation_values("11");

?>
<div id="page_content">
    <div class="show_right_content">
    <!--用户操作-->
    	<div class=""><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("index",array());?>">返回到线路管理</a></span><span><a href="<?php echo $this->createUrl("add",array('channel_id'));?>">新增线路</a></span></div></div>
    <!--用户操作end-->
    <!--编辑框-->	
    	<div class="edit_content">
    		
    		<div class="setting_menu"><ul class="tab_menu"><li class="menu_item menu_item_active" index='1'>常规内容</li><li class="menu_item" index='2'>高级内容</li></ul></div>
    		 <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
    		 <?php 
    		     $form = $this->beginWidget('EActiveForm', array('id'=>'add_channel','action'=>"",'enableAjaxValidation'=>false,'htmlOptions'=>array('enctype'=>'multipart/form-data')));
    		     echo $form->createHidden($model,'id',array());
    		     
    		     
    		  ?>
    		 <div id="menu_content_1" class="menu_content" style="display:block">
    		 	
           <div class="content_inline">
           	 <div class="content_name">线路名称</div>
           	 <div class="content_content"><?php echo $form->createText($model,"title",array());?><a href="javascript:show_clonedialog('<?php echo $model->id;?>')">克隆线路</a></div>
           	 <div class="content_error"><?php echo $form->error($model,'title');?></div>
           </div>
           
            <div class="content_inline">
           	 <div class="content_name">自定义属性</div>
           	 <div class="content_content"><?php echo EHtml::createCheckbox("travel_att",$travel_att,$travel_att_select,array('separator'=>'&nbsp;'));?></div>
           	 <div class="content_error"><?php echo $form->error($model,'attr');?></div>
           </div>
						<div class="content_inline">
           	 <div class="content_name">标签</div>
           	 <div class="content_content"><?php echo $form->createText($model,'travel_tags',array('id'=>'auto_seo_title'));?></div>
           	 <div class="content_tip">请使用,隔开</div>
           	 <div class="content_error"></div>
           </div>
           <div class="content_inline">
           	 <div class="content_name">排序</div>
           	 <div class="content_content"><?php echo $form->createNumber($model,'sort',array());?></div>
           	 <div class="content_tip">越小越在前</div>
           	 <div class="content_error"></div>
           </div>
           <div class="content_inline">
           	 <div class="content_name">栏目</div>
           	 <div class="content_content"><?php echo $form->createSelect($model,"channel_id",$channels_select,array('id'=>'select_channel'));?></div>
           	 <div class="content_error"><?php echo $form->error($model,'channel_id');?></div>
           </div> 
         <div class="content_inline">
           	 <div class="content_name">所属公司</div>
           	 <div class="content_content"><?php echo $form->createAuto($model,"company_id",$model->show_attribute("company_id"),array('serviceUrl'=>'/admin.php/main/company'));?></div>
           	 <div class="content_error"><?php echo $form->error($model,'company_id');?></div>
           </div>


           <div class="content_inline">
           	 <div class="content_name">出行天数</div>
           	 <div class="content_content"><?php echo $form->createNumber($model,'route_number',array());?></div>
           	 <div class="content_tip"></div>
           	 <div class="content_error"><?php echo $form->error($model,'route_number');?></div>
           </div>
           <div class="content_inline">
           	 <div class="content_name">价格范围</div>
           	 <div class="content_content"><?php echo $form->createSelect($model,"budget",$budget,array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'budget');?></div>
           </div>
           <div class="content_inline">
           	 <div class="content_name">抵用劵</div>
           	 <div class="content_content"><?php echo $form->createNumber($model,'coupon',array());?>元</div>
           	 <div class="content_tip">线路抵用劵</div>
           	 <div class="content_error"><?php echo $form->error($model,'coupon');?></div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">出发地</div>
           	 <div class="content_content">
           	 	<input type="hidden" name="start_region" value="<?php echo $model->start_region;?>" id="start_region_condition"/>
        	    <input type="hidden" name="start_region_type" value="region" id="start_region_type"/>
           	 	<?php 
        	        echo CHtml::textField("start_region_text",$model->show_attribute("start_region"),array('id'=>'start_region_text'));
        	    ?>
        	        
        	  </div>
           	 <div class="content_error"><?php echo $form->error($model,'start_region');?></div>
           </div>
           
            <div class="content_inline">
           	 <div class="content_name">途径</div>
           	 <div class="content_content">
           	 	<input type="hidden" name="mid_region" value="<?php echo $model->mid_region;?>" id="mid_region_condition"/>
        	    <input type="hidden" name="mid_region_type" value="region" id="mid_region_type"/>
           	 	<?php 
        	        echo CHtml::textField("mid_region_text",$model->show_attribute("mid_region"),array('id'=>'mid_region_text'));
        	    ?>
             </div>
           	 <div class="content_error"><?php echo $form->error($model,'mid_region');?></div>
           </div>
           <div class="content_inline">
           	 <div class="content_name">目的地</div>
           	 <div class="content_content">
           	 	<input type="hidden" name="end_region" value="<?php echo $model->end_region;?>" id="end_region_condition"/>
        	    <input type="hidden" name="end_region_type" value="region" id="end_region_type"/>
           	 	<?php 
        	        echo CHtml::textField("end_region_text",$model->show_attribute("end_region"),array('id'=>'end_region_text'));
        	    ?>
        	        
        	  </div>
           	 <div class="content_error"><?php echo $form->error($model,'end_region');?></div>
           </div>
           

           
           
           <div class="content_inline">
           	 <div class="content_name">线路类别</div>
           	 <div class="content_content">
           	 	<input type="hidden" name="linetype" value="<?php echo $model->linetype;?>" id="linetype_condition"/>
        	    <input type="hidden" name="linetype_type" value="travelcategory" id="linetype_type"/>
           	 	<?php 
        	        echo CHtml::textField("linetype_text",$model->show_attribute("linetype"),array('id'=>'linetype_text'));
        	    ?>
              </div>
           	 <div class="content_error"><?php echo $form->error($model,'linetype');?></div>
           </div>

           <div class="content_inline">
           	 <div class="content_name">简短描述</div>
           	 <div class="content_content"><?php echo $form->createTextarea($model,"scontent",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'scontent');?></div>
           </div> 
           <div class="content_inline">
           	 <div class="content_name">接待标准</div>
           	 <div class="content_content"><?php  $form->createMultitext($model,"receptionstandards",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'receptionstandards');?></div>
           </div>
           <div class="content_inline">
           	 <div class="content_name">特色推荐</div>
           	 <div class="content_content"><?php  $form->createMultitext($model,"recommended",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'recommended');?></div>
           </div>

           <div class="content_inline">
           	 <div class="content_name">自费项目</div>
           	 <div class="content_content"><?php $form->createMultitext($model,"tour",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'tour');?></div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">预订通知</div>
           	 <div class="content_content"><?php $form->createMultitext($model,"notice",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'notice');?></div>
           </div>
           
            <div class="content_inline">
           	 <div class="content_name">温馨提示</div>
           	 <div class="content_content"><?php $form->createMultitext($model,"tips",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'tips');?></div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">提前报名</div>
           	 <div class="content_content"><?php echo $form->createText($model,"application",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'application');?></div>
           </div>
           
            <div class="content_inline">
           	 <div class="content_name">往返交通</div>
           	 <div class="content_content"><?php echo $form->createText($model,"transportation",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'transportation');?></div>
           </div>
           
	       </div>
	       
	       
	       <div id="menu_content_2" class="menu_content" style="display:none">
	         		<div class="content_inline">
           	 			<div class="content_name">SEO关键字</div>
           	 			<div class="content_content"><?php echo $form->createText($model,"seo_keywords",array('id'=>'seo_keywords'));?>&nbsp;&nbsp;<?php echo EHtml::createCheck("keywords_select",$keywords_select,array('id'=>'auto_seo_keywords'));?>&nbsp;自动获取，手动填写用","分开</div>
           	 			<div class="content_error"><?php echo $form->error($model,'seo_keywords');?></div>
            	</div>
           
            	<div class="content_inline">
           	 			<div class="content_name">SEO描述</div>
           	 			<div class="content_content"><?php echo $form->createTextarea($model,"seo_describe",array());?></div>
           	 			<div class="content_error"><?php echo $form->error($model,'seo_describe');?></div>
           		 </div>
           
           
	       		    <div class="content_inline">
           	 				<div class="content_name">自定义时间</div>
           	 				<div class="content_content"><?php echo $form->createDate($model,"modify_time",array('dateFmt'=>'yyyy-MM-dd H:m:s'));?></div>
           				  <div class="content_error"><?php echo $form->error($model,'modify_time');?></div>
           				</div>
           				
           				
    		         <div class="content_inline">
           	 					<div class="content_name">允许评论</div>
           						<div class="content_content"><?php echo $form->createRadio($model,"is_comment",CV::$archives_permission,array('separator'=>'&nbsp;'));?></div>
           	 					<div class="content_error"><?php echo $form->error($model,'is_comment');?></div>
           				</div>
           				
           				 <div class="content_inline">
           	 					<div class="content_name">是否投票</div>
           						<div class="content_content"><?php echo $form->createRadio($model,"is_vot",CV::$archives_permission,array('separator'=>'&nbsp;'));?></div>
           	 					<div class="content_error"><?php echo $form->error($model,'is_vot');?></div>
           				</div>
           				
  
           				
           				 <div class="content_inline">
           	 					<div class="content_name">查看数</div>
           						<div class="content_content"><?php echo $form->createNumber($model,"views",array());?></div>
           	 					<div class="content_error"><?php echo $form->error($model,'views');?></div>
           				</div>
           				
           				 <div class="content_inline">
           	 					<div class="content_name">投票数</div>
           						<div class="content_content"><?php echo $form->createNumber($model,"vots",array());?></div>
           	 					<div class="content_error"><?php echo $form->error($model,'vots');?></div>
           				</div>
           				
           				
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

<script>
	
	jQuery("#start_region_text").selectBox({
	 	  'type':"start_region_type",
	 	  'hidden':"start_region_condition",
	 	  'title':"可直接选择城市或输入城市",
	 	  'tabs':[{'name':"城市",'url':"/api/region",'id':'','type':'region'}],
	 	  'serviceUrl':'/api/mixregion',
	 	  'level':3
	 	});
	jQuery("#end_region_text").selectBox({
	 	  'type':"end_region_type",
	 	  'hidden':"end_region_condition",
	 	  'title':"可直接选择城市或输入城市",
	 	  'tabs':[{'name':"城市",'url':"/api/region",'id':'','type':'region'}],
	 	  'serviceUrl':'/api/mixregion',
	 	  'level':3
	 	});
	 	
	 	jQuery("#mid_region_text").selectBox({
	 	  'type':"mid_region_type",
	 	  'hidden':"mid_region_condition",
	 	  'title':"可直接选择城市",
	 	  'tabs':[{'name':"城市",'url':"/api/region",'id':'','type':'region'}],
	 	  'multi':true,
	 	  'level':3
	 	});
	 	
	 	
	 jQuery("#linetype_text").selectBox({
	 	  'type':"linetype_type",
	 	  'hidden':"linetype_condition",
	 	  'title':"可选择线路类别",
	 	  'tabs':[{'name':"线路类别",'url':"/api/linetype",'id':'','type':'travelcategory'}],
	 	  'multi':true,
	 	  'level':2
	 	});
	 	
	 		
	jQuery(function($) {
		jQuery("#auto_seo_title").bind("change",function(){
    	 var selected=jQuery("#auto_seo_keywords").attr("checked");
    	
    	 if(selected){
    	 	 var value=jQuery(this).val();
    	 	 jQuery("#seo_keywords").val(value);
    	 }
    });
    jQuery("#auto_seo_keywords").bind("click",function(){
    	var selected=jQuery(this).attr("checked");
    	 if(selected){
    	 	 var value=jQuery("#auto_seo_title").val();
    	 	 jQuery("#seo_keywords").val(value);
    	 }else{
    	 	jQuery("#seo_keywords").val('');
    	 }
    });
		var category_id="<?= $model->category_id ?>";
    togglemenu({'source':"menu_item",'target':"menu_content",'type':'1','effect':'1','effect_time':''});
    jQuery("#select_channel").bind("click",function(){
    	 var channel_id=jQuery(this).val();
    	 get_channel_category(channel_id,category_id);
    });
    
    var channel_id=jQuery("#select_channel").val();
    get_channel_category(channel_id,category_id);
    
    
    
     jQuery("#start_region_text").bind("blur",function(){
	 	  var type_value=jQuery("#start_region_condition").val();
	 	  if(!type_value){
	 	     jQuery(this).val("");
	 	     jQuery("#start_region_condition").val("");
	 	     jQuery("#start_region_type").val("");
	 	     
	 	  }
	 	});  
	 	  
	 	jQuery("#start_region_text").live("keyup",function(){
      var this_val=jQuery(this).val();
      if(!this_val){
    	   jQuery(this).val("");
	 	     jQuery("#start_region_condition").val("");
	 	     jQuery("#start_region_type").val("");
      }	
    });
    
    
     jQuery("#end_region_text").bind("blur",function(){
	 	  var type_value=jQuery("#end_region_condition").val();
	 	  if(!type_value){
	 	     jQuery(this).val("");
	 	     jQuery("#end_region_condition").val("");
	 	     jQuery("#end_region_type").val("");
	 	     
	 	  }
	 	 });
     jQuery("#end_region_text").live("keyup",function(){
      var this_val=jQuery(this).val();
      if(!this_val){
    	   jQuery(this).val("");
	 	     jQuery("#end_region_condition").val("");
	 	     jQuery("#end_region_type").val("");
      }	
    });
    
     jQuery("#mid_region_text").bind("blur",function(){
	 	  var type_value=jQuery("#mid_region_condition").val();
	 	  if(!type_value){
	 	     jQuery(this).val("");
	 	     jQuery("#mid_region_condition").val("");
	 	     jQuery("#mid_region_type").val("");
	 	     
	 	  }
	 	 });
     jQuery("#mid_region_text").live("keyup",function(){
      var this_val=jQuery(this).val();
      if(!this_val){
    	   jQuery(this).val("");
	 	     jQuery("#mid_region_condition").val("");
	 	     jQuery("#mid_region_type").val("");
      }	
    });
    
    
    
     jQuery("#linetype_text").bind("blur",function(){
	 	  var type_value=jQuery("#linetype_condition").val();
	 	  if(!type_value){
	 	     jQuery(this).val("");
	 	     jQuery("#linetype_condition").val("");
	 	     jQuery("#linetype_type").val("");
	 	     
	 	  }
	 	 });
     jQuery("#linetype_text").live("keyup",function(){
      var this_val=jQuery(this).val();
      if(!this_val){
    	   jQuery(this).val("");
	 	     jQuery("#linetype_condition").val("");
	 	     jQuery("#linetype_type").val("");
      }	
    });
    
    
    
    
    
    
  }); 
  
  function get_channel_category(channel_id,category_id){
  	jQuery.ajax({
			  async:true,
        type: "POST",
        cache:true,
        beforeSend:function(){},
        url:"/admin.php/main/channelcategory",
        dataType:"json",
        data: "channel_id="+channel_id+"&category_id="+category_id,
        success: function(msg){
          if(msg.flag=='1'){
          	
             jQuery("#category_content").html(msg.message);
          }
        }
      });
  }

</script>

    
    
    
    



