<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<meta name="description" content="<?php echo CHtml::encode($this->seo_description);?>">
	<meta name="keywords" content="<?php echo CHtml::encode($this->seo_keywords);?>">
	<link type="image/x-icon" rel="icon"  href="favicon.ico">
	<link type="image/x-icon" rel="shortcut Icon"  href="favicon.ico">
    <?php    
    $cssPath=$this->get_css_path();
    $jsPath=$this->get_js_path(); 
		Yii::app()->clientScript->registerCssFile($cssPath.'/css.css');
		Yii::app()->clientScript->registerCoreScript('jquery');
		Yii::app()->clientScript->registerScriptFile('/js/basic.js');
		Yii::app()->clientScript->registerCssFile("/js/jbox/Skins2/Pink/jbox.css");
		Yii::app()->clientScript->registerScriptFile('/js/jbox/jquery.jBox-2.3.min.js');
		Yii::app()->clientScript->registerScriptFile('/js/jbox/i18n/jquery.jBox-zh-CN.js');
    ?>
	
</head>
<body>
	<div class="container">
  	   <?php $this->renderPartial("../main/header",array(),false);?>
<div class="content"><!--content-->
        <div class="membermain"><!--membermain-->
        	<div class="membertop"><img src="<?php echo $cssPath;?>/images/page_top.gif" /></div>
            <div class="membercontent"><!--会员内容-->
            	<div class="memberleft">
             <?php
      				if($this->beginCache("UserMenu", array('duration'=>"1"))){
                  $this->widget('UserMenu', array(             
              )); 
             $this->endCache(); 
       			 }        
      			 ?>
                	
                </div>
                <div class="memberright">
                	 <?php echo $content; ?>
                
                </div>
            <div style="clear:both;"></div>
            </div>
            <div class="memberbot"><img src="<?php echo $cssPath;?>/images/page_bot.gif" /></div>
        </div><!--end membermain-->
   </div>
    <!--content-->
    <?php $this->renderPartial("../main/footer",array(),false);?>
   </div>
</body>
</html>


