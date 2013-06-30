<?php 

 			$ip_convert=IpConvert::get();
		  $region_data=$ip_convert->init_region();
      $region_id=$region_data['id'];
      
      
?>
<div class="main_con">
<div class="w750">
   <div class="news_infor"><!--news_infor 详细-->
       <h1 class="news_title"><?php echo $content['title'];?></h1>
       <div class="sear_explain news_dd"><span>资讯类别:<?php echo $content->show_attribute("category_id"); ?></span><span>查看次数:<?php echo $content['views']; ?></span><span>发布时间:<?php echo $content['modify_time']; ?></span></div>
       	<p>
       		<?php echo $content['content'];?>
       	</p>
       	<div class="clear_float"></div>
       	 <?php if($content['is_vot']=='1'){ ?>
          <!-- //顶踩 -->
          	<div class="dcbox">
            	  <?php BZ::vot("pattern/".$pattern."/id/".$archive);?>
            </div>
          <!-- //顶踩 -->
        <?php } ?>
        
        <div class="clear_float"></div>
         <!--分享-->
          <div class="fxbox">
          	<div class="fxt">分享到：</div>
        <!-- Baidu Button BEGIN -->
       				 <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
        					<a class="bds_qzone"></a>
        					<a class="bds_tsina"></a>
        					<a class="bds_tqq"></a>
        					<a class="bds_renren"></a>
        					<span class="bds_more"></span>
									<a class="shareCount"></a>
    					</div>  
							<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=783195" ></script>
							<script type="text/javascript" id="bdshell_js"></script>
							<script type="text/javascript">
									document.getElementById("bdshell_js").src = "http://share.baidu.com/static/js/shell_v2.js?cdnversion=" + new Date().getHours();
							</script>

					<!-- Baidu Button END -->
          </div><!--分享结束-->
        
           <div class="clear_float"></div>
           <?php if($content['is_relation']=="1"){ ?> 
         <!--分页-->
          <div class="next">
          	    <?php BZ::relation("pattern/".$pattern."/id/".$archive."/show/v"); ?>
          		 
          </div>
        <?php } ?>
        
        
   </div><!--//news_infor 详细-->
</div><!--//w750-->
<div class="R-r-right">
                <div class="hot_rec_con">
                	<div class="R_r_title">热卖推荐<a href="#">更多></a></div>
                    <div class="hot_rec">
                        <ul>
                           <?php BZ::blocks("pattern/travel/view/travel_remai/region_id/".$region_id."/sort/update_time/sort_type/DESC/limit/10/attr/c,f/tlen/24/size/60*40/cacheid/search_tuijian_".$region_id);?>
                        </ul>
					</div>
                </div><!--hot_rec end-->
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
                    	<div class="con-tel"><img src="images/contact_tel.jpg" /></div>
                    	<div class="address_txt">武汉市雄楚大道188号花园公寓四层</div>
                	</div>
                </div>
                
                -->
  </div>

<div class="clear_float"></div>
</div><!--main_con end-->
