<?php 
  $channels=Channels::model();
  $channels_select=$channels->get_channel_select('0','',"downloads");
  $config_values=ConfigValues::model();
  $archive_att_select=$config_values->get_select_values('1');
  $archive_source=$config_values->get_select_values('3');
  $soft_type=$config_values->get_ralation_values('12');
  $soft_license=$config_values->get_ralation_values('13');
  $soft_language=$config_values->get_ralation_values('14');
  $soft_level=$config_values->get_ralation_values('15');
?>
<div id="page_content">
	
    <div class="show_right_content">
    <!--用户操作-->
    	<div class=""><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("index",array());?>">返回到下载管理</a></span><span><a href="<?php echo $this->createUrl("add",array('channel_id'));?>">新增下载</a></span></div></div>
    <!--用户操作end-->
    <!--编辑框-->	
    	<div class="edit_content">
    		
    		<div class="setting_menu"><ul class="tab_menu"><li class="menu_item menu_item_active" index='1'>常规内容</li><li class="menu_item" index='2'>软件属性</li><li class="menu_item" index='3'>高级内容</li></ul></div>
    		 <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
    		 <?php 
    		     $form = $this->beginWidget('EActiveForm', array('id'=>'add_channel','action'=>"",'enableAjaxValidation'=>false,'htmlOptions'=>array('enctype'=>'multipart/form-data')));
    		     echo $form->createHidden($model,'id',array());
    		     
    		     
    		  ?>
    		 <div id="menu_content_1" class="menu_content" style="display:block">
    		 	
           <div class="content_inline">
           	 <div class="content_name">软件名称</div>
           	 <div class="content_content"><?php echo $form->createText($model,"title",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'title');?></div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">简短名称</div>
           	 <div class="content_content"><?php echo $form->createText($model,"stitle",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'stitle');?></div>
           </div>
           
            <div class="content_inline">
           	 <div class="content_name">自定义属性</div>
           	 <div class="content_content"><?php echo EHtml::createCheckbox("downloads_att",$downloads_att,$archive_att_select,array('separator'=>'&nbsp;'));?></div>
           	 <div class="content_error"><?php echo $form->error($model,'attr');?></div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">标签</div>
           	 <div class="content_content"><?php echo $form->createText($model,'downloads_tags',array('id'=>'auto_seo_title'));?></div>
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
           	 <div class="content_name">缩略图</div>
           	 <div class="content_content"><?php echo $form->createFile($model,'image',array());?></div>
           	 <div class="content_error"></div>
           </div>
           
            <div class="content_inline">
           	 <div class="content_name">来源</div>
           	 <div class="content_content"><?php echo $form->createSelect($model,'source',$archive_source,array());?></div>
           	 <div class="content_error"></div>
           </div>
           
           
           <div class="content_inline">
           	 <div class="content_name">作者</div>
           	 <div class="content_content"><?php echo $form->createText($model,'auther',array());?></div>
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
           	 <div class="content_name">附加选项</div>
           	 <div class="content_content"><?php echo EHtml::createCheckbox("addition_select",$addition_select,CV::$archives_addition_select,array());?></div>
           	 <div class="content_error"></div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">软件描述</div>
           	 <div class="content_content"><?php $form->createMultitext($model,"content",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'content');?></div>
           </div>
           
           
            <div class="content_inline">
           	 <div class="content_name">简短描述</div>
           	 <div class="content_content"><?php  $form->createMultitext($model,"scontent",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'scontent');?></div>
           </div>
	       
	       </div>
	       
	       
	       <div id="menu_content_2" class="menu_content" style="display:none">
	       	 <div class="content_inline">
           	 <div class="content_name">软件类型</div>
           	 <div class="content_content"><?php echo $form->createSelect($model,"soft_type",$soft_type,array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'soft_type');?></div>
           </div>
           
           
           <div class="content_inline">
           	 <div class="content_name">授权方式</div>
           	 <div class="content_content"><?php echo $form->createSelect($model,"soft_license",$soft_license,array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'soft_license');?></div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">界面语言</div>
           	 <div class="content_content"><?php echo $form->createSelect($model,"soft_language",$soft_language,array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'soft_language');?></div>
           </div>
           
            <div class="content_inline">
           	 <div class="content_name">软件等级</div>
           	 <div class="content_content"><?php echo $form->createSelect($model,"soft_level",$soft_level,array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'soft_level');?></div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">软件大小</div>
           	 <div class="content_content"><?php echo $form->createText($model,"soft_size",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'soft_size');?></div>
           </div>
            
           <div class="content_inline">
           	 <div class="content_name">扩展名</div>
           	 <div class="content_content"><?php echo $form->createText($model,"soft_extension",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'soft_extension');?></div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">运行环境</div>
           	 <div class="content_content"><?php echo $form->createText($model,"soft_environment",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'soft_environment');?></div>
           </div>
           
           
           <div class="content_inline">
           	 <div class="content_name">官方网址</div>
           	 <div class="content_content"><?php echo $form->createText($model,"soft_website",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'soft_website');?></div>
           </div>
           
            <div class="content_inline">
           	 <div class="content_name">演示地址</div>
           	 <div class="content_content"><?php echo $form->createText($model,"soft_demo",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'soft_demo');?></div>
           </div>
           
            <div class="content_inline">
           	 <div class="content_name">下载次数</div>
           	 <div class="content_content"><?php echo $form->createNumber($model,'downloads_times',array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'downloads_times');?></div>
           </div>
           
            <div class="content_inline">
           	 <div class="content_name">下载描述</div>
           	 <div class="content_content"><?php  $form->createMultitext($model,"downloads_describe",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'downloads_describe');?></div>
           </div>
	       	
	      </div>
	       
	       
	       
	       	<div id="menu_content_3" class="menu_content" style="display:none">
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
           	 					<div class="content_name">关联文章</div>
           						<div class="content_content"><?php echo $form->createRadio($model,"is_relation",CV::$archives_permission,array('separator'=>'&nbsp;'));?></div>
           	 					<div class="content_error"><?php echo $form->error($model,'is_relation');?></div>
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
		var category_id="<?= $model->category_id ?>";
    togglemenu({'source':"menu_item",'target':"menu_content",'type':'1','effect':'1','effect_time':''});
    jQuery("#select_channel").bind("click",function(){
    	 var channel_id=jQuery(this).val();
    	 get_channel_category(channel_id,category_id);
    });
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

</script>
