       <?php foreach($content as $key => $value){ ?>
	    	     <li>
                 <div class="ibox_vpic"><a href="<?php echo $value['href'];?>" title="<?php echo $value['title'];?>"><p><img src="<?php echo $value['image'];?>" alt="<?php echo $value['title'];?>"/></p></a></div>
                 <div class="ibox_vtitle"><a href="<?php echo $value['href'];?>" title="<?php echo $value['title'];?>"><?php echo $value['stitle'];?></a></div>
              </li>
        <?php } ?>   
