<div class="content">
	<div class="subleft">
        <h2>当前位置:
        	    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
								     'links'=>$this->breadcrumbs,
							    )); ?>
				</h2>
   		<div class="sublbox">
        	<div class="dowmain"><!--下载 详细-->
            	<div class="downinfo"><!--产品基本信息-->
                   <h3><?php echo $content['title'];?></h3>
                   <div class="infolist">
				        <p><small>软件类型：</small><span><?php echo $content->show_attribute("soft_type");?></span></p>
				        <p><small>授权方式：</small><span><?php echo $content->show_attribute("soft_license");?></span></p>
				        <p><small>界面语言：</small><span><?php echo $content->show_attribute("soft_language");?></span></p>
				        <p><small>软件大小：</small><span><?php echo $content->show_attribute("soft_size");?></span></p>
				        <p><small>文件类型：</small><span><?php echo $content->show_attribute("soft_extension");?></span></p>
				        <p><small>运行环境：</small><span><?php echo $content->show_attribute("soft_environment");?></span></p>
				        <p><small>软件等级：</small><span><?php echo $content->show_attribute("soft_level");?></span></p>
				        <p><small>发布时间：</small><span><?php echo $content->show_attribute("create_time");?></span></p>
				        <p><small>官方网址：</small><span><?php echo $content->show_attribute("soft_website");?></span></p>
                <p><small>演示网址：</small><span><?php echo $content->show_attribute("soft_demo");?></span></p>
                <p><small>下载次数：</small><span><?php echo $content->show_attribute("downloads_times");?>次</span></p>
			       </div> 
                </div><!-- /info -->
                <div class="downintr"><!--产品介绍-->
                	<div class="downintr_title"><span>软件介绍</span></div>
                	<div class="downintr_content">
                    	   <?php echo $content->show_attribute('content');?>
                    </div>             
                </div>
                <div class="downintr"><!--下载地址-->
                	<div class="downintr_title"><span>下载地址</span></div>
                	<div class="downintr_content">
                		
                    	<?php BZ::server("id/".$archive);?>
                    	
                    	
                    </div>             
                </div>
                <div class="downintr"><!--下载说明-->
                	<div class="downintr_title"><span>下载说明</span></div>
                	<div class="downintr_explain">
                    <?php echo $content->show_attribute('downloads_describe');?>
                    </div>             
                </div>
                 <!--分享-->
          <div class="fxbox">
          	<div class="fxt">分享到：</div>
        <!-- Baidu Button BEGIN -->
       				 <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
        					<a class="bds_qzone"></a>
        					<a class="bds_tsina"></a>
        					<a class="bds_tqq"></a>
        					<a class="bds_renren"></a>
        					<span class="bds_more"></span>
									<a class="shareCount"></a>
    					</div>  
							<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=783195" ></script>
							<script type="text/javascript" id="bdshell_js"></script>
							<script type="text/javascript">
									document.getElementById("bdshell_js").src = "http://share.baidu.com/static/js/shell_v2.js?cdnversion=" + new Date().getHours();
							</script>

					<!-- Baidu Button END -->
          </div><!--分享结束-->
          
          
         <?php if($content['is_relation']=="1"){ ?> 
         <!--分页-->
          <div class="next">
          	    <?php BZ::relation("pattern/".$pattern."/id/".$archive."/show/v"); ?>
          		 
          </div>
        <?php } ?>
          
          <?php if($content['is_comment']=='1'){ ?>
          <div class="reviewmian"><!-- 评论 回复-->
          	 
          	
          	  <!--<?php BZ::comment("model/1/archive/".$archive."/type/textarea/level/1");?>-->
          		<div class="revtitle">发表评论</div>
          		<div class="comment"><!--发表评论-->
              </div>
                <div class="rev_bntbox"><!--按钮-->
                	<input type="button" class="rev_b1" value="发表"/>
                </div>
                <div class="reply"><!--回复-->
               	  <div class="replytitle"><span>评论</span></div>
                    <div class="replybox"><!--回复内容-->
                   	  <div class="reply_left"><!--左边-->
                         <div class="reply_name"><img src="images/nopic2.gif" />原创至上</div>
                      </div>
                         <div class="reply_right"><!--右边-->
                            <div class="reply_top">
                            	<a href="#">查看回复</a>|<a href="#" class="rely_a">回复</a>
                               <div class="reply_list"><!--回复评论列表-->
                                	<div class="re_input"><!--输入框-->
                                  	<textarea name="input" class="re_in"></textarea>
                                 	  <div class="re_bntbox"><!--按钮-->
                                    		<input type="button" class="memberbnt2" value="回复"/>
                                    		<input type="button" class="memberbnt3" value="取消"/>
                                		</div><!--end 按钮-->                                 
                    							</div><!--end 输入框-->
                   								<div style="clear:both;"></div>
                 						 </div>
                            </div>
                            <div class="reply_date">02-26 22:47</div>
                            <div class="reply_text">2漫网站阅读《侍灵演武》完全免费！我呼呼而是合肥如风和日韩国二二复合管vh环境佛我的客人风格鄂温克法规及哦叫我品味日v</div> 
                            <div class="replybox"><!--回复内容-->
                   	  <div class="reply_left"><!--左边-->
                         <div class="reply_name"><img src="images/nopic2.gif" />原创至上</div>
                      </div>
                         <div class="reply_right"><!--右边-->
                            <div class="reply_top"><a href="#">查看回复</a>|<a href="#" class="rely_a">回复</a></div>
                            <div class="reply_date">02-26 22:47</div>
                           <div class="reply_text">2漫网站阅读《侍灵演武》完全免费！我呼呼而是合肥如风和日韩国二二复合管vh环境佛我的客人风格鄂温克法规及哦叫我品味日v</div> 
                            </div>
                         <div style="clear:both;"></div>
                  </div>
                         </div>
                         <div style="clear:both;"></div>
                  </div><!--end 回复内容-->
          
                </div>
                <!--end 回复-->
          </div><!--end 评论 回复-->
        <?php } ?>
        
        
            </div>
        
        </div> 
    
    </div><!--end subleft-->
<div class="subright">
	 <div class="submenu">
    	<h2>软件分类</h2>
        <ul>
        	  <?php BZ::category("pattern/".$pattern."/channel/".$channel."/parent/30");?>
        </ul>
    </div><!--end submenu-->
       <div class="ibox">
        	    <div class="ibox_title"><h2>推荐软件</h2></div>
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



