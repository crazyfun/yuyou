<div class="main_con">
<div class="content">
<?php echo $ucsynlogout ?>
<div class="cgbox"><!--成功登录页面-->
	<p>您已经成功退出<?php echo Yii::app()->name;?>。</p>
    <p><a href="<?php echo $this->createUrl("login/index");?>">重新登录</a></p>
</div>
</div>	
</div>