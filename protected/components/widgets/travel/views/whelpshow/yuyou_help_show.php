  <div class="help_center">
    	<div class="help_con">
    		<?php foreach($information_datas as $key => $value){ 
	            $sub_items=$value['sub_items'];
        ?>
            <dl>
                <dt class="h_dl_title<?php echo $key+1;?>"><a href="#"><?php echo $value['name'];?></a></dt>
                <?php foreach($sub_items as $key1 => $value1){ ?>
                		<dd><a href="<?php echo $this->controller->createUrl("help/index",array('cid'=>$value1['type_id']))."#h".$value1['id'];?>"><?php echo $value1['name'];?></a></dd>
                <?php } ?>
                
            </dl>
        <?php } ?>    
        	<div class="clear_float"></div>
    	</div>
	</div><!--help_center end-->
	
	