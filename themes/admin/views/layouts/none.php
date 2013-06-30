<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<link type="image/x-icon" rel="icon"  href="favicon.ico">
	<link type="image/x-icon" rel="shortcut Icon"  href="favicon.ico">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <?php
    $cssPath=$this->get_css_path();
    $jsPath=$this->get_js_path();
    Yii::app()->clientScript->registerCssFile($cssPath.'/admin.css');
		Yii::app()->clientScript->registerCoreScript('jquery');
		Yii::app()->clientScript->registerScriptFile('/js/basic.js');
		Yii::app()->clientScript->registerScriptFile($jsPath.'/admin.js');
		Yii::app()->clientScript->registerCssFile("/js/jbox/Skins2/Green/jbox.css");
    Yii::app()->clientScript->registerScriptFile('/js/jbox/jquery.jBox-2.3.min.js');
    Yii::app()->clientScript->registerScriptFile('/js/jbox/i18n/jquery.jBox-zh-CN.js');
    
		//Yii::app()->clientScript->registerScriptFile('/js/dialog.js');
  ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
	
<?php
		echo $content;
?>
</body>
</html>


