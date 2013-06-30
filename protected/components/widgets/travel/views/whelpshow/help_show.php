<div class="helpbox"><!--帮助中心--> 	
<?php foreach($information_datas as $key => $value){ 
	     $sub_items=$value['sub_items'];
?>
       <div class="helpmenu <?php if($key!='0') echo "borleft";?>">
        	<dd>
              <dt><?php echo $value['name'];?></dt>
              <?php foreach($sub_items as $key1 => $value1){ ?>
            	    <dl><a href="<?php echo $this->controller->createUrl("help/index",array('cid'=>$value1['type_id']))."#h".$value1['id'];?>"><?php echo $value1['name'];?></a></dl>
            	<?php } ?>
       	     
            </dd>
       </div>
        
<?php } ?>
       <div style="clear:both"></div>
     </div>