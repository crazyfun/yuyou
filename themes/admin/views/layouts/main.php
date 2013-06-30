<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<link type="image/x-icon" rel="icon"  href="favicon.ico">
	<link type="image/x-icon" rel="shortcut Icon"  href="favicon.ico">
	<link type="image/x-icon" rel="icon"  href="favicon.ico">
	<link type="image/x-icon" rel="shortcut Icon"  href="favicon.ico">
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <?php    
    $cssPath=$this->get_css_path();
    $jsPath=$this->get_js_path();
		Yii::app()->clientScript->registerCssFile($cssPath.'/admin.css');
		Yii::app()->clientScript->registerCssFile($jsPath.'/themes/default/easyui.css');
		Yii::app()->clientScript->registerCssFile($jsPath.'/themes/icon.css');
		Yii::app()->clientScript->registerScriptFile($jsPath.'/jquery-1.4.2.min.js');
		Yii::app()->clientScript->registerScriptFile('/js/basic.js');
		Yii::app()->clientScript->registerScriptFile($jsPath.'/admin.js');
		Yii::app()->clientScript->registerCssFile("/js/jbox/Skins2/Green/jbox.css");
    Yii::app()->clientScript->registerScriptFile('/js/jbox/jquery.jBox-2.3.min.js');
    Yii::app()->clientScript->registerScriptFile('/js/jbox/i18n/jquery.jBox-zh-CN.js');
		Yii::app()->clientScript->registerScriptFile($jsPath.'/jQuery.easyui.js');
		Yii::app()->clientScript->registerScriptFile($jsPath.'/outlook2.js');
    ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body class="easyui-layout" style="overflow-y: hidden"  scroll="no">
	
    <div region="north" split="true" border="false" style="overflow: hidden; height: 50px;background: url(<?php echo $cssPath;?>/images/layout-browser-hd-bg.gif) #7f99be repeat-x center 50%;line-height: 20px;color: #fff; font-family: Verdana, 微软雅黑,黑体">
        <span style="float:right; padding-right:20px;" class="head"><span id="clock"></span>|欢迎 <?php echo Yii::app()->user->getName(); ?>|你有<font color="#ff000"><?php $message=Messages::model();$message_count=$message->count('t.user_id=:user_id OR is_all=:is_all AND t.status=:status',array(':user_id'=>Yii::app()->user->id,':is_all'=>'2',':status'=>'1')); echo empty($message_count)?0:$message_count; ?></font>未读信息|<a target="_blank" href="<?php echo Yii::app()->homeUrl;?>">网站首页</a>|<a  href="javascript:clear_cache();">清除缓存</a>|<a target="_top" href="<?php echo $this->createUrl("site/logout");?>">退出</a></span>
        
        <span style="position: absolute; padding-left: 10px; font-size: 20px; top: 12px;">
        	  誉游网管理后台
        </span>

    </div>
    <!--  导航内容 -->
				  <?php $this->widget("LeftMenu",
	                    array(
	                       'views'=>'left_menu',
	                    )
	        );?>
	        
    
    <div id="mainPanle" region="center" style="background: #eee; overflow-y:hidden">
        <div id="tabs" class="easyui-tabs"  fit="true" border="false" >
			    <div title="欢迎使用" style="overflow:hidden;" id="home">
			      	<iframe scrolling="0" frameborder="0" style="width:100%;height:100%" src="<?php echo $this->createUrl("site/welcome");?>">
			      		
			      	</iframe>
			    </div>
				  
		    </div>
    </div>
    
<script language="javascript">
	jQuery(document).ready(function(){
	  var clock=new Clock();
	  var clock_obj=document.getElementById("clock");
	  clock.display(clock_obj);
  });
  
</script>
</body>
</html>


