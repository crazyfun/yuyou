<div class="main_con">
<div class="content">
<?php echo $ucsynlogin ?>
<div class="cgbox">
	<p>成功登录<?php echo Yii::app()->name;?>，<span>2</span>秒钟后自动跳转到首页</p>
</div>
<script language="javascript">
	jQuery(function(){
		window.setTimeout(function(){window.location.href="<?= $this->createUrl('site/index'); ?>"},2000);
	});
</script>
</div>	
</div>

