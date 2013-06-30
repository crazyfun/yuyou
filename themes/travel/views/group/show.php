<?php 
  
 			$ip_convert=IpConvert::get();
		  $region_data=$ip_convert->init_region();
      $region_id=$region_data['id'];
      
      
?>
<div class="main_con">
<div class="w750">
  <div class="tg-sbox">
  	<h1><font color="#ff0000"><?php echo $content->Region->region_name;?></font>今日团购: <?php echo $content->scontent;?></h1>
    <div class="tg_dealinfo">
       <div class="tg_dea_left">
           <div class="tg_dea_price">
               <div class="tg_buy">
               <div class="tg_dea_buy">
                  <span class="tg_buy_num"><span>¥</span><?php echo $content->price;?></span>
                <?php if($content->open=="1"){ ?>
                     <a class="tg_buy_btn_ready"  href="javascript:void(0);" style="position:relative;"></a>    
              <?php }else if($content->open=="2"){ ?>
                     <a class="tg_buy_btn"  href="<?php echo $this->createUrl("grouppay/step1",array('id'=>$content->id));?>" style="position:relative;"></a>   
            <?php }else{ ?>
              	     <a class="tg_buy_btn_over"  href="javascript:void(0);" style="position:relative;"></a>   
              <?php } ?>
                             
                  
                </div>
               </div>
          </div><!--//tg_dea_price-->
           <div class="tg_deal_fm">
             <table class="tg_pro_discount" width="100%" cellspacing="0" cellpadding="0" border="0">
              <tbody>
                 <tr>
                   <td>市场价<span><del>¥<?php echo $content->o_price;?></del></span></td>
                   <td>折扣<span><?php echo Util::get_discount($content->price,$content->o_price);?>折</span></td>
                   <td>节省<span>¥<?php echo ($content->o_price-$content->price);?> </span></td>
                 </tr>
             </tbody>
            </table>
         </div><!--//tg_deal_fm-->
         <ul class="tg_pro_mode">
            <li class="tm-mun"><em><?php echo $content->buy_numbers;?></em>人已购买</li>
            <li class="tm-time">剩余时间：<span class="diff_date" end_time="<?php echo $content->end_time;?>"></span></li>
            <li><div class="dlbox">
     	   <a href="javascript:favorite_group('<?php echo $content->id;?>')" class="dtl_savebtn">收藏该产品</a>
        </div></li>
        </ul>
       </div>
    </div><!--//tg_dea_left-->
    <div class="tg_dea_right">
       <div class="tg_pro_img"><img src="/<?php echo Util::rename_thumb_file(480,280,"",$content->image);?>" width="480" height="280"/></div>
        
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
    </div>
<div class="clear_float"></div>
  </div><!--//tg-sbox-->
<div class="tg_intr top10">
<div class="tg_intr_top"><img src="<?php echo $cssPath;?>/images/tg_intr_top.jpg" /></div>
<div class="tg_intr_center">
	
   <?php echo $content->content;?>
</div>


<div class="tg_intr_bottom"><img src="<?php echo $cssPath;?>/images/tg_intr_bottom.jpg" /></div>
</div><!--//tg_intr-->
</div><!--//w750-->
<div class="R-r-right">
             <div class="hot_rec_con">
                	<div class="R_r_title">热门推荐</a><a href="<?php echo $this->createUrl("group/list",array('channel'=>'137','category'=>$content->category_id));?>">更多></a></div>
                    <div class="hot_list">
                        <ul>
                        	<?php BZ::blocks("pattern/group/category/".$content->category_id."/view/recommend_group_block/attr/c/sort/update_time/sort_type/DESC/size/200*127/limit/5/cacheid/recommend_group_".$content->category_id);?>
                         
                        </ul>
					         </div>
                </div><!--hot_list end-->
       <div class="contact_us"><!--商家信息-->
         <div class="R_r_title">商家信息</div>
               <div class="map_info"><!--地图-->
               		<?php
  		
      				if($this->beginCache("WBaiduMaps", array('duration'=>"1"))){
                  $this->widget('WBaiduMaps', array( 
                     'coordinate'=>$content->Company->coordinate, 
                     'address'=>$content->Company->address          
              	  )); 
             		$this->endCache(); 
       			  }        
       			?>
               </div><!--//地图-->
               <div class="adr_info"><!--地址信息-->
                  <p>商家名称：<?php echo $content->Company->company_name;?></p>
                  <p>地址：<?php echo $content->Company->address;?></p>
                  <p>电话：<?php echo $content->Company->telephone;?></p>
                  <p>交通指南：<?php echo $content->Company->traffic;?></p>
               </div><!--//地址信息-->
      </div><!--//商家信息-->
  </div>

<div class="clear_float"></div>
</div><!--main_con end-->
<script language="javascript">
	jQuery(function(){
		jQuery(".diff_date").each(function(i){
			  set_diff_date(jQuery(this));
		});
		
	});
	
	function set_diff_date(ele){
		    var diff_date=ele.attr("end_time");
				var diff_dates=GetDateDiff(getTime(null),diff_date,"all");
				var diff_html=diff_dates[3]+"天"+diff_dates[2]+"时"+diff_dates[1]+"分"+diff_dates[0]+"秒";
				ele.html(diff_html);
				window.setTimeout(function(){set_diff_date(ele);},1000);
	}
	
	
	function favorite_group(group_id){
    	var user_id="<?= Yii::app()->user->id ?>";
    	if(user_id){
    	jQuery.ajax({
	    async:true,
        type: "Get",
        cache:true,
        beforeSend:function(){},
        url: "/api/groupfavorite",
        dataType:"json",
        data: "group_id="+group_id+"&rmd="+Date.parse(new Date()),
        success: function(msg){
          if(msg.flag=='1'){
          	jQuery.jBox.tip(msg.message, '收藏提示');
          }
        }
      });
    }else{
    	pop_no_pay_login();
    }
    	
    }
</script>