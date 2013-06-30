<?php 
  Yii::app()->clientScript->registerScriptFile('/js/jQuery.selectbox.js');	
  Yii::app()->clientScript->registerCssFile('/js/autocompleted/styles.css');
  Yii::app()->clientScript->registerScriptFile("/js/autocompleted/jquery.autocomplete-min.js");
  $channels=Channels::model();
  $channels_select=$channels->get_channel_select('0','',"hotels");
  $config_values=ConfigValues::model();
  $travel_att_select=$config_values->get_select_values('1');
  
  $hotel_price_limit=CV::$HOTEL_PRICE_LIMIT;
  $hotels_level=CV::$HOTELS_LEVEL;
  $facility=CV::$FACILITY;
  
  $hotels_brand=HotelsBrand::model();
  $hotels_brand_select=$hotels_brand->get_options_brands();
  $hotels_brand_select=Util::com_search_item(array(''=>'不限'),$hotels_brand_select);

?>
<div id="page_content">
    <div class="show_right_content">
    <!--用户操作-->
    	<div class=""><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("index",array());?>">返回到酒店管理</a></span></div></div>
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
           	 <div class="content_name">酒店名称</div>
           	 <div class="content_content"><?php echo $form->createText($model,"title",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'title');?></div>
           </div>
           
         
						<div class="content_inline">
           	 <div class="content_name">标签</div>
           	 <div class="content_content"><?php echo $form->createText($model,'archive_tags',array('id'=>'auto_seo_title'));?></div>
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
           	 <div class="content_name">分类</div>
           	 <div class="content_content" id="category_content"></div>
           	 <div class="content_error"><?php echo $form->error($model,'category_id');?></div>
           </div>

          <div class="content_inline">
           	 <div class="content_name">酒店地址</div>
           	 <div class="content_content"><?php echo $form->createText($model,"hotel_address",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'hotel_address');?></div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">酒店座机</div>
           	 <div class="content_content"><?php echo $form->createText($model,"hotel_telephone",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'hotel_telephone');?></div>
           </div>
           
           
            <div class="content_inline">
           	 <div class="content_name">公司坐标</div>
           	 <div class="content_content"><?php echo $form->createText($model,'hotel_coordinate',array('id'=>'coordinate','onclick'=>'javascript:baidu_maps();'));?></div>
           	 <div class="content_error"><?php echo $form->error($model,'hotel_coordinate');?></div>
           </div>
           
           
           <div class="content_inline">
           	 <div class="content_name">开业时间</div>
           	 <div class="content_content"><?php echo $form->createDate($model,'open_time',array());?></div>
           	 <div class="content_tip"></div>
           	 <div class="content_error"><?php echo $form->error($model,'open_time');?></div>
           </div>
           <div class="content_inline">
           	 <div class="content_name">价格范围</div>
           	 <div class="content_content"><?php echo $form->createSelect($model,"hotel_price_limit",$hotel_price_limit,array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'hotel_price_limit');?></div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">酒店星级</div>
           	 <div class="content_content"><?php echo $form->createSelect($model,"hotel_level",$hotels_level,array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'hotel_level');?></div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">酒店设施</div>
           	 <div class="content_content"><?php echo EHtml::createMulti("facility",$model->facility,$facility,array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'facility');?></div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">酒店品牌</div>
           	 <div class="content_content"><?php echo $form->createSelect($model,"brand_id",$hotels_brand_select,array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'brand_id');?></div>
           </div>
           
          <div class="content_inline">
           	 <div class="content_name">所属区域</div>
           	 <div class="content_content">
           	 	<?php echo $form->createAjaxselect($model,"hotel_region",array('title'=>'可直接选择城市或输入城市','type_value'=>'region','tabs'=>"[{'name':'城市','url':'/api/region','id':'','type':'region'}]",'serviceUrl'=>"/api/mixregion",'multi'=>false,'level'=>3));?>  
        	  </div>
           	 <div class="content_error"><?php echo $form->error($model,'hotel_region');?></div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">酒店描述</div>
           	 <div class="content_content"><?php $form->createMultitext($model,"content",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'content');?></div>
           </div> 
         
           <div class="content_inline">
           	 <div class="content_name">简短描述</div>
           	 <div class="content_content"><?php echo $form->createTextarea($model,"scontent",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'scontent');?></div>
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
  function baidu_maps(){
        	var address=document.getElementById("coordinate").value;
        	set_bmap(address);
        	
        }

</script>


    
    
    
    



