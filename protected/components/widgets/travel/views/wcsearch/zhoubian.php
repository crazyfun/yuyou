<?php
	$travel_category=TravelCategory::model();
  $category_datas=$travel_category->get_zhoubian_category("5,32,24,29");
?>
 <div class="left_dl_con">
 	   <?php foreach($category_datas as $key => $value){
 	   	    $childrens=$value['childerns'];
 	   ?>
 	   			<dl>
                    <dt><?php echo $value->category_name;?></dt>
                    <?php foreach($childrens as $key1 => $value1){?>
                    		<dd><a href="<?php echo $this->controller->createUrl("search/index",array("action"=>"travel","channel_id"=>"131","line_type"=>$value1['category_id']));?>" title="<?php echo $value1['category_name'];?>"><?php echo $value1['category_name'];?></a></dd>
                    
                  <?php } ?>
                </dl>
 	       <div class="clear_float"></div>
 	 <?php } ?>
                
        	</div>