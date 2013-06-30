<div class="h_sear_li"><!--h_sear_li-->
            <ul class="h_sear_info"><!--h_sear_info-->
               <li class="h_price_icon"><span><dfn>¥</dfn><?php echo $data->get_hotels_price($data->id);?></span>起</li>
               <li class="h_info_image"><div class="h_spic"><img alt="<?php echo $data->title;?>" src="/<?php echo Util::rename_thumb_file("100","75","",$data->get_first_image($data->id));?>" width="100" height="75"/></div></li>
               <li class="h_info_name">
                  <h2><a href="<?php echo $this->createUrl("hotels/show",array('id'=>$data->id));?>" title="<?php echo $data->title;?>"><?php echo $data->title;?></a></h2>
                   <p class="h_info_address"><?php echo $data->show_attribute("hotel_region");?></p>
                   <p class="h_info_address"><?php echo $data->hotel_address;?></p>
                   <p class="h_info_address"><?php echo $data->scontent;?></p>
               </li>
               <li>
          			<div class="h_judge_box">
          	        <p>品牌:<?php echo $data->show_attribute("brand_id");?></p>
                    <p>设施:<?php echo $data->show_attribute("facility");?></p>
                    <p><?php echo $data->get_hotels_level();?></p>
                 </div>
               </li>
               <div style="clear:both;"></div>
            </ul><!--//h_sear_info-->
         
            <div class="h_sear_room"><!--h_sear_room-->
            	 <div class="htl_room_table" hotels_id="<?php echo $data->id;?>">
          			</div>
            </div><!--//h_sear_room-->  
        </div><!--//h_sear_li-->