       <?php foreach($content as $key => $value){ ?>
        <div class="ibox_text">
         	<div class="ibox_left"><div class="ibox_d4pic"><p><a href="<?php echo $value['href'];?>" title="<?php echo $value['title'];?>"><img src="<?php echo $value['image'];?>" alt="<?php echo $value['title'];?>" /></a></p></div></div>
         	<div class="ibox_d4li">
        	 <h2><a href="<?php echo $value['href'];?>" title="<?php echo $value['title'];?>"><?php echo $value['stitle'];?></a></h2>
             <p><?php echo $value['scontent'];?></p> 
           </div>
         </div><!--end ibox_text-->
        <?php } ?>   
