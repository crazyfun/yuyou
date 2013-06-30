<div class="content">
	<div class="subleft">
        <h2>当前位置:<?php $this->widget('zii.widgets.CBreadcrumbs', array(
								     'links'=>$this->breadcrumbs,
							    )); ?></h2>
   		<div class="sublbox">
           	    <ul>
           	    	<?php BZ::lists("pattern/".$pattern."/id/".$channel."/category/".$category); ?>	
                </ul>
        <div style="clear:both"></div>
        </div> 
    
    </div><!--end subleft-->
<div class="subright">
	<div class="submenu">
    	  <h2>栏目列表</h2>
        <ul>
        	  <?php BZ::channels("pattern/".$pattern."/parent/".$channel."/show/2");?>
        </ul>
    </div><!--end submenu-->
    
    <div class="ibox">
        	    <div class="ibox_title"><h2>推荐内容</h2></div>
                <div class="ibox_dater6"><!--标题+描述-->
                	<ul>
                    	<?php BZ::blocks("pattern/".$pattern."/channel/".$channel."/category/".$category."/view/title_desc_block/sort/modify_time/sort_type/DESC/limit/10/attr/c/cacheid/right_recommend_".$channel);?> 
                    	
                    </ul>
                </div>
                
<div style="clear:both"></div>
</div><!--结束 推荐内容-->

  <div class="ibox martop10">
    	  <div class="ibox_title"><h2>建站咨询</h2></div>
        <div class="ibox_contact">
        	
        	  <?php echo BZ::ad("pattern/".$pattern."/id/32");?>
            
        </div>
    </div><!--end 建站咨询-->
    
    
</div>
</div>
<!--end content-->
<div style="clear:both"></div>