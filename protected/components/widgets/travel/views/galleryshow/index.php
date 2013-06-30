          <?php
             Yii::app()->clientScript->registerScriptFile('/js/galleria/galleria-1.2.8.min.js');
          ?>
          	<h3><?php echo $content['title'];?></h3>
       	  	<h4><span>时间:<?php echo $content['modify_time'];?></span><span>点击:<?php echo $content['views'];?>次</span></h4>
            <div class="picbox"><!--图片-->
            	<div class="bigpic">
                 <div id="galleria">
                   	 <?php foreach($gallery_image_datas as $key => $value){ ?>
                   	    <a href="<?php echo "/".$value->Images->src;?>">
                					<img data-title="<?php echo $value->Images->name; ?>" data-description="<?php echo $value->Images->name; ?>" src="<?php echo "/".$value->Images->src; ?>"/>
            						</a> 
                     <?php } ?>
                 </div>
									
              <div class="pre_gallery"> 
              	<div class="plimg"><p><a href="<?php echo $first_href;?>"><img src="<?php echo Util::rename_thumb_file(90,90,"",$first_data['image']);?>" width="90px" height="90px" /></a></p>
                 </div>
                 <p><a href="<?php echo $first_href;?>">上一组图集</a></p>
               </div>
              
              <div class="next_gallery">
              	<div class="plimg"><p><a href="<?php echo $next_href;?>"><img src="<?php echo Util::rename_thumb_file(90,90,"",$next_data['image']);?>" width="90px" height="90px" /></a></p>
                </div>
                <p><a href="<?php echo $next_href;?>">下一组图集</a></p>
              </div>     
              </div>
            </div><!--结束 图片-->
<script language="javascript">
	jQuery(function(){
		    // Load the classic theme
    Galleria.loadTheme('/js/galleria/themes/classic/galleria.classic.min.js');

    // Initialize Galleria
    Galleria.run('#galleria');
	});
</script>