<div id="page_content">
    <div class="show_right_content">
    <!--编辑框-->	
    	<div class="edit_content">
           <div class="content_title">查看详细信息</div>
           <?php foreach($view_datas as $key => $value){ ?>
              <div class="content_inline">
              	<div class="content_name"><?php echo $value;?>:</div><div class="content_content"><?php echo $model->show_attribute($key);?></div>
             </div>
           <?php } ?>
           <div class="content_button">&nbsp;</div>
    	</div>
    	 <!--编辑框end-->	
    </div>
</div>