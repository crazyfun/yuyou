           <?php foreach($content as $key => $value){ ?>
            	<li ><a class="<?php if($category==$value['id']){ echo $select; } ?>" href="<?php echo $value['href'];?>" title="<?php echo $value['name'];?>"><?php echo $value['name']; ?></a></li>
            <?php } ?>
         
           
           
           
           