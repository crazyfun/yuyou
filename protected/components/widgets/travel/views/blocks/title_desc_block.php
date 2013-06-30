       <?php foreach($content as $key => $value){ ?>
	    	     <li>
                          <h2><a  href="<?php echo $value['href'];?>" title="<?php echo $value['title'];?>"><?php echo $value['stitle'];?></a></h2>
                          <p><?php echo $value['scontent'];?></p>
             </li>
        <?php } ?>   
