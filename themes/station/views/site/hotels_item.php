 <tr>
               <td class="td1"><?php echo $data->number;?></td>
               <td class="td2">
                 <h2 class="td2_h2"><a href="<?php echo $this->createUrl("hotels/show",array('id'=>$data->id));?>"><?php echo $data->title;?></a></h2>
                 <p class="td2_num">
                 	订单数：<s class="td_red"><?php echo $data->buy_numbers;?></s> 城市：<?php echo $data->show_attribute("hotel_region");?>
                 </p>
                 <p>酒店电话:<?php echo $data->show_attribute("hotel_telephone");?></p>
                 <p>
                 	地址：<?php echo $data->hotel_address;?>
                 </p>
                 <p><?php echo $data->scontent;?></p>
                 		
      
                
              </td>
               <td class="td3"> 
               			
               			<p>品牌:<?php echo $data->show_attribute("brand_id");?></p>
                    <p>设施:<?php echo $data->show_attribute("facility");?></p>
               </td>
               <td class="td3"><?php echo $data->get_hotels_level();?></td>
               <td class="td5"><span class="h_room_price"><dfn>¥</dfn><?php echo $data->get_hotels_price($data->id);?></span>起</td>
               <td colspan="2" class="td7"> 
                 <p><a href="<?php echo $this->createUrl("hotels/show",array('id'=>$data->id));?>" class="td8_a1">查看</a>
               </p></td>
            </tr>
            <tr><td  class="td1 tdbor"></td>
            <td colspan="5" class="tdbor">
            <div class="h_sear_room"><!--h_sear_room-->
               
              <div class="htl_room_table" hotels_id="<?php echo $data->id;?>">
               	
          		</div>
               
            </div>
            </td>
            <td class="td8 tdbor"></td></tr>