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
    		<h2 class="left_part_title">出境游</h2>	    
            <?php TZ::categorysearch("channel_id/".$channel."/view/index/cacheid/home_categorysearch_chujing_".$region_id);?>
        </div>
        <!--left_part2 end-->
     <div class="left_hot"><!--热门路线-->
            <?php TZ::rementuijian("channel_id/".$channel."/cacheid/rementuijian_".$channel."_".$region_id);?>
     </div> <!--//热门路线--> 
  </div>
    <!--main_left end-->
    
    <div class="main_right">
        <div class="main_rbox"><!--周边游特价-->
           <h2 class="main_rbtitle"><span>出境游特价</span></h2>
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
        <h2 class="main_rbtitle"><span>预定排行</span></h2>
        <div class="main_rb_tj">
            <ul>
            	<?php BZ::blocks("pattern/travel/channel/".$channel."/view/travel_yuding_paihang/sort/buy_numbers/sort_type/DESC/limit/10/dlen/40/cache/-1/cacheid/yuding_paihang_".$channel."_".$region_id);?>
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