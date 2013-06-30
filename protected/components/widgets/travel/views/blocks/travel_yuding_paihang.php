      <?php foreach($content as $key => $value){ ?>
                 <li>
                   <div class="main_rb_tjleft">
                     <h2><a title="<?php echo $value['title'];?>" href="<?php echo $value['href'];?>"><?php echo $value['title'];?></a></h2>
                     <p><?php echo $value['scontent'];?></p>
                   </div>
                   <div class="main_rb_tjright"><a href="javascript:get_travel_date('<?php echo $value['id'];?>');">查看团期</a></div>
                   <div class="main_rb_tjcenter"><span class="rb_price"><?php echo $value['price'];?></span>起</div>
                </li>
                
              
       <?php } ?>
