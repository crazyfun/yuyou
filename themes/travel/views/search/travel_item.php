<div class="search_sclist">
     	<div class="product_cover"><a href="<?php echo $data->set_channel_link("travel",$data->id);?>" title="<?php echo $data->title;?>"><img width="148" height="80" alt="<?php echo $data->title;?>" src="/<?php $first_image=$data->get_first_image($data->id);echo Util::rename_thumb_file(148,80,'',$first_image);?>" /></a></div>
        <div class="package_price">
        	<div class="price_box"><strong><?php echo $data->price;?>元起</strong></div>
            <div class="stregion"><strong>订单数:<span class="around_price"><?php echo $data->buy_numbers;?></span></strong></div>
            <div class="clear_float"></div>
            <div class="stregion"><?php echo $data->StartRegion->region_name;?>出发</div>
        </div>
        
        <div class="product_summary">
       	  <h4><a href="<?php echo $data->set_channel_link("travel",$data->id);?>" title="<?php echo $data->title;?>"><?php echo $data->title;?></a>
                <?php echo $data->show_search_attr_attribute();?>
          </h4>
           <div class="clear_float"></div>
           <div class="product_extrainfo">
       		 <p><span class="w190">类型：<?php echo $data->show_attribute("channel_id");?></span><span class="w190">目的地：<?php echo $data->EndRegion->region_name;?></span></p>
                <div class="trave_search"><?php echo $data->scontent;?></div>
           </div>
        </div>
        <div class="clear_float"></div>
     </div><!--//search_sclist-->