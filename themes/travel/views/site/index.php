<?php
      
  	  $ip_convert=IpConvert::get();
		  $region_data=$ip_convert->init_region();
		 
      $region_id=$region_data['id'];

?>
<div class="main_con">
    <div class="main_left">

        <div class="left_part1">
        	<?php TZ::travelsearch("cacheid/home_travelsearch_".$region_id);?>
        	
        </div><!--left_part1 end-->
        
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
        
        
    </div><!--main_left end-->
    
    <div class="main_right">
   		<div class="scroll_imgs">
            <?php BZ::flash("pattern/travel/view/slide/cacheid/home_falsh_".$region_id);?>
        </div><!--scroll_imgs end-->
        <div class="R_con_right">
        	<div class="R-r-left">
            	 <div class="R-r-part1">
                	  <?php TZ::tejiatravel("cacheid/home_tejiatravel_".$region_id);?>
                </div><!--R-r-part1 end-->
                <div class="ad_img"><?php BZ::ad("pattern/travel/position/2/cacheid/ad_2_".$region_id);?></div>
                <div class="R-r-part2">
                	<h2><div class="r-part-bg">周边旅游推荐</div></h2>
                	  <?php TZ::tuijiantravel("channel_id/131/attr/a,c/cacheid/home_zhoubiantuijian_".$region_id);?>
                   
                </div><!--R-r-part2 end-->
                <div class="ad_img"><?php BZ::ad("pattern/travel/position/3/cacheid/ad_3_".$region_id);?></div>
            	<div class="R-r-part3">
                	<h2><div class="r-part-bg">国内旅游推荐</div></h2>
                	   <?php TZ::tuijiantravel("channel_id/132/attr/a,c/cacheid/home_guoneituijian_".$region_id);?>
                </div><!--R-r-part3 end-->
                <div class="ad_img"><?php BZ::ad("pattern/travel/position/4/cacheid/ad_4_".$region_id);?></div>
                <div class="R-r-part4">
                	<h2><div class="r-part-bg">出境游线路推荐</div></h2>
                  <?php TZ::tuijiantravel("channel_id/133/attr/a,c/cacheid/home_chujingtuijian_".$region_id);?>
                </div><!--R-r-part4 end-->
                <div class="ad_img"><?php BZ::ad("pattern/travel/position/5/cacheid/ad_5_".$region_id);?></div>
                 <div class="R-r-part5">
                	<h2><div class="r-part-bg">团队游线路推荐</div></h2>
                  <?php TZ::tuijiantravel("channel_id/134/attr/a,c/cacheid/home_tuanduituijian_".$region_id);?>
                </div><!--R-r-part4 end-->
                  
            </div><!--R-r-left end-->
            <div class="R-r-right">
            	<div class="newest_list" style="margin-top:10px;">
                	<div class="R_r_title">最新订单</div>
                	<?php TZ::newestorder("type/travel/region_id/".$region_id."/cache/-1/cacheid/limit/20/home_newest_order_".$region_id);?>
                	
                </div><!--newest_list end-->

                <div class="hot_rec_con">
                	<div class="R_r_title">热卖线路<a href="<?php echo $this->createUrl("search/index",array('action'=>"travel"));?>">更多></a></div>
                    <div class="hot_rec">
                    	
                    	  
                        <ul>
                           <?php BZ::blocks("pattern/travel/view/travel_remai/sort/update_time/sort_type/DESC/limit/10/attr/a,f/tlen/24/size/60*40/cacheid/home_remai_".$region_id);?>
                        </ul>
					</div>
                </div><!--hot_rec end-->
                
                                <div class="Q_A">
                                	
                                	
                	<div class="R_r_title">活跃会员</div>
                    <div class="dl-con">
                                		<?php 
    $sys_config=SysConfig::model();
		$sys_config_values=$sys_config->get_all_syscfg();
		$sfc_cache=$sys_config_values['sfc_cache'];
		$sfc_cache_time=$sys_config_values['sfc_cache_time'];                           		
   if($sfc_cache=="N"){
			$cache=0;
		}else{
			if(empty($cache)){
				$cache=$sfc_cache_time;
			}
		}
		
		
                                		 if($this->beginCache("Wspace", array('duration'=>$cache))){
                                			$this->widget('Wspace', array( 
                                		   
							                      	)); 
							                       	Yii::app()->getController()->endCache(); 
                                    }  
							                      ?>
                	</div>
                </div><!--Q_A end-->
                
                
                
                <div class="new_infor">
                	<div class="R_r_title">最新资讯<a title="更多最新资讯" href="/mchannels/information/channel/136.shtml">更多></a></div>
                    <ul>
                    	<?php BZ::blocks("pattern/archives/view/title_block/sort/update_time/sort_type/DESC/limit/10/tlen/24/cacheid/newest_information");?>
                    </ul>
                </div><!--new_infor end-->
                <!--
            	<div class="contact_us">
                	<div class="R_r_title">联系我们</div>
                	<div class="contact-con">
                    	<div class="con-tel"><img src="<?php echo $cssPath;?>/images/contact_tel.jpg" /></div>
                    	<div class="address_txt">武汉市雄楚大道188号花园公寓四层</div>
                	</div>
                </div>
                
                -->
            </div><!--R-r-left end-->
        	<div class="clear_float"></div>
        </div><!--R_con_right end-->  
    </div><!--main_right end-->
    <div class="clear_float"></div>
</div><!--main_con end-->


<script language="javascript">

	jQuery(function(){
		show_more_region("more_sort","destination_area","more_sort_item");
		jQuery(".show_travel_region").bind("click",function(){
			var channel_id=jQuery(this).attr("channel_id");
			var end_region=jQuery(this).attr("end_region");
			var attr=jQuery(this).attr("attr");
			var limit=jQuery(this).attr("limit");
			var sort=jQuery(this).attr("sort");
			var sort_type=jQuery(this).attr("sort_type");
			var show="line_list_"+channel_id;
			get_travel_datas(show,channel_id,end_region,attr,"",limit,sort,sort_type,"tuijian");
			jQuery(this).parent().siblings().removeClass("current");
			jQuery(this).parent().addClass("current");
			
			
		});
		
		jQuery(".tejia_list_class").bind("click",function(){
			var channel_id=jQuery(this).attr("channel_id");
			var attr=jQuery(this).attr("attr");
			var limit=jQuery(this).attr("limit");
			var show="tejia_list";
			get_travel_datas(show,channel_id,"","a,t","",10,"update_time","DESC","tuijian");
			jQuery(this).siblings().removeClass("stor_ona");
			jQuery(this).addClass("stor_ona");
			
			
		});
		
		
	});
</script>