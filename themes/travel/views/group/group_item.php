    <li>
       <div class="tg_shoplist_imgbox">
          <a href="<?php echo $data->set_channel_link("group",$data->id);?>" title="<?php echo $data->title;?>"><img alt="<?php echo $data->title;?>" src="/<?php echo Util::rename_thumb_file(292,146,'',$data->image);?>"/></a>
          <div class="tg_shoplist_imginfo">剩余时间：<span class="diff_date" end_time="<?php echo $data->end_time;?>"></span></div>
       </div>
       <div class="tg_shoplist_bar">
          <a href="<?php echo $data->set_channel_link("group",$data->id);?>" class="tg_bnt">&nbsp;</a>
          <span class="tg_price">￥<em><?php echo $data->price;?></em></span>       
       </div>
       <p class="tg_shoplist_txt"><a href="<?php echo $data->set_channel_link("group",$data->id);?>" title="<?php echo $data->title;?>"><?php echo $data->title;?></a></p>
       <div class="tg_shoplist_dtl"> 
         <table class="tg_shoplist_dtlT">
           <tbody>
             <tr>
              <td class="tg_shoplist_dtlTL">原价：<del>¥<?php echo $data->o_price;?> </del></td>
              <td width="100">折扣<em><?php echo Util::get_discount($data->price,$data->o_price);?></em>折</td>
              <td class="tg_shoplist_dtlTR"><em><?php echo $data->buy_numbers;?></em>人已购买</td>
             </tr>
             <tr> </tr>
           </tbody>
         </table>
         <div class="tg_shoplist_txtlist" show_flag="f">
           <?php echo $data->scontent;?>
        </div>
       </div>
    </li>