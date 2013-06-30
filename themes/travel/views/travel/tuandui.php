<?php
  	  $ip_convert=IpConvert::get();
		  $region_data=$ip_convert->init_region();
      $region_id=$region_data['id'];
?>
<div class="main_con">
  <div class="main_left">
        <div class="left_part1">
        	<?php TZ::travelsearch("cacheid/home_travelsearch_".$region_id);?>
        </div>
        <!--left_part1 end-->
        
        <div class="left_part2">
        	<div class="sort_left2"></div>
    		<h2 class="left_part_title">团队游</h2>	    
            <?php TZ::categorysearch("channel_id/".$channel."/view/index/cacheid/home_categorysearch_tuandui_".$region_id);?>
        </div>
        <!--left_part2 end-->
     <div class="left_hot"><!--热门路线-->
            <?php TZ::rementuijian("channel_id/".$channel."/cacheid/rementuijian_".$channel."_".$region_id);?>
     </div> <!--//热门路线--> 
  </div>
    <!--main_left end-->
    
    <div class="main_right">
    	
        <div class="main_rbox"><!--周边游特价-->
           <h2 class="main_rbtitle"><span>团队游特价</span></h2>
           <div class="main_rblist">
           <ul>

              <?php BZ::blocks("pattern/travel/channel/".$channel."/view/travel_tejia/sort/update_time/sort_type/DESC/limit/10/attr/t/size/90*60/dlen/40/cacheid/tejia_".$channel."_".$region_id);?>

           </ul>
           </div>
         <div class="clear_float"></div>
        </div><!--//main_rbox-->
      <div class="main_rbox" style="margin-top:10px;"><!--最新活动-->
        <h2 class="main_rbtitle"><span>最新活动</span></h2>
           <div class="main_rbnews">
           		<ul>
           			   <?php BZ::blocks("pattern/travel/channel/".$channel."/view/travel_huodong/sort/update_time/sort_type/DESC/limit/4/attr/h/tlen/20/size/160*130/cacheid/huodong_".$channel."_".$region_id);?>
                </ul>
         </div>
         <div class="clear_float"></div>
      </div>
      
      
      
      
      <div class="main_rbox" style="margin-top:10px;"><!--最新活动-->
        <?php TZ::jingxuantuijiantravel("title/精选推荐线路/channel_id/".$channel."/attr/c/limit/10/cacheid/jingxuan_tuanduituijian_".$channel."_".$region_id);?>
      </div>
      
      
      <div class="main_rbox" style="margin-top:10px;"><!--最新活动-->
        <h2 class="main_rbtitle"><span>团队旅游需求</span></h2>
           <div class="main_rbnews">
           		<?php $form=$this->beginWidget('EActiveForm', array(
	         'id'=>'groupcustomize-form',
           'action'=>"",
	         'enableAjaxValidation'=>false,
         )); ?>
        		 <div class="gc_con">
        		 	  <div class="gc_tips">
        	     </div>
        		 	   <div class="gc_tips_title">出游联系信息</div>
        		 	   <table class="gc_table">
        		 	   	  <tbody>
        		 	   	  	  <tr><td colspan="4"><div class="operate_result"><?php $this->widget("FlashInfo");?></div></td></tr>
        		 	   	  	  <tr>
        		 	   	  	  	<td class="gc_title"><b><font color="#ff0000">*</font></b>联系人：</td>
        		 	   	  	  	<td class="gc_input"><?php echo $form->textField($group_customize,"contact_name",array('class'=>'gc_input_text'));?><span class="input_error"><?php echo $form->error($group_customize,'contact_name'); ?></span></td>
        		 	   	  	  	<td class="gc_title"><b><font color="#ff0000">*</font></b>手机号码：</td>
        		 	   	  	  	<td class="gc_input"><?php echo $form->textField($group_customize,"contact_phone",array('class'=>'gc_input_text'));?><span class="input_error"><?php echo $form->error($group_customize,'contact_phone'); ?></span></td>
        		 	   	  	  </tr>
        		 	   	  	  
        		 	   	  	  <tr>
        		 	   	  	  	<td class="gc_title"><b><font color="#ff0000">*</font></b>联系电话：</td>
        		 	   	  	  	<td class="gc_input"><?php echo $form->textField($group_customize,"contact_tel",array('class'=>'gc_input_text'));?><span class="input_error"><?php echo $form->error($group_customize,'contact_tel'); ?></span></td>
        		 	   	  	  	<td class="gc_title">E-mail：</td>
        		 	   	  	  	<td class="gc_input"><?php echo $form->textField($group_customize,"contact_email",array('class'=>'gc_input_text'));?><span class="input_error"><?php echo $form->error($group_customize,'contact_email'); ?></td>
        		 	   	  	  </tr>
        		 	   	  	  
        		 	   	  	  
        		 	   	  	  <tr>
        		 	   	  	  	<td class="gc_title">回复时间：</td>
        		 	   	  	  	<td class="gc_input" colspan="3"><?php echo $form->radioButtonList($group_customize,"reply_time",CV::$GROUP_REPLY_TIME,array('separator'=>'&nbsp;'));?></td>
        		 	   	  	  	
        		 	   	  	  </tr>
        		 	   	  	  
        		 	   	  	  

        		 	   	  </tbody>
        		 	   	</table>
        		 	</div>
        		 	
        		 	<div class="gc_com">
        		 		<div class="gc_tips_title">出游信息</div>
        		 		<table class="gc_table" id="gc_com_message">
        		 		   <tr>
        		 	   	  	  <td class="gc_title">公司名称：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textField($group_customize,"company_name",array('class'=>'gc_input_text'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">出发城市：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->createAjaxselect($group_customize,"start_region",array('title'=>'可直接选择城市或输入城市','type_value'=>'region','tabs'=>"[{'name':'城市','url':'/api/region','id':'','type':'region'}]",'serviceUrl'=>"/api/mixregion",'multi'=>false,'level'=>3));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">目的地：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->createAjaxselect($group_customize,"end_region",array('title'=>'可直接选择城市或输入城市','type_value'=>'region','tabs'=>"[{'name':'城市','url':'/api/region','id':'','type':'region'}]",'serviceUrl'=>"/api/mixregion",'multi'=>false,'level'=>3));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">出发日期：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->createDate($group_customize,"start_time",array());?></td>
        		 	   	 </tr>
        		 	   	  <tr>
        		 	   	  	  <td class="gc_title">返程日期：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->createDate($group_customize,"end_time",array());?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">人数：</td>
        		 	   	  	  <td class="gc_cinput">成人数：<?php echo $form->textField($group_customize,"adults",array('class'=>'gc_input_text'));?>人&nbsp;&nbsp;儿童数：<?php echo $form->textField($group_customize,"childs",array('class'=>'gc_input_text'));?>人</td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">天数：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textField($group_customize,"travel_nums",array('class'=>'gc_input_text'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">出游预算：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textField($group_customize,"travel_budget",array('class'=>'gc_input_text'));?>元/人</td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">交通工具：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->radioButtonList($group_customize,"transport",CV::$GROUP_TRANSPORT,array('separator'=>'&nbsp;'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title"></td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textArea($group_customize,"transport_tips",array('class'=>'gc_input_area'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">住宿标准：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->radioButtonList($group_customize,"stay",CV::$GROUP_STAY,array('separator'=>'&nbsp;'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title"></td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textArea($group_customize,"stay_tips",array('class'=>'gc_input_area'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">用餐标准：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->radioButtonList($group_customize,"dinning",CV::$GROUP_DINNING,array('separator'=>'&nbsp;'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title"></td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textArea($group_customize,"dinning_tips",array('class'=>'gc_input_area'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">导游要求：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->radioButtonList($group_customize,"guide",CV::$GROUP_GUIDE,array('separator'=>'&nbsp;'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title"></td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textArea($group_customize,"guide_tips",array('class'=>'gc_input_area'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">购物安排：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->radioButtonList($group_customize,"shopping",CV::$GROUP_SHOPPING,array('separator'=>'&nbsp;'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title"></td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textArea($group_customize,"shopping_tips",array('class'=>'gc_input_area'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">会议安排：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->radioButtonList($group_customize,"meeting",CV::$GROUP_MEETING,array('separator'=>'&nbsp;'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title"></td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textArea($group_customize,"meeting_tips",array('class'=>'gc_input_area'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	     
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">其他需求：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textArea($group_customize,"other_tips",array('class'=>'gc_input_area'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 			 
        		 		</table>
        		 		
        		  </div>
        		  
        		 
        		  <div class=""><?php echo CHtml::submitButton("提交",array('class'=>'gc_submit'));?></div>
        <?php $this->endWidget(); ?> 
          </div>
         <div class="clear_float"></div>
      </div>
      
      
      
      <div class="main_rbox" style="margin-top:10px;"><!--最新活动-->
        <h2 class="main_rbtitle"><span>预定排行</span></h2>
        <div class="main_rb_tj">
            <ul>
            	<?php BZ::blocks("pattern/travel/channel/".$channel."/view/travel_yuding_paihang/sort/buy_numbers/sort_type/DESC/dlen/40/limit/10/cache/-1/cacheid/yuding_paihang_".$channel."_".$region_id);?>
            </ul>
        </div>
           <div class="clear_float"></div>
      </div>
     
      
    </div><!--main_right end-->
    <div class="clear_float"></div>
</div><!--main_con end-->


<script language="javascript">

	jQuery(function(){
		show_more_region("j_more_sort","j_destination_area","j_more_sort_item");
		jQuery(".show_travel_region").bind("click",function(){
			var channel_id=jQuery(this).attr("channel_id");
			var end_region=jQuery(this).attr("end_region");
			var attr=jQuery(this).attr("attr");
			var limit=jQuery(this).attr("limit");
			var sort=jQuery(this).attr("sort");
			var sort_type=jQuery(this).attr("sort_type");
			var show="line_list_"+channel_id;
			get_travel_datas(show,channel_id,end_region,attr,"",limit,sort,sort_type,"jingxuantuijian");
			jQuery(this).parent().siblings().removeClass("current2");
			jQuery(this).parent().addClass("current2");
			
			
		});
	
	});
	
	
</script>