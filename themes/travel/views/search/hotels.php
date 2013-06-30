
<div class="main_con">
<div class="s_topbpx">
								<?php 
								 			$start_date=$page_params['start_date'];
								 			$end_date=$page_params['end_date'];
       	     		 			$format_start_date=strtotime($start_date);
       	        			$min_end_date=date("Y-m-d",mktime(0, 0, 0, date("m",$format_start_date),date("d",$format_start_date)+1, date("Y",$format_start_date)));
       	         			$max_end_date=date("Y-m-d",mktime(0, 0, 0, date("m",$format_start_date),date("d",$format_start_date)+27, date("Y",$format_start_date)));
    		 							$form=$this->beginWidget('EActiveForm', array(
	        								'id'=>'',
          								'action'=>$this->createUrl("search/index"),
          								'method'=>"GET",
	        								'enableAjaxValidation'=>false,
	        								'htmlOptions'=>array('id'=>"search_form"),
         							));

         							 echo EHtml::createHidden("action",$action,array('id'=>'action'));
          						 echo EHtml::createHidden("hotel_price_limit",$page_params['hotel_price_limit'],array('id'=>'hotel_price_limit'));
          						 echo EHtml::createHidden("hotel_level",$page_params['hotel_level'],array('id'=>'hotel_level'));
          						 echo EHtml::createHidden("brand_id",$page_params['brand_id'],array('id'=>'brand_id'));
          						 echo EHtml::createHidden("facility",$page_params['facility'],array('id'=>'facility'));
          						 echo EHtml::createHidden("advanced_sort",$page_params['advanced_sort'],array('id'=>'advanced_sort'));
        					?>
    	<span>城市：
    		 <?php echo EHtml::createAjaxselect("hotel_region",$page_params['hotel_region'],array('title'=>'可直接选择城市或输入城市','type_value'=>'region','text_value'=>$page_params['hotel_region_text'],'tabs'=>"[{'name':'城市','url':'/api/region','id':'','type':'region'}]",'serviceUrl'=>"/api/mixregion",'multi'=>false,'level'=>3,'style'=>'width:80px;')) ?>
    	</span>
        <span>酒店位置：<?php echo EHtml::createText("hotel_address",$page_params['hotel_address'],array('style'=>'width:80px;'));?></span>
        
        <span>入住：<?php echo EHtml::createDate('start_date',$page_params['start_date'],array('doubleCalendar'=>true,'dateFmt'=>'yyyy-MM-dd','style'=>'width:80px;'));?></span>
        <span>退房：<?php echo EHtml::createDate('end_date',$page_params['end_date'],array('doubleCalendar'=>true,'minDate'=>$min_end_date,'maxDate'=>$max_end_date,'dateFmt'=>'yyyy-MM-dd','style'=>'width:80px;'));?></span>
        <span>酒店名称：<?php echo EHtml::createText("title",$page_params['title'],array('style'=>'width:80px;'));?></span>
  <input name="" type="submit" class="h_searbnt" value="搜索"/>
  <?php $this->endWidget(); ?> 
  <!--//提示框-->
</div><!--//s_topbpx-->


<div class="s_options">
	<div class="s_op_title"><span>全部</span></div>
    <div class="s_op_box">
    	<dl>  
    								 <?php foreach($advanced_search as $key => $value){
  												$name=$value['name'];
  												$items=$value['items'];
  											?>
  											<dd>
              						<h4><?php echo $name;?>：</h4>
              						<p><?php $item_class="no_select";if($page_params[$key]==''){$item_class="op_not";} echo CHtml::link("不限","javascript:advance_search('".$key."','');",array('class'=>$item_class)); ?>
              						<?php foreach($items as $key1 => $value1){?>
              						        <?php $item_class="no_select";if($page_params[$key]==$key1){$item_class="op_not";}echo CHtml::link($value1,"javascript:advance_search('".$key."','".$key1."');",array('class'=>$item_class));?>
  	    									<?php } ?>		
              						</p><div class="clear_float"></div>
           						  </dd>
  										<?php } ?>
        </dl>
    </div>
</div><!--//s_options 搜索选项-->


<div class="w750">
  <div class="w750_top">排序：
  	<?php echo CHtml::dropDownList("advanced_sort",$page_params['advanced_sort'],$advanced_sort,array('id'=>'search_advanced_sort'));?>

	</div>
  <div class="h_searlist">

  	       				  <?php   
    										$this->widget('zii.widgets.CListView',array(
													'dataProvider'=>$dataProvider,
													'itemView'=>"hotels_item",
													'ajaxUpdate'=>false,
													'viewData'=>array('cssPath'=>$cssPath),
												));
											?>

  </div> 
</div><!--//w750-->
<div class="R-r-right">
                <div class="hot_rec_con">
                	<div class="R_r_title">热卖推荐</div>
                    <div class="hot_rec">
                        <ul>
                        	 
                        	 <?php BZ::blocks("pattern/hotels/view/hotels_remai/sort/update_time/sort_type/DESC/limit/10/attr/c/tlen/24/size/60*40/cacheid/search_tuijian_hotels");?>
                        	
                           
                        </ul>
					</div>
                </div><!--hot_rec end-->
                <div class="new_infor">
                	<div class="R_r_title">最新资讯<a title="更多最新资讯" href="/mchannels/information/channel/136.shtml">更多></a></div>
                    <ul>
                    	<?php BZ::blocks("pattern/archives/view/title_block/sort/update_time/sort_type/DESC/limit/10/tlen/24/cacheid/newest_information");?>
                    </ul>
                </div><!--new_infor end-->
                <!--
            	<div class="contact_us">
                	<div class="R_r_title">联系我们</div>
                	<div class="contact-con">
                    	<div class="con-tel"><img src="<?php echo $cssPath;?>/images//images/contact_tel.jpg" /></div>
                    	<div class="address_txt">武汉市雄楚大道188号花园公寓四层</div>
                	</div>
                </div>
                
                -->
  </div>
  
  				<?php 
    		 							$form=$this->beginWidget('EActiveForm', array(
	        								'id'=>'submit_hotels_beds',
          								'action'=>$this->createUrl("/hotelspay/step1"),
	        								'enableAjaxValidation'=>false,
	        								'htmlOptions'=>array("style"=>'display:none;'),
         							));
         							echo CHtml::hiddenField("start_date",$page_params['start_date'],array());
         							echo CHtml::hiddenField("end_date",$page_params['end_date'],array());
         							echo CHtml::hiddenField("hotels_price_id","",array("id"=>"submit_hotels_price_id"));
        	?>
        	
        	
        	 <?php $this->endWidget(); ?> 
<div class="clear_float"></div>
</div><!--main_con end-->
<script language="javascript">
   var start_date="<?= $page_params['start_date'];?>";
   var end_date="<?= $page_params['end_date'];?>";
	 jQuery(function(){
	 	 					jQuery(".hotel_yd").live("click",function(){
         	  	   	var hotels_price_id=jQuery(this).attr("hotels_price_id");
         	  	   	jQuery("#submit_hotels_price_id").val(hotels_price_id);
         	  	    document.getElementById("submit_hotels_beds").submit();
         	  	  });  
	 	  jQuery("#search_advanced_sort").bind("change",function(){
	 	  	 var select_value=jQuery(this).val();
	 	  	 
	 	  	 advance_search("advanced_sort",select_value);

	 	  });
			jQuery(".htl_room_table").each(function(i){
				var hotels_id=jQuery(this).attr("hotels_id");
				get_hotels_beds(jQuery(this),hotels_id,start_date,end_date);
			});		
	 	  jQuery(".h_sear_li:even").addClass("bgcolor_red");
	 	  jQuery(".h_sear_li").hover(function(){jQuery(this).addClass("search_sclist_hover");},function(){jQuery(this).removeClass("search_sclist_hover");});
	 });
	 function advance_search(id,value){
        	jQuery("#"+id).val(value);
        	document.getElementById("search_form").submit();
   }
        
    function get_hotels_beds(obj,hotels_id,start_date,end_date){
 		jQuery.ajax({
	    async:true,
        type: "Get",
        cache:true,
        beforeSend:function(){obj.html("<div class='progress_img'><img src='/css/images/loading.gif' width='19' height='18'/></div>");},
        url: "/hotels/beds",
        dataType:"html",
        data: "hotels_id="+hotels_id+"&start_date="+start_date+"&end_date="+end_date+"&rmd="+Date.parse(new Date()),
        success: function(msg){
          obj.html(msg);
        }
      });
 }     
        
</script>