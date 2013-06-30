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
        	
    		<h2 class="left_part_title">周边游</h2>	 
    		
    		    <?php TZ::categorysearch("channel_id/131/view/zhoubian/cacheid/home_categorysearch_zhoubian_".$region_id);?>   

        </div><!--left_part2 end-->

        <div class="left_part3">
        	<div class="sort_left3"></div>
    		<h2 class="left_part_title">国内游</h2>	    
            <?php TZ::categorysearch("channel_id/132/cacheid/home_categorysearch_guonei_".$region_id);?>   

        </div><!--left_part2 end-->
        
        <div class="left_part4">
        	<div class="sort_left4"></div>
    		<h2 class="left_part_title">出境游</h2>	    
            <?php TZ::categorysearch("channel_id/133/cacheid/home_categorysearch_chujing_".$region_id);?>   
        </div><!--left_part2 end-->
        
        <div class="left_part5">
        	<div class="sort_left5"></div>
    		<h2 class="left_part_title">团队游</h2>	    
            <?php TZ::categorysearch("channel_id/134/cacheid/home_categorysearch_tuandui_".$region_id);?>   
        </div><!--left_part2 end-->
        
    
  </div>
    <!--main_left end-->
    
    <div class="main_right">

      <div class="main_rbox" style="margin-top:10px;">
        <?php TZ::jingxuantuijiantravel("title/周边游特价/channel_id/131/attr/t/limit/-1/cacheid/tejiayou_131_".$region_id);?>
      </div>
      
      <div class="main_rbox" style="margin-top:10px;">
        <?php TZ::jingxuantuijiantravel("title/国内游特价/channel_id/132/attr/t/limit/-1/cacheid/tejiayou_132_".$region_id);?>
      </div>
      
      
      <div class="main_rbox" style="margin-top:10px;">
        <?php TZ::jingxuantuijiantravel("title/出境游特价/channel_id/133/attr/t/limit/-1/cacheid/tejiayou_133_".$region_id);?>
      </div>
      
      <div class="main_rbox" style="margin-top:10px;">
        <?php TZ::jingxuantuijiantravel("title/团队游特价/channel_id/134/attr/t/limit/-1/cacheid/tejiayou_134_".$region_id);?>
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