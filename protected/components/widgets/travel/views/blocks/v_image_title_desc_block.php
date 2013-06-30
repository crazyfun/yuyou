       <?php foreach($content as $key => $value){ ?>
                   <div class="ibox_dbox  martop10">
                       <div class="ibox_left">
                         <div class="ibox_d5pic"><a href="<?php echo $value['href'];?>" title="<?php echo $value['title'];?>">
                           <p><img src="<?php echo $value['image'];?>" alt="<?php echo $value['title'];?>"/></p>
                         </a></div>
                       </div>
                       <div class="iboxd_5t">
                    	   <h2><a href="<?php echo $value['href'];?>" title="<?php echo $value['title'];?>"><?php echo $value['stitle'];?></a></h2>
                           <p><?php echo $value['scontent'];?></p>
                       </div>
                    </div> 
        <?php } ?>   
