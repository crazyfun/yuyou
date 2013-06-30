<?php 

 			$ip_convert=IpConvert::get();
		  $region_data=$ip_convert->init_region();
      $region_id=$region_data['id'];
      
      
?>
<div class="main_con">
<div class="w750">
   <div class="news_search"><!--搜索-->
   	
       <table>
          <tr>
            <td><strong>标题：</strong><input name="" type="text" /></td>
            <td><strong>资讯类别：</strong><select name="">
              <option>类别一</option>
              <option>类别二</option>
            </select></td>
            <td><input type="button" value="搜索" class="ss_bnt"/></td>
          </tr>
       </table>
   </div><!--//搜索-->
  
   <div class="sear_list"><!--搜索的内容-->
       <ul>
       	
       	<?php BZ::lists("pattern/".$pattern."/id/".$channel."/category/".$category); ?>	

       </ul>
   </div><!--//搜索的内容-->
</div><!--//w750-->
<div class="R-r-right">
                <div class="hot_rec_con">
                	<div class="R_r_title">热门推荐<a href="#">更多></a></div>
                    <div class="hot_rec">
                        <ul>
                           <?php BZ::blocks("pattern/travel/view/travel_remai/region_id/".$region_id."/sort/update_time/sort_type/DESC/limit/10/attr/c,f/tlen/24/size/60*40/cacheid/search_tuijian_".$region_id);?>
                        </ul>
					</div>
                </div><!--hot_rec end-->
                <div class="new_infor">
                	<div class="R_r_title">最新资讯</div>
                    <ul>
                    	<?php BZ::blocks("pattern/archives/view/title_block/sort/update_time/sort_type/DESC/limit/10/tlen/24/cacheid/newest_information_".$region_id);?>
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