<?php
      Yii::app()->clientScript->registerCssFile('/js/blogcalendar/calendar.css');
      Yii::app()->clientScript->registerScriptFile('/js/blogcalendar/calendar.js');	
 ?>
<?php
$travel_images=TravelImages::model();
$travel_route=TravelRoute::model();

Yii::app()->clientScript->registerScriptFile($jsPath."/jcarousel/jquery.jcarousel.min.js");
Yii::app()->clientScript->registerCssFile($jsPath."/jcarousel/skins/tango/skin.css");
Yii::app()->clientScript->registerCssFile('/js/lightbox/css/jquery.lightbox-0.5.css');
Yii::app()->clientScript->registerScriptFile('/js/lightbox/jquery.lightbox.js');
$travel_images_datas=$travel_images->get_travel_images($content->id);
$travel_route_datas=$travel_route->get_route_datas($content->id);
?>
<div class="main_con">
	
<div class="show_main">
<div class="show_left">
<div class="show_top"><div style="float:left;">本产品由<?php echo $content->Company->company_name;?>提供相关资讯与服务</div>
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
  </div>  
<h1 class="show_ltitle"><?php echo $content->title;?><?php echo $content->show_attr_attribute();?></h1>
   <div class="showmain_left"><!--showmain_left 左边 产品图片-->

 
   <div id="preview">
   	

  
  <div id="wrap" style="top:0px;z-index:9999;position:relative;">
  	<?php
  	  $first_travel_image=$travel_images_datas[0];
  	  $image_src=$first_travel_image->Images->src;
      $big_src="/".Util::rename_thumb_file(325,280,"",$image_src); 
      $image_src="/".$image_src;
  	?>
  	<a id="big_travel_a">
  		<img width="325" height="280" id="big_travel_image" style="display: block;" src="<?php echo $big_src;?>" alt="">
  	</a>
 </div>





	<div id="spec-n5">
		
		<div id="spec-list"><!--小图-->
			
			
			   <ul id="mycarousel" class="list-h jcarousel-skin-tango">
        	<?php 
        	
        	foreach($travel_images_datas as $key => $value){ 
        		     $image_src=$value->Images->src;
        		     $image_name=$value->Images->name;
        		     $image_desc=$value->Images->desc;
        		     $small_src="/".Util::rename_thumb_file(50,50,"",$image_src);
        		     $big_src="/".Util::rename_thumb_file(325,280,"",$image_src); 
        		     $image_src="/".$image_src;
        	?>
        	  <li><img class="jcarousel_image" iname="<?php echo $image_name;?>" bsrc="<?php echo $big_src;?>" alt="<?php echo $image_desc;?>" src="<?php echo $small_src;?>" width="50" height="50"></li>
         <?php } ?>
         </ul> 
         <script language="javascript">
         	  jQuery(function(){  
         	  	  jQuery('#gallery a').lightBox();
            		//为ul设置jCarousel插件  
            		jQuery("#mycarousel").jcarousel({
            			'auto':5,
            			'wrap':'circular'
            		});  
            		
            		jQuery(".jcarousel_image").bind("click",function(){
            			var iname=jQuery(this).attr("iname");
            			var bsrc=jQuery(this).attr("bsrc");
            			jQuery("#big_travel_image").attr("alt",iname);
            			jQuery("#big_travel_image").attr("src",bsrc);
            			
            		});
        		});  
         </script>
         
			
			
			
		</div><!--小图-->
	
    </div>
</div>

<!-------------------// 图片展示代码===============--->  
</div>
<div class="showmain_right"><!--showmain_right 右边 产品信息-->
     <p>誉游价格：<span class="orange">￥<strong><?php echo $content->get_travel_price($content->id);?></strong></span>起</p>
     <p>出游天数：<span class="orange"><?php echo $content->route_number;?></span>天</p>
     <p>提前报名：<?php echo $content->application;?></p>
     <p>出发地：<?php echo $content->StartRegion->region_name;?></p>
     <p>途径：<?php echo $content->show_attribute("mid_region");?></p>
     <p>目的地：<?php echo $content->EndRegion->region_name;?></p>
     <p>往返交通：<?php echo $content->transportation;?></p>

     	   
          <!-- //顶踩 -->
          	<div class="dcbox">
            	  <?php BZ::vot("pattern/".$pattern."/view/travel/id/".$archive);?>
            </div>
          <!-- //顶踩 -->
     
     
        <div class="dlbox">
     	   <a href="javascript:favorite_travel('<?php echo $content->id;?>')" class="dtl_savebtn">收藏该产品</a>
        </div>
</div><!--//产品信息-->
<div class="clear_float"></div>
<div class="scroll_nav" id="scroll_nav">
  <ul>
    <li tab="tab1" class="scroll_nav_current"><a href="javascript:void(0)">行程说明</a></li>
    <li tab="tab2"><a href="javascript:void(0);">特色推荐</a></li>
    <li tab="tab3"><a href="javascript:void(0);">费用说明</a></li>
    <li tab="tab4"><a href="javascript:void(0);">重要提示</a></li>
    <li tab="tab5"><a href="javascript:void(0);">接待标准</a></li>
    <li tab="tab6"><a href="javascript:void(0);">预订通知</a></li>
    <li tab="tab7"><a href="javascript:void(0);">订购流程</a></li>
    <li tab="tab8"><a href="javascript:void(0);">在线评论</a></li>
  </ul>
</div><!--//标题-->
<div class="sbox">
   <h3 class="h3_tit" id="tab1"><span>行程说明</span></h3>
   <div class="row_sbox">
   	<?php 
   	$travel_route_number=count($travel_route_datas);
   	foreach($travel_route_datas as $key => $value){ 
   	    $area_images_datas=$travel_images->get_area_images($value->travel_route);	
   ?>
   	    <div class="day_tit"><strong><?php echo $value->show_attribute("route_day");?></strong><span><?php echo $value->show_attribute("travel_route");?></span></div>
        <div class="day_introduction">
        	<?php echo $value->route_describe;?>
        </div>
        <ul class="day_ul">
        	<?php if(!empty($value->route_dining)){ ?>
          <li><b>用餐</b>  <?php echo $value->route_dining;?></li>
         <?php } ?>
         <?php if(!empty($value->route_stay)){ ?>
          <li><b>住宿</b>  <?php echo $value->route_stay;?></li>
         <?php } ?>
         <?php if(!empty($value->route_flight)){ ?>
          <li><b>航班</b>  <?php echo $value->route_flight;?></li>
         <?php } ?>
        </ul>
        
        
        <div class="day_pic"><!--图片-->
          <ul>
          	<?php foreach($area_images_datas as $key1 => $value1){ 
          		   
          		   $image_src=$value1->Images->src;
      					 $thumb_src="/".Util::rename_thumb_file(160,130,"",$image_src); 
      					 $image_desc=$value1->Images->desc
          	?>
        	        <li><div class="scpic" id="gallery"><a title="<?php echo $image_desc;?>" href="/<?php echo $image_src;?>"><p><img  src="<?php echo $thumb_src;?>" alt="<?php echo $image_desc;?>"></p></a></div></li>

        	<?php } ?>
             
          </ul>
        </div>
        <div class="clear_float"></div>
        <?php if($key!=($travel_route_number-1)){ ?>
          <div class="day_line"></div>
        <?php } ?>
        
        
        
       
    <?php } ?>
   		 
        
        
        
  </div>
</div><!--//sbox-->

<div class="sbox">
   <h3 class="h3_tit" id="tab2"><span>特色推荐</span></h3>
   <div class="row_sbox">
   	 <div class="day_introduction">
       <?php echo $content->recommended;?>
     </div>
    </div>
</div><!--//sbox-->


<div class="sbox">
   <h3 class="h3_tit" id="tab3"><span>费用说明</span></h3>
   <div class="row_sbox">
   	<div class="day_introduction">
   		<?php echo $content->tour;?>
   	</div>
  </div>
</div><!--//sbox-->

<div class="sbox">
   <h3 class="h3_tit" id="tab4"><span>重要提示</span></h3>
   <div class="row_sbox">
   	<div class="day_introduction">
         <?php echo $content->tips;?>
    </div>
  </div>
</div><!--//sbox-->
<div class="sbox">
   <h3 class="h3_tit" id="tab5"><span>接待标准</span></h3>
   <div class="row_sbox">
   	<div class="day_introduction">
       <?php echo $content->receptionstandards;?>
    </div>
    
    </div>
</div><!--//sbox-->

<div class="sbox">
   <h3 class="h3_tit" id="tab6"><span>预订通知</span></h3>
   <div class="row_sbox">
   	<div class="day_introduction">
       <?php echo $content->notice;?>
    </div>
    </div>
</div><!--//sbox-->


<div class="sbox">
   <h3 class="h3_tit" id="tab7"><span>订购流程</span></h3>
   <div class="row_sbox">
     <div class="day_introduction font12">
        <p class="booking_process">网上/电话预订<span></span>资源确认<span></span>签约/付款<span></span>收到短信凭证<span></span>开心出游<span></span>归来回访</p>
        <dl>
           <dt><strong>签约方式</strong></dt>
           <dd>在线签约：在您确认合同范本以后，我们将盖章的电子档合同发送到您邮箱。</dd>
           <dd>传真签约：双方在合同上签字盖章后，通过传真进行签约。如涉及签证材料需要快递，请在快件中注明订单号。</dd>
           <dd>快递签约：<?php echo Yii::app()->name;?>提供免费快递签约、代收款服务。您确认合同并签字后完成签约。</dd>
           <dd>门市签约：您可以直接到您所预定的门市地点进行签约。</dd>
        </dl>  
     </div>
     <div class="day_line"></div>
     <div class="day_introduction font12">
     	<p><strong>在线支付</strong></p>
        <p><img src="<?php echo $cssPath;?>/images/zf_pic.jpg" /></p>
     </div>
     <div class="day_line"></div>
     <div class="day_introduction font12">
     	<p><strong>支付平台支付</strong></p>
        <p><img src="<?php echo $cssPath;?>/images/zf2_pic.jpg" /></p>
     </div>
     <div class="day_line"></div>
    

     
   </div>
</div><!--//sbox-->

<div class="sbox">
   <h3 class="h3_tit" id="tab8"><span>在线评论</span></h3>
   <div class="row_sbox">
       <?php BZ::comment("model/2/archive/".$archive."/type/textarea/user/1/level/2");?>
    </div>
</div><!--//sbox-->
<div class="main_rbox" style="margin-top:10px;"><!--相关产品推荐-->
        <h2 class="main_rbtitle"><span>相关产品推荐</span></h2>
      <div class="main_rb_tj show_tj">
            <ul>
            	<?php BZ::interrelated("pattern/travel/id/".$content->id."/view/travel/region_id/".$region_id."/sort/views/sort_type/DESC/limit/10/cacheid/interrelated_".$content->id."_".$region_id);?>
            	
            </ul>
      </div>
           <div class="clear_float"></div>
    </div>
</div><!--show_left-->

<div class="show_right">
 <div class="datebox" id="datebox">
   <div class="date_top_title"><span id="idCalendarYear"></span>出行日价格表</div>
   <div class="date_leftbox">
   	 <p class="da_bnt1"><a href="javascript:void(0);"  id="pre_date"><img src="<?php echo $cssPath;?>/images/pr_bnt1.jpg" /></a></p>
     <p><span id="idCalendarMonth"></span></p>
     <p class="da_bnt2"><a href="javascript:void(0);"  id="next_date"><img src="<?php echo $cssPath;?>/images/pr_bnt.jpg" /></a></p>
   </div>
   <div class="date_rightbox">
   <div class="da_tabright">
            	<table class="date_tab daleft" width="100%" border="0">
            		 <colgroup>
							 <col width="15%" />
							 <col width="14%" />
							 <col width="14%" />
							 <col width="14%" />
							 <col width="14%" />
							 <col width="14%" />
							 <col />
              </colgroup>
       <thead>
                     <tr class="date_top_tr">
                      <td>天</td><td>一</td><td>二</td><td>三</td><td>四</td><td>五</td><td>六</td>
                     </tr>
                </thead>
                <tbody id="idCalendar">
               
               </tbody>
               </table>
            </div>
   </div>
 <!--//出行时间价格表-->
 <div class="clear_float"></div>
<div class="play_date">		
        <dl>
        		<?php 
    		 							$form=$this->beginWidget('EActiveForm', array(
	        								'id'=>'',
          								'action'=>$this->createUrl("/pay/step1"),
	        								'enableAjaxValidation'=>false,
	        								'htmlOptions'=>array(),
         							));
         							echo CHtml::hiddenField("travel_id",$content->id,array());
        					?>
        	
          <dd >
          <p><span class="date_type">游玩日期&nbsp;</span>
          	<?php echo $content->get_date_select($content->id);?></p>
         <div class="play_price">
           <table>
             <tbody>
              <tr  style="">
                <td><span class="date_type">成人数</span></td>
                <td>
                  <span class="minus" onclick="javascript:add_sub(2,'input_adult');">-</span>
                  <input name="adult_nums" id="input_adult"  class="prod-num" type="text"  maxamt="100" minamt="1" value="1" size="2">
                  <span class="plus" onclick="javascript:add_sub(1,'input_adult');">+</span>                 </td>
                  	
                  	<td><span class="date_type">儿童数</span></td>
                <td>
                  <span class="minus" onclick="javascript:add_sub(2,'input_child');">-</span>
                  <input name="child_nums" id="input_child"  class="prod-num" type="text" maxamt="100" minamt="1"  value="1" size="2">
                  <span class="plus" onclick="javascript:add_sub(1,'input_child');">+</span>                 </td>
             </tr>
             </tbody>
             </table>
           </div>
           
           <p>
            	<span class="date_type">报名地点&nbsp;</span>
          	  <?php
          	   $travel_company=TravelCompany::model();
               $company=Company::model();
          	   $travel_company_select=$travel_company->get_company_select($content->id);
          
          	   $main_company_data=$company->findByPk($content->company_id);
           	   $travel_company_select=Util::com_search_item(array($main_company_data->id=>($main_company_data->company_name."(".$main_company_data->address.")")),$travel_company_select);
           	   
          	   echo EHtml::createSelect("company_id","",$travel_company_select,array('class'=>"play_select"));
          	   
          	   ?>
           </p>

           <span><input class="btn_submit" type="submit" value="立即约定" ></span>
           </dd>
           
           
       <div class="clear_float"></div>
       <?php $this->endWidget(); ?> 
       
    </dl>
    <p>您可先进行预订,客服将在工作时间为您提供咨询服务咨询/预订热线：1010-6060</p>
    </div></div>
    
    <script language="javascript">
	var id="<?= $content->id ?>";
	var cale = new Calendar("idCalendar", {
	//SelectDay: new Date().setDate(10),
	onSelectDay: function(o){ o.className = "onSelect"; },
	onToday: function(o){ o.className = "ondate"; },
	onFinish: function(){
		 document.getElementById("idCalendarYear").innerHTML = this.Year;
     document.getElementById("idCalendarMonth").innerHTML = this.Month;

	}
});

if(cale){
	get_date_detail_datas(id,cale.Year,cale.Month);
}
document.getElementById("pre_date").onclick = function(){ cale.PreMonth();get_date_detail_datas(id,cale.Year,cale.Month); }
document.getElementById("next_date").onclick = function(){ cale.NextMonth();get_date_detail_datas(id,cale.Year,cale.Month); }
jQuery(".hsdetail").live("click",function(){
	var date=jQuery(this).attr("date");
	jQuery("#travel_date_select").val(date);
	
});
</script>


</div><!--//show_right-->
<div class="clear_float"></div>
</div>

</div>

<script language="javascript">
	  var $scroll_nav_top = jQuery('#scroll_nav').offset();
	  var $datebox_top=jQuery("#datebox").offset();
	  var tab1=0,tab2=0,tab3=0,tab4=0,tab5=0,tab6=0,tab7=0,tab8=0;
	  var offset=50;
	  function scrollLocation () {
         tab1 = jQuery('#tab1').offset()?jQuery('#tab1').offset().top-offset:0;
         tab2 = jQuery('#tab2').offset()?jQuery('#tab2').offset().top-offset:0;
         tab3 = jQuery('#tab3').offset()?jQuery('#tab3').offset().top-offset:0;
         tab4 = jQuery('#tab4').offset()?jQuery('#tab4').offset().top-offset:0;
         tab5 = jQuery('#tab5').offset()?jQuery('#tab5').offset().top-offset:0;
         tab6 = jQuery('#tab6').offset()?jQuery('#tab6').offset().top-offset:0;
         tab7 = jQuery('#tab7').offset()?jQuery('#tab7').offset().top-offset:0;
         tab8 = jQuery('#tab8').offset()?jQuery('#tab8').offset().top-offset:0;
    }

    jQuery(window).on('load',function(){
    	    scrollLocation();
    	}).resize(function(){scrollLocation();}).scroll(function(){  //监听滚动条
        var $scrollTop = jQuery(this).scrollTop(),
        $scroll_nav = jQuery('#scroll_nav');
        $datebox=jQuery("#datebox");
				if ( ua.ie()<=6 ) {
					$scrollTop>=$scroll_nav_top.top?$scroll_nav.css({top:$scrollTop,position:"absolute","margin-top":0}):$scroll_nav.css({top:0,position:"relative","margin-top":0});//IE6定位
					$scrollTop>=$datebox_top.top?$datebox.css({top:$scrollTop,position:"absolute"}):$datebox.css({top:0,position:"relative"});//IE6定位
				}else{ 
         $scrollTop>=$scroll_nav_top.top?$scroll_nav.addClass('scroll_nav_scoll'):$scroll_nav.removeClass('scroll_nav_scoll');//浮动导航
         $scrollTop>=$datebox_top.top?$datebox.addClass('datebox_scoll'):$datebox.removeClass('datebox_scoll');//浮动导航
        }
           if(tab8>0&&$scrollTop >= tab8) {
                jQuery('.scroll_nav ul li').removeClass('scroll_nav_current');
                jQuery('.scroll_nav ul li[tab="tab8"]').addClass('scroll_nav_current');
            } else if(tab7>0&&$scrollTop >= tab7) {
                jQuery('.scroll_nav ul li').removeClass('scroll_nav_current');
                jQuery('.scroll_nav ul li[tab="tab7"]').addClass('scroll_nav_current');
            }else  if(tab6>0&&$scrollTop >= tab6) {
                jQuery('.scroll_nav ul li').removeClass('scroll_nav_current');
                jQuery('.scroll_nav ul li[tab="tab6"]').addClass('scroll_nav_current');
            }else  if(tab5>0&&$scrollTop >= tab5) {
                jQuery('.scroll_nav ul li').removeClass('scroll_nav_current');
                jQuery('.scroll_nav ul li[tab="tab5"]').addClass('scroll_nav_current');
            }else  if(tab4>0&&$scrollTop >= tab4) {
                jQuery('.scroll_nav ul li').removeClass('scroll_nav_current');
                jQuery('.scroll_nav ul li[tab="tab4"]').addClass('scroll_nav_current');
            }else  if(tab3>0&&$scrollTop >= tab3) {
                jQuery('.scroll_nav ul li').removeClass('scroll_nav_current');
                jQuery('.scroll_nav ul li[tab="tab3"]').addClass('scroll_nav_current');
            }else  if(tab2>0&&$scrollTop >= tab2) {
                jQuery('.scroll_nav ul li').removeClass('scroll_nav_current');
                jQuery('.scroll_nav ul li[tab="tab2"]').addClass('scroll_nav_current');
            }else  if(tab1>0&&$scrollTop >= tab1) {
                jQuery('.scroll_nav ul li').removeClass('scroll_nav_current');
                jQuery('.scroll_nav ul li[tab="tab1"]').addClass('scroll_nav_current');
            }
            
            
    });
    
    jQuery('.scroll_nav ul li').removeClass('scroll_nav_current').bind("click",function(event){
    	var tab_attr=jQuery(this).attr("tab");
    	var tab_obj=jQuery("#"+tab_attr);
    	jQuery('html, body').stop(true).animate({scrollTop:tab_obj.offset().top},1000,function(){});
    	event.stopPropagation(); 
    });
    
    function favorite_travel(travel_id){
    	var user_id="<?= Yii::app()->user->id ?>";
    	if(user_id){
    	jQuery.ajax({
	    async:true,
        type: "Get",
        cache:true,
        beforeSend:function(){},
        url: "/api/travelfavorite",
        dataType:"json",
        data: "travel_id="+travel_id+"&rmd="+Date.parse(new Date()),
        success: function(msg){
          if(msg.flag=='1'){
          	jQuery.jBox.tip(msg.message, '收藏提示');
          }
        }
      });
    }else{
    	pop_no_pay_login();
    }
    	
    }
    
	
	
</script>

