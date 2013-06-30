     <?php foreach($content as $key => $value){ ?>
        		<li>
              	<div class="main_rbpic"><a title="<?php echo $value['title'];?>" href="<?php echo $value['href'];?>"><img width="90" height="60" alt="<?php echo $value['title'];?>" src="<?php echo $value['image'];?>"/></a></div>
                <div class="main_rb_center">
                	<h3 class="main_rb_h3"><a title="<?php echo $value['title'];?>" href="<?php echo $value['href'];?>"><?php echo $value['title'];?></a></h3>
                  <p class="main_rb_text">誉游价：<span class="rb_price"><?php echo $value['price'];?></span>起<span>抵用券：<?php echo $value['coupon'];?>元</span><span>已预订：<?php echo $value['buy_numbers'];?>人</span></p>
                    <p><?php echo $value['scontent'];?></p>
                </div>
                <div class="bnt_destine"><a title="<?php echo $value['title'];?>" href="<?php echo $value['href'];?>"><img src="/themes/travel/css/images/bnt_destine.jpg" /></a></div>
             </li>
       <?php } ?>
