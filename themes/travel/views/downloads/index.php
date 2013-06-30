
<div class="content">
	<div class="subleft">
        <h2>当前位置:<?php $this->widget('zii.widgets.CBreadcrumbs', array(
								     'links'=>$this->breadcrumbs,
							    )); ?></h2>
   		<div class="sublbox">
       	  <div class="subt_single"><!--单页-->        
             <?php echo $content;?>
       	  </div>
          <div style="clear:both"></div>
        </div> 
    
    </div><!--end subleft-->
<div class="subright">
	
	  <div class="ibox martop0">
        <div class="ibox_apply_yewu">
        	 <div>业务代理申请</div>
        	 <div>建站套餐订购</div>
        	 <div>建站需求留言</div> 
        </div>
    </div>
    

    
    
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
