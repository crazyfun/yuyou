<?php 
  	  Yii::app()->clientScript->registerScriptFile('/js/cloudcarousel/cloud-carousel.1.0.5.min.js');

?>
<div id="carousel_3d">
	<?php foreach($content as $key => $value){ ?>
	    <a href="<?php echo $value['img_href'];?>" alt="<?php echo $value['describe'];?>" title="<?php echo $value['title'];?>"><img class="cloudcarousel" src="<?php echo $value['flash_img'];?>" alt="<?php echo $value['describe'];?>" title="<?php echo $value['title'];?>" /></a>
 <?php } ?>
</div>
<div class="button3d">
    <input id="left-but"  type="button" value="&nbsp;" />
    <input id="right-but" type="button" value="&nbsp;" />
</div>
<div class="text3d">
    <p id="title-text"></p>
    <p id="alt-text"></p>
</div> 
           
<script language="javascript">
jQuery(function(){
 jQuery("#carousel_3d").CloudCarousel(      
        {           
        	  reflHeight:20,
						reflOpacity:0.5,
						reflGap:2,
            xPos: 495,
            yPos: 0,
            buttonLeft: jQuery("#left-but"),
            buttonRight: jQuery("#right-but"),
            altBox: jQuery("#alt-text"),
            titleBox: jQuery("#title-text"),
            autoRotate:"left",
            autoRotateDelay: 5000,
						speed:0.3
						//mouseWheel:true
						//bringToFront: true
        }
    );
});
</script>