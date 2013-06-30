<?php 
   $channel_category_model=ChannelCategory::model();
   $category_select=$channel_category_model->get_select('0');
   
   $config_values=ConfigValues::model();
   $list_view=$config_values->get_ralation_values('5');
   $sort_select=$config_values->get_ralation_values('4');
   
?>
<div id="page_content">
	
    <div class="show_right_content">
    <!--用户操作-->
    	<div class=""><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("channels/index",array());?>">返回到栏目管理</a></span></div></div>
    <!--用户操作end-->
    <!--编辑框-->	
    	<div class="edit_content">
    		
    		<div class="setting_menu"><ul class="tab_menu"><li class="menu_item menu_item_active" index='1'>常规内容</li><li class="menu_item" index='2'>高级内容</li><li class="menu_item" index='3'>栏目内容</li></ul></div>
    		 <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
    		 <?php 
    		     $form = $this->beginWidget('EActiveForm', array('id'=>'add_channel','action'=>"",'enableAjaxValidation'=>false,'htmlOptions'=>array('enctype'=>'multipart/form-data')));
    		     echo $form->createHidden($model,'id',array());
    		     echo $form->createHidden($model,'parent_id',array());
    		  ?>
    		 <div id="menu_content_1" class="menu_content" style="display:block">
    		 	
    		 	
           <div class="content_inline">
           	 <div class="content_name">是否隐藏栏目</div>
           	 <div class="content_content"><?php echo $form->createRadio($model,"is_hidden",CV::$channels_is_hidden,array('separator'=>'&nbsp;'));?></div>
           	 <div class="content_error"><?php echo $form->error($model,'is_hidden');?></div>
           </div>
           
           
           <div class="content_inline">
           	 <div class="content_name">栏目名称</div>
           	 <div class="content_content"><?php echo $form->createText($model,"name",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'name');?></div>
           </div>
           
            <div class="content_inline">
           	 <div class="content_name">栏目模型</div>
           	 <div class="content_content"><?php echo $form->createSelect($model,"pattern",CV::$pattern,array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'pattern');?></div>
           </div>
           
           
           <div class="content_inline">
           	 <div class="content_name">排序</div>
           	 <div class="content_content"><?php echo $form->createNumber($model,"sort",array());?></div>
           	 <div class="content_tip">越小越在前</div>
           	 <div class="content_error"><?php echo $form->error($model,'sort');?></div>
           </div>
           
           
           <div class="content_inline">
           	 <div class="content_name">浏览权限</div>
           	 <div class="content_content"><?php echo $form->createSelect($model,"permission",CV::$channels_permission,array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'permission');?></div>
           </div>
           
           
            <div class="content_inline">
           	 <div class="content_name">切割图片尺寸</div>
           	 <div class="content_content"><?php echo $form->createText($model,"image_size",array());?></div>
           	 <div class="content_tip">文档需要切割缩略图的尺寸：300*200。图片列表默认为第一个尺寸</div>
           	 <div class="content_error"><?php echo $form->error($model,'image_size');?></div>
           </div>
           
           
           <div class="content_inline">
           	 <div class="content_name">栏目属性</div>
           	 <div class="content_content"><?php echo $form->createRadio($model,"link_type",CV::$channels_link_type,array('separator'=>'&nbsp;','class'=>'link_types'));?></div>
           	 <div class="content_error"><?php echo $form->error($model,'link_type');?></div>
           </div>
           
           
           <div class="content_inline" style="display:none;" id="link_href_select">
           	 <div class="content_name">外链内容<span></div>
           	 <div class="content_content"><?php echo $form->createText($model,"link_href",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'link_href');?></div>
           </div>
           
           
           <div class="content_inline">
           	 <div class="content_name">栏目分类</div>
           	 <div class="content_content"><?php echo EHtml::createMulti("channel_category",$channel_category,$category_select,array('multiple'=>true,'size'=>'5'));?></div>
           	 <div class="content_error"><?php echo $form->error($model,'channel_category');?></div>
           </div>
	       
	       </div>
	       
	       
	       	<div id="menu_content_2" class="menu_content" style="display:none">
    		         <div class="content_inline">
           	 					<div class="content_name">SEO标题</div>
           						<div class="content_content"><?php echo $form->createText($model,"seo_title",array());?></div>
           	 					<div class="content_error"><?php echo $form->error($model,'seo_title');?></div>
           				</div>
           				
           				<div class="content_inline">
           	 					<div class="content_name">SEO关键字</div>
           						<div class="content_content"><?php echo $form->createTextarea($model,"seo_keywords",array());?></div>
           	 					<div class="content_error"><?php echo $form->error($model,'seo_keywords');?></div>
           				</div>
           				
           				<div class="content_inline">
           	 					<div class="content_name">SEO描述</div>
           						<div class="content_content"><?php echo $form->createTextarea($model,"seo_describe",array());?></div>
           	 					<div class="content_error"><?php echo $form->error($model,'seo_describe');?></div>
           				</div>
           				
           				<div class="content_inline">
           	 					<div class="content_name">封面模版</div>
           						<div class="content_content"><?php echo $form->createText($model,"cover_template",array('style'=>'width:300px;'));?></div>
           	 					<div class="content_error"><?php echo $form->error($model,'cover_template');?></div>
           				</div>

           				<div class="content_inline">
           	 					<div class="content_name">列表模版</div>
           						<div class="content_content"><?php echo $form->createText($model,"lists_template",array('style'=>'width:300px;'));?></div>
           	 					<div class="content_error"><?php echo $form->error($model,'lists_template');?></div>
           				</div>
           				
           				<div class="content_inline">
           	 					<div class="content_name">文章模版</div>
           						<div class="content_content"><?php echo $form->createText($model,"archive_template",array('style'=>'width:300px;'));?></div>
           	 					<div class="content_error"><?php echo $form->error($model,'archive_template');?></div>
           				</div>
           				
           				<div class="content_inline">
           					  <div class="content_name">列表视图</div>
           	 					<div class="content_content"><?php echo $form->createSelect($model,"list_view",$list_view,array());?></div>
           	 					<div class="content_error"><?php echo $form->error($model,'list_view');?></div>
           				</div>
           				
           				<div class="content_inline">
           					  <div class="content_name">列表排序</div>
           	 					<div class="content_content"><?php echo $form->createSelect($model,"list_sort",$sort_select,array());?></div>
           	 					<div class="content_error"><?php echo $form->error($model,'list_sort');?></div>
           				</div>
           				
           				
           				<div class="content_inline">
           					  <div class="content_name">排序方式</div>
           	 					<div class="content_content"><?php echo $form->createSelect($model,"list_sort_type",CV::$list_sort_type,array());?></div>
           	 					<div class="content_error"><?php echo $form->error($model,'list_sort_type');?></div>
           				</div>
           				
           				<div class="content_inline">
           					  <div class="content_name">列表数量</div>
           	 					<div class="content_content"><?php echo $form->createNumber($model,"list_limit",array());?></div>
           	 					<div class="content_tip">列表显示的条数，默认是10条'</div>
           	 					<div class="content_error"><?php echo $form->error($model,'list_limit');?></div>
           				</div>
           				
	        </div>
	       
	       
	       
	       
	       <div id="menu_content_3" class="menu_content">
	              <div class="content_inline">
           	 					<div class="content_name">文章内容</div>
           						<div class="content_content"><?php $form->createMultitext($model,"content",array());?></div>
           	 					<div class="content_error"><?php echo $form->error($model,'content');?></div>
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
    togglemenu({'source':"menu_item",'target':"menu_content",'type':'1','effect':'1','effect_time':''});
    jQuery(".link_types").each(function(i){
        var radio_checked=jQuery(this).attr("checked");
        var radio_value=jQuery(this).val();
        if(radio_checked&&radio_value=="3"){
        	jQuery("#link_href_select").show();
        }
    }).bind("click",function(){
    	  var radio_value=jQuery(this).val();
    	  if(radio_value=="3"){
    	  	jQuery("#link_href_select").show();
    	  }else{
    	  	jQuery("#link_href_select").hide();
    	  }
    }); 
    
  }); 

</script>

    
    
    
    



