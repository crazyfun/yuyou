<div class="content">
	<!-- 3dflash -->
 <!-- size: 280px * 180px -->
    	     <div class="flashnews" id="banner"><!--图片切换-->
			        <?php BZ::flash("pattern/gallery");?>
          </div>
<div class="pleft">


  <div class="ibox martop0"><!--技术-->
  	<div class="ibox_title"><span><?php BZ::more("pattern/gallery/channel/121");?></span><h2>高清图片</h2></div>
  	<div class="ibox_date1"><!--图片+标题-->
    <div class="ibox_d1li">
        	<ul>
       	     <?php BZ::blocks("pattern/gallery/id/29");?> 
            </ul> 
        </div>
    </div>
  </div>
  
  
    <div class="ibox"><!--图文资讯-->
  	<div class="ibox_title"><span><?php BZ::more("pattern/gallery/channel/122");?></span><h2>最新模版</h2></div>
    <div  id="scrollpic">
        <div id="inscrollpic">
    	<div id="scrollpic1"><!--图片内容-->
        
           <div id="Marquee">
	    			<ul>
              <?php BZ::blocks("pattern/gallery/id/30");?>
            </ul> 
           </div>
        </div>
    	<div id="scrollpic2"></div>
    </div>
    </div>

  <div style="clear:both"></div>
  </div><!--/图文资讯-->
  
  <div class="ibox martop0"><!--技术-->
  	<div class="ibox_title"><span><?php BZ::more("pattern/gallery/channel/125");?></span><h2>高清壁纸</h2></div>
  	<div class="ibox_date1"><!--图片+标题-->
    <div class="ibox_d1li">
        	<ul>
       	     <?php BZ::blocks("pattern/gallery/id/31");?> 
            </ul> 
        </div>
    </div>
  </div>
  
  




<div class="ibox"><!--图集-->
  	<div class="ibox_title"><span><?php BZ::more("pattern/gallery/channel/124");?></span><h2>推荐表情</h2></div>
  	<div class="ibox_dater4">
  		   <?php BZ::blocks("pattern/gallery/id/32");?> 
      </div>
</div>
  
  
  
  
  
  
  
  </div><!--end pleft-->
  <div class="pright"><!--pright-->
  	

    <div class="submenu">
    	  <h2>栏目列表</h2>
        <ul>
        	  <?php BZ::channels("pattern/".$pattern."/parent/".$channel."/show/2");?>
        </ul>
    </div><!--end submenu-->
    
  	   <div class="ibox martop10">
        	    <div class="ibox_title"><span><?php BZ::more("pattern/gallery/channel/123");?></span><h2>图标推荐</h2></div>
                <div class="ibox_dater6"><!--图片+描述-->
                	<?php BZ::blocks("pattern/gallery/id/33");?>

                </div>
        <div style="clear:both"></div>        
       </div>
       
       
    <div class="ibox martop10">
    	  <div class="ibox_title"><h2>建站咨询</h2></div>
        <div class="ibox_contact">
        	
        	  <?php echo BZ::ad("pattern/archives/id/32");?>
            
        </div>
    </div><!--end 联系我们-->
    
    
    
</div>
</div><!--end content-->
<div style="clear:both"></div>