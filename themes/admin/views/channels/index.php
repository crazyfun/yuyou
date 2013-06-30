 <div id="page_content">
	
    <div class="show_right_content">
 <!--用户操作-->
    	<div class=""><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("channels/add");?>">增加顶级栏目</a></span></div></div>
    <!--用户操作end-->
<?php      
$this->widget('CTreeView',array(
    'persist'=>'cookie',
    'animated'=>'fast',
    'url' => array('main/filltree'),
    'htmlOptions'=>array('id'=>'treeview','class'=>'treeview treeview-famfamfam'),
));
?>

    	 <!--编辑框end-->	
    </div>
</div>