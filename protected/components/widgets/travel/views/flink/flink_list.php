<div class="linksbox"><!--友情链接-->
    	<dl class="linksmain">
        	<dt><!--链接类型-->
            	  <strong>友情链接</strong>
                <span class="linklabel">
                	<?php foreach($content as $key => $value){?>
			                <a class="flinktype_item <?php if($key==0) echo "linklabela_hover";?>" href="javascript:void();" keys="<?php echo $value['id'];?>"><?php echo $value['type_name'];?></a>
			           <?php } ?>
	              </span>
            </dt><!--结束 链接类型-->
            
            <?php foreach($content as $key => $value){
            	    $link_datas=$value['friendlink'];
            ?>
			                 <dd id="flink_<?php echo $value['id'];?>" class="flink_item" <?php if($key==0) echo "style='display:block;'"; else echo "style='display:none;'";?>>
            	  					<ul>
            	  						<?php  foreach($link_datas as $key1 => $value1){ ?>
                						     <li><a rel="nofollow" href="<?php echo $value1['friendlink_href'];?>" target="_blank"><?php echo $value1['friendlink_name'];?></a></li>
                					  <?php } ?>
                					</ul>
            					</dd>
			       <?php } ?>    
    <div style="clear:both"></div>
    </div>
    
    <script language="javascript">
    	jQuery(function(){
    		 jQuery(".flinktype_item").hover(function(){
    		 	  var keys=jQuery(this).attr("keys");
    		 	  jQuery(".linklabela_hover").removeClass("linklabela_hover");
    		 	  jQuery(this).addClass("linklabela_hover");
    		 	  jQuery(".flink_item").hide();
    		 	  jQuery("#flink_"+keys).show();
    		 	
    		},function(){
    			  
    		});
    		
    	})
    </script>