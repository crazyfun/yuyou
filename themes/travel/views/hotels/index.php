 <?php
   $HOTELS_LEVEL=Util::com_search_item(array(''=>'不限'),CV::$HOTELS_LEVEL);
 ?>
 <div class="main_con">    
    <div class="hotel_left">
        <div class="sear_hotel"><!--搜索酒店-->
           <p><img src="<?php echo $cssPath;?>/images/sear_top.jpg" alt=""/></p>
           <div class="ser_hmain"> 
           	    <?php
           	    
           	    			$start_date=empty($start_data)?date("Y-m-d"):$start_date;
    									$end_date=empty($end_date)?(date("Y-m-d",mktime(0, 0, 0, date("m"),date("d")+1, date("Y")))):$end_date;
       	     		 			$format_start_date=strtotime($start_date);
       	        			$min_end_date=date("Y-m-d",mktime(0, 0, 0, date("m",$format_start_date),date("d",$format_start_date)+1, date("Y",$format_start_date)));
       	         			$max_end_date=date("Y-m-d",mktime(0, 0, 0, date("m",$format_start_date),date("d",$format_start_date)+27, date("Y",$format_start_date)));
       	         			
		  	 	   	 	    	$form=$this->beginWidget('EActiveForm', array(
	        								'id'=>'',
          								'action'=>$this->createUrl("search/index"),
	        								'enableAjaxValidation'=>false,
	        								'htmlOptions'=>array('enctype'=>'multipart/form-data'),
         								));
         								echo EHtml::createHidden("action","hotels",array());
         							?>
               <ul>
                  <li><span><b>*</b>入住城市：</span><?php echo EHtml::createAjaxselect("hotel_region",'',array('title'=>'可直接选择城市或输入城市','type_value'=>'region','tabs'=>"[{'name':'城市','url':'/api/region','id':'','type':'region'}]",'serviceUrl'=>"/api/mixregion",'multi'=>false,'level'=>3));?></li>
                  <li><span><b>*</b>入住日期：</span><?php echo EHtml::createDate('start_date',$start_date,array('doubleCalendar'=>true,'dateFmt'=>'yyyy-MM-dd'));?></li>
                  <li><span><b>*</b>退房日期：</span><?php echo EHtml::createDate('end_date',$end_date,array('doubleCalendar'=>true,'minDate'=>$min_end_date,'maxDate'=>$max_end_date,'dateFmt'=>'yyyy-MM-dd'));?></li>
                  <li><span>&nbsp;酒店级别：</span><?php echo EHtml::createSelect('hotel_level','',$HOTELS_LEVEL,array());?></li>
                  <li><span>&nbsp;酒店名称：</span><?php echo EHtml::createText('title','',array());?></li>
                  <li><span>&nbsp;酒店位置：</span><?php echo EHtml::createText('hotel_address','',array());?></li>
               </ul>
               <input name="input4" type="submit" class="sear_hbnt" value="&nbsp;"/>
             <?php $this->endWidget(); ?>
               
           </div>
           <p style="margin-top:-1px;"><img src="<?php echo $cssPath;?>/images/sear_bottom.gif" /></p>
        </div><!--//搜索酒店-->
        <div class="left_box1"><!--酒店目的地推荐-->
           <?php HZ::hotelssearch("view/index/attr/c");?>
           <p style="margin-top:-1px;"><img src="<?php echo $cssPath;?>/images/menu_bottom.jpg" /></p>
        </div><!--//酒店目的地推荐-->
        <div class="left_box1"><!--热点酒店-->
           <h2>热点酒店TOP10</h2>
           <div class="hotel_name">
           	<ul>
           		<?php BZ::blocks("pattern/hotels/view/hot_hotels_block/sort/buy_numbers/sort_type/DESC/limit/10/tlen/15/dott/false/cacheid/hot_hotels");?>
						</ul>
           </div>
           <p style="margin-top:-1px;"><img src="<?php echo $cssPath;?>/images/menu_bottom.jpg" /></p>
        </div><!--//热点酒店-->
        <div class="left_box1"><!--促销优惠-->
           <h2>促销特惠</h2>
           <div class="h_yh">
           	  <?php BZ::ad("pattern/travel/id/10");?>
           </div>
           <p style="margin-top:-20px;"><img src="<?php echo $cssPath;?>/images/menu_bottom.jpg"/></p>
        </div><!--//促销优惠-->
        
        
        
    </div><!--main_left end-->
    
    <div class="hotel_right">
    	
    	 <?php BZ::flash("pattern/hotels/view/right_slide/cacheid/hotels_falsh");?>
    	 
     
      
       <?php HZ::tuijianhotels("attr/t/category/".$category."/view/index/limit/9/cacheid/hotels_tejia");?>

       
       
       <div style="clear:both;"></div>
       
       <?php HZ::tuijianhotels("attr/c/category/".$category."/view/tuijian/limit/10/cacheid/hotels_tuijian");?>
       
      <div style="clear:both;"></div>
      
      
       <?php HZ::tuijianhotels("attr/c/category/".$category."/view/brand/limit/10/cacheid/hotels_brand");?>
       
    </div><!--main_right end-->
    <div class="clear_float"></div>
</div>



<script language="javascript">

	jQuery(function(){
		show_more_region("h_more_sort","h_destination_area","h_more_sort_item");
		jQuery(".show_travel_region").bind("click",function(){
			var end_region=jQuery(this).attr("end_region");
			var attr=jQuery(this).attr("attr");
			var limit=jQuery(this).attr("limit");
			var sort=jQuery(this).attr("sort");
			var sort_type=jQuery(this).attr("sort_type");
			var show=jQuery(this).attr("show");
			var view=jQuery(this).attr("view");
			var brand_id=jQuery(this).attr("brand_id");
			var category=jQuery(this).attr("category");
			get_hotels_datas(show,category,end_region,attr,limit,sort,sort_type,view,brand_id);
			jQuery(this).parent().siblings().removeClass("current2");
			jQuery(this).parent().addClass("current2");
		});
	
	});
	
	
</script>