<?php foreach($category_datas as $key => $value){ 
	     $sub_items=$value['sub_items'];
?>
      <div class="submenu martop10">
    	<h2><?php echo $value['name'];?></h2>
            <ul>
            	<?php foreach($sub_items as $key1 => $value1){ ?>
            	    <li><a href="<?php echo $this->controller->createUrl("help/index",array('cid'=>$value1['type_id']))."#h".$value1['id'];?>"><?php echo $value1['name'];?></a></li>
            	<?php } ?>

            </ul>
    </div><!--end submenu-->
    
<?php } ?>