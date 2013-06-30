				<h2 class="left_hot_title">
          <ul>
           <li><a href="javascript:void(0);" class="tt_tab tt_tab_active" index="1"  title="热门路线" >热买路线</a></li>
           <li><a href="javascript:void(0);" class="tt_tab" index="2"  title="当季推荐" >当季推荐</a></li>
         </ul>
       </h2>
       
       <div class="tabcontent" id="tabcontent_1"><!--Start Tabcontent 1 热门路线-->
           <div class="hot_rec left_hot_li">
                        <ul>
          <?php foreach($remai_travel_datas as $key => $value){ 
          	    $image=$value->get_first_image($value->id);
          	    $image="/".Util::rename_thumb_file(60,40,"",$image);
          	    $href=$value->set_channel_link("travel",$value->id);
          	    $price=$value->get_travel_price($value->id);
          	    $stitle=Util::cutstr($value->title,24);
          ?>
                           <li> 
                            		<span class="top_num"><?php echo $key+1;?></span>
                                <a title="<?php echo $value['title'];?>" href="<?php echo $href;?>" class="rec_img_con"><p><img width="60" height="40" alt="<?php echo $value['title'];?>" src="<?php echo $image;?>" /></p></a>
                                <p class="hot_rec_p"><a title="<?php echo $value['title'];?>" href="<?php echo $href;?>"><span><?php echo $stitle;?></span></a></p>
                                <div class="rec_price"><b><?php echo $price;?></b>元起</div>
                            </li>
        <?php } ?> 
                        </ul>
					</div>
       <div class="clear_float"></div> 
       </div><!--End Tabcontent 1-->
       
       
       
       <!--Start Tabcontent 2-->
       <div class="tabcontent" id="tabcontent_2" style="display:none;">
          <div class="hot_rec left_hot_li">
                        <ul>
        <?php foreach($tuijian_travel_datas as $key => $value){ 
          	    $image=$value->get_first_image($value->id);
          	    $image="/".Util::rename_thumb_file(60,40,"",$image);
          	    $href=$value->set_channel_link("travel",$value->id);
          	    $price=$value->get_travel_price($value->id);
          	    $stitle=Util::cutstr($value->title,24);
          ?>
                           <li> 
                            		<span class="top_num"><?php echo $key+1;?></span>
                                <a title="<?php echo $value['title'];?>" href="<?php echo $href;?>" class="rec_img_con"><p><img width="60" height="40" alt="<?php echo $value['title'];?>" src="<?php echo $image;?>" /></p></a>
                                <p class="hot_rec_p"><a title="<?php echo $value['title'];?>" href="<?php echo $href;?>"><span><?php echo $stitle;?></span></a></p>
                                <div class="rec_price"><b><?php echo $price;?></b>元起</div>
                            </li>
        <?php } ?> 
                        </ul>
					</div>
       </div>
       <!--End Tabcontent 2 -->
       <script language="javascript">
       jQuery(function(){
          togglemenu({"source":"tt_tab","target":"tabcontent","type":"1","effect":"2","effect_time":1000});
       
       });
       
       </script>