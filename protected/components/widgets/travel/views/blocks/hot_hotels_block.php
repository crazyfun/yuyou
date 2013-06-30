							<?php foreach($content as $key => $value){ ?>
                <li class="h_n<?php echo $key+1;?>"><span><b><?php echo $value['price'];?></b>元起</span><a href="<?php echo $value['href'];?>" title="<?php echo $value['title'];?>"><?php echo $value['stitle'];?></a></li>
                
               <?php } ?> 
              