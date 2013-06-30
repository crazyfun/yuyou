<?php
               $ip_convert=IpConvert::get();
		 					 $region_data=$ip_convert->init_region();
    					 $region_id=$region_data['id'];
    					 $region_name=$region_data['name'];
?>

<div class="foot_con">
	 <div class="web_bot_ad"><?php BZ::ad("pattern/travel/position/1/cacheid/ad_1_".$region_id);?></div>
	
	<?php BZ::helpshow("view/yuyou_help_show/cids/22,23,24,25");?>
	
    <div class="help_bottom">
    	  <?php BZ::ad("pattern/travel/id/4");?>
        <div class="clear_float"></div>
    </div><!--help_bottom end-->
    <?php BZ::flink("limit/10");?>
	<div class="footer">
		<?php BZ::ad("pattern/travel/id/5");?>
	</div><!--footer end-->
</div>

<!--fanhui-->
    <!--<a id="Feedback" title="意见反馈" target="_blank" href="#" hidefocus="false"></a>-->
    <div id="goTopBtn"></div>
    <!--//fanhui-->