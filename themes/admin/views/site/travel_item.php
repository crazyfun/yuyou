 <tr class="search_sclist">
               <td class="td1"><?php echo $data->number;?></td>
               <td class="td2">
                 <h2 class="td2_h2"><a href="<?php echo $this->createUrl("travel/show",array('id'=>$data->id));?>"><?php echo $data->title;?></a></h2>
                 <p class="td2_num"><span>订单数：<s class="td_red"><?php echo $data->buy_numbers;?></s> </span><span>出发地：<?php echo $data->StartRegion->region_name;?></span><span>目的地：<?php echo $data->EndRegion->region_name;?></span></p>
                 <p class="td2_xx"><?php echo $data->scontent;?></p>
              </td>
               <td class="td3"><?php echo $data->get_travel_date($data->id);?><p><a href="javascript:get_travel_date('<?php echo $data->id;?>');" class="td8_a2">查看团期</a></p></td>
               <td class="td4"><a href=""><a href="javascript:frame_view('/station.php/company/view','company','<?php echo $data->company_id;?>');"><?php echo $data->Company->company_name;?></a><a class="qqOn" target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $data->Company->qq1;?>&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo $data->Company->qq1;?>:41 &r=0.8940031429092906" alt="<?php echo $data->Company->company_name;?>" title="<?php echo $data->Company->company_name;?>"></a></td>
               <td class="td5"><?php echo $data->show_attribute("linetype");?></td>
               <td class="td6">
                 <p>成团人数：<?php echo $data->group_number;?>人</p>
                 <p>已预订数：<?php echo $data->buy_numbers;?>人</p>
                 <P>
                <?php if($data->group_number>$data->buy_numbers){?>
                 	<img src="/themes/station/css/images/ht_icon2.jpg" />
                <?php }else{?>
                  <img src="/themes/station/css/images/ht_icon.jpg" />
                <?php } ?>
              </P>
               </td>
               <td class="td7">
                <p>成人价：<?php echo $data->get_travel_price($data->id);?> 元</p>
                <p>成人结算价：<s class="td_red"><?php echo $data->get_jiesuan_travel_price($data->id);?></s>元</p>
                <P>儿童价：<?php echo $data->get_child_price($data->id);?> 元</P>
                <P>儿童结算价:<s class="td_red"><?php echo $data->get_jiesuan_child_price($data->id);?></s>元</P>
                </td>
               <td class="td8">
                 <a href="<?php echo $this->createUrl("travel/show",array('id'=>$data->id));?>" class="td8_a1">预定</a>
                 
               </td>
            </tr>