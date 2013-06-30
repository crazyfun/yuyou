<?php 
      Yii::app()->clientScript->registerCssFile('/js/slidy/jquery.slidy.css');
  	  Yii::app()->clientScript->registerScriptFile('/js/slidy/jquery.slidy.min.js');

?>

<div id="slide_menu">
	 <?php foreach($content as $key => $value){ ?>
    <a title="<?php echo $value['describe'];?>" href="<?php echo $value['img_href'];?>"><img  src="<?php echo $value['flash_img'];?>" alt="<?php echo $value['describe'];?>" title="<?php echo $value['describe'];?>"/></a>
   <?php } ?> 

</div> 

           
<script language="javascript">
	jQuery('#slide_menu').slidy({
    animation:  'slide',
    children:   'a',
    menu:       true,
    pause:      true,
    speed:      400,
    time:       4000,
    width:      722,
    height:     210
                    
});

</script>