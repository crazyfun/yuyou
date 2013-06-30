<?php foreach((array)$content as $key => $value){ ?>
			<div class="mapli">
         <h3><a href="<?php echo $value['href'];?>" title="<?php echo $value['name'];?>"><?php echo $value['name']; ?></a></h3>		
   	     <ul>
   	     	 <?php foreach((array)$value['children'] as $key1 => $value1){ ?>
                <li><a title="<?php echo $value1['name'];?>" href="<?php echo $value1['href'];?>"><?php echo $value1['name']; ?></a>|</li>
				   <?php } ?>
           <div style="clear:both"></div>
			 </ul>
     </div>
<?php } ?>
