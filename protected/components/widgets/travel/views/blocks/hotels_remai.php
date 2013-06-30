         <?php foreach($content as $key => $value){ ?>
                           <li> 
                            		<span class="top_num"><?php echo $key+1;?></span>
                                <a title="<?php echo $value['title'];?>" href="<?php echo $value['href'];?>" class="rec_img_con"><p><img width="60" height="40" alt="<?php echo $value['title'];?>" src="<?php echo $value['image'];?>" /></p></a>
                                <p class="hot_rec_p"><a title="<?php echo $value['title'];?>" href="<?php echo $value['href'];?>"><span><?php echo $value['stitle'];?></span></a></p>
                                <div class="rec_price"><b><?php echo $value['price'];?></b>元起</div>
                            </li>
        <?php } ?> 
