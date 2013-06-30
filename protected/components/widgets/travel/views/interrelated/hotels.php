      <?php 
       $hotels=Hotels::model();
       foreach($content as $key => $value){ ?>

                  <li>
                     <p class="hb_xprice"><del>¥<?php echo $hotels->get_hotels_o_price($value['id']);?></del><strong>¥<?php echo $value['price'];?></strong>
                        <a target="_blank" href="<?php echo $value['href'];?>" title="<?php echo $value['title'];?>"><img alt="查看详细" src="<?php echo $cssPath;?>/images/order_normal_btn.gif"></a>
                     </p>
                     <a target="_blank" href="<?php echo $value['href'];?>" title="<?php echo $value['title'];?>"><?php echo $value['title'];?></a>
                 </li>  
                 
       <?php } ?> 
