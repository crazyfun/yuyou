<?php
	$travel=Travel::model();
  $region_datas=$travel->get_end_region($this->channel_id,'',20);
  $travel_area=TravelArea::model();
  $area_datas=$travel_area->get_travel_areas($this->channel_id,"",20);
?>

<div class="left_dl_con">
                <dl>
                    <dt>热门景点</dt>
                    <?php foreach($area_datas as $key => $value){ ?> 
                    	<dd><a href="<?php echo $this->controller->createUrl("search/index",array("action"=>"travel","channel_id"=>$this->channel_id,"search_type"=>"scenic","search_condition"=>"","search_text"=>$value->travel_area));?>" title="<?php echo $value['travel_area'];?>"><?php echo $value['travel_area'];?></a></dd>
                  	<?php } ?>
                   
                </dl>
                <div class="clear_float"></div>
                <dl>
                    <dt>热门目的地</dt>
                    <?php foreach($region_datas as $key => $value){ ?> 
                    	<dd><a href="<?php echo $this->controller->createUrl("search/index",array("action"=>"travel",'channel_id'=>$this->channel_id,"search_type"=>"region","search_condition"=>$value->region_id,'search_text'=>$value->region_name));?>" title="<?php echo $value['region_name'];?>"><?php echo $value['region_name'];?></a></dd>
                  	<?php } ?>
                </dl>
                <div class="clear_float"></div>
        	</div>