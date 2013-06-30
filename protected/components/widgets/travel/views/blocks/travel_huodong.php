      <?php foreach($content as $key => $value){ ?>
      					 	<li>
                       <span class="buying"><img src="/themes/travel/css/images/buying.png" width="55" height="56"/></span>
                       <p><a title="<?php echo $value['title'];?>" href="<?php echo $value['href'];?>"><img alt="<?php echo $value['title'];?>" src="<?php echo $value['image'];?>" width="160" height="130"/></a></p>
                       <h3 class="main_buy_title"><a title="<?php echo $value['title'];?>" href="<?php echo $value['href'];?>"><?php echo $value['stitle'];?></a> </h3>
                       <p>誉游价：￥<span class="rb_price"><?php echo $value['price'];?></span>起</p>
                   </li>
       <?php } ?>
