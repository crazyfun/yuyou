<?php
  Yii::app()->clientScript->registerScriptFile($jsPath.'/hotelsjcarousel/jquery.jcarousel.min.js');
  Yii::app()->clientScript->registerCssFile($jsPath.'/hotelsjcarousel/skins/tango/skin.css');
  
?>
<div class="main_con">
<div class="h_basics"><!--酒店基本信息-->
       <div class="h_baspic"><!--酒店图片-->
          <div class="h_bp1"><img alt="<?php echo $content->title;?>" src="/<?php echo Util::rename_thumb_file("320","342","",$content->get_first_image($content->id));?>" width="320" height="342"/></div>
          <div class="h_bp2">
          	 <?php 
          	   $hotels_images=HotelsImages::model();
          	   $hotels_images_datas=$hotels_images->get_hotels_images($content->id,9);
          	   $hotels_images_count=$hotels_images->count("t.hotels_id=:hotels_id",array(':hotels_id'=>$content->id));
          	 ?>
             <ul>
             	<?php foreach($hotels_images_datas as $key => $value){ ?>
             	<li id="gallery"><img src="/<?php echo Util::rename_thumb_file("92","92","",$value->Images->src);?>" alt="<?php echo $value->Images->desc;?>" /></li>
            <?php } ?>
               
             </ul>
             <div class="ht_pmaor"><a href="#hotels_images_pointer">查看更多图片（<?php echo $hotels_images_count;?>张）</a></div>
          </div>
       </div><!--//酒店图片-->
       
       <div class="h_bastext"><!--酒店文字介绍-->
           <ul>
              <li><strong>开业时间：</strong><?php echo $content->open_time;?></li>
              <li><strong>酒店地址：</strong><?php echo $content->hotel_address;?></li>
              <li><strong>酒店电话：</strong><?php echo $content->hotel_telephone;?></li>
              <li><strong>酒店星级：</strong><?php echo $content->show_attribute("hotel_level");?></li>
              <li><strong>酒店品牌：</strong><?php echo $content->show_attribute("brand_id");?></li>
              <li><strong>周边景点：</strong>
              	<?php 
              	$hotels_area=HotelsArea::model();
              	$hotels_aera_datas=$hotels_area->findAll(array('condition'=>'hotels_id=:hotels_id','params'=>array(':hotels_id'=>$content->id),'order'=>'sort_order ASC'));
              	$hotels_area_str="";
              	foreach((array)$hotels_aera_datas as $key => $value){
              		if(empty($hotels_area_str)){
              			$hotels_area_str.=$value->area_name;
              		}else{
              			$hotels_area_str.="&nbsp;&nbsp;".$value->area_name;
              		}
              	}
              	echo $hotels_area_str;
              	?>
             
            </li> 

          </ul>
       </div><!--//酒店文字介绍-->
   </div><!--//h_basics-->
   
   
   <div class="hb_box"><!--房型预订-->
       <h3 class="h3_tit"><span>房型预订</span></h3>
       <div class="hb_row">
       	  <?php 
       	     $start_date=empty($start_data)?date("Y-m-d"):$start_date;
       	     $end_date=empty($end_date)?(date("Y-m-d",mktime(0, 0, 0, date("m"),date("d")+1, date("Y")))):$end_date;
       	     $format_start_date=strtotime($start_date);
       	     $min_end_date=date("Y-m-d",mktime(0, 0, 0, date("m",$format_start_date),date("d",$format_start_date)+1, date("Y",$format_start_date)));
       	     $max_end_date=date("Y-m-d",mktime(0, 0, 0, date("m",$format_start_date),date("d",$format_start_date)+27, date("Y",$format_start_date)));
       	  ?>
       	  <?php 
    		 							$form=$this->beginWidget('EActiveForm', array(
	        								'id'=>'submit_hotels_beds',
          								'action'=>$this->createUrl("hotelspay/step1"),
	        								'enableAjaxValidation'=>false,
	        								'htmlOptions'=>array(),
         							));
         							echo CHtml::hiddenField("hotels_price_id","",array("id"=>"submit_hotels_price_id"));
        	?>		
       	  <div class="hotel_search_time">
       	  	  <span>入住时间：<?php echo EHtml::createDate("start_date",$start_date,array('class'=>'start_date','doubleCalendar'=>true,'id'=>'hotels_start_date'));?></span>
              &nbsp;&nbsp;<span>退房时间：<?php echo EHtml::createDate("end_date",$end_date,array('class'=>'end_date','doubleCalendar'=>true,'minDate'=>$min_end_date,'maxDate'=>$max_end_date,'id'=>'hotels_end_date'));?></span>
              <span><?php echo CHtml::button("",array("class"=>'sear_bnt','id'=>'search_button'));?></span>
       	 </div>
       	 <?php $this->endWidget(); ?> 
          <div class="htl_room_table" id="hotels_beds">
          	
          	
          </div>
          
       </div>
   </div><!--//房型预订-->
   
   
   <div class="hb_box"><!--酒店介绍-->
       <h3 class="h3_tit"><span>酒店介绍</span></h3>
     <div class="hb_row">
        <div class="hb_dec">
           <?php echo $content->content;?>
        </div>
     </div>
   </div>
   
   <?php
          	   $all_hotels_images_datas=$hotels_images->get_hotels_images($content->id);
          	   $all_hotels_count=count($all_hotels_images_datas);
   
   ?>
   
   
   <div class="hb_box"><!--酒店介绍-->
       <h3 class="h3_tit"><span>交通信息</span></h3>
     <div class="hb_row">
        <div class="hb_dec">
           <div>
              <strong>交通信息：</strong>
              	<?php 
              	$hotels_tran=HotelsTran::model();
              	$hotels_tran_datas=$hotels_tran->findAll(array('condition'=>'hotels_id=:hotels_id','params'=>array(':hotels_id'=>$content->id),'order'=>'sort_order ASC'));
              	$hotels_tran_str="";
              	foreach((array)$hotels_tran_datas as $key => $value){
              		if(empty($hotels_tran_str)){
              			$hotels_tran_str.=$value->tran_name;
              		}else{
              			$hotels_tran_str.="&nbsp;&nbsp;".$value->tran_name;
              		}
              	}
              	echo $hotels_tran_str;
              	?>
              </div>

        </div>
     </div>
   </div>
   
   
   
   <div class="hb_box" id="hotels_images_pointer"><!--酒店图片-->
       <h3 class="h3_tit"><span>酒店图片</span></h3>
     <div class="hb_row">
        <div class="hb_infor_pic">
            <div class="hb_ipic1">
               <p><img width="795" height="138" src="/<?php echo Util::rename_thumb_file("795","138","",$all_hotels_images_datas[0]->Images->src);?>" id="hotels_big_image" /></p>
               <h2><span id="hotels_title"><?php echo $all_hotels_images_datas[0]->Images->desc;?></span><span><b id="hotels_current">1</b>/<?php echo $all_hotels_count;?>张</span></h2>
            </div>
            
            
            <div class="hb_ipiclist">
                <ul id="mycarousel" class="jcarousel-skin-tango">
                	<?php foreach((array)$all_hotels_images_datas as $key => $value){ ?>
                	  <li><img key="<?php echo $key+1;?>" class="hotels_images" big_src="/<?php echo Util::rename_thumb_file("795","138","",$value->Images->src);?>" width="196" height="105" src="/<?php echo Util::rename_thumb_file("196","105","",$value->Images->src);?>" alt="<?php echo $value->Images->desc;?>"/></li>
                <?php } ?>
                
                </ul>
            </div>
        </div>
     </div>
   </div><!--//酒店图片-->
</div><!--main_con end-->
<script language="javascript">
						var hotels_id="<?= $content->id;?>";
         	  jQuery(function(){  
         	  	   jQuery(".hotel_yd").live("click",function(){
         	  	   	
         	  	   	var hotels_price_id=jQuery(this).attr("hotels_price_id");
         	  	   	jQuery("#submit_hotels_price_id").val(hotels_price_id);
         	  	    document.getElementById("submit_hotels_beds").submit();
         	  	  });
         	  	   jQuery("#mycarousel").jcarousel({
            			'auto':4,
            			'wrap':'circular'
            		});
            		
            		jQuery(".hotels_images").bind("click",function(){
            			var big_src=jQuery(this).attr("big_src");
            			var alt=jQuery(this).attr("alt");
            			var key=jQuery(this).attr("key");
            			jQuery("#hotels_big_image").attr("src",big_src).fadeIn("slow");
            			jQuery("#hotels_title").html(alt);
            			jQuery("#hotels_current").html(key);
            			
            		});
            		var start_date=jQuery("#hotels_start_date").val();
            		var end_date=jQuery("#hotels_end_date").val();
            		get_hotels_beds(hotels_id,start_date,end_date);
            		jQuery("#search_button").bind("click",function(){
            			var start_date=jQuery("#hotels_start_date").val();
            			var end_date=jQuery("#hotels_end_date").val();
            			get_hotels_beds(hotels_id,start_date,end_date);
            		});	
         	  });
         	  
 function get_hotels_beds(hotels_id,start_date,end_date){
 	  var hotels_beds=jQuery("#hotels_beds");
 		jQuery.ajax({
	    async:true,
        type: "Get",
        cache:true,
        beforeSend:function(){hotels_beds.html("<div class='progress_img'><img src='/css/images/loading.gif' width='19' height='18'/></div>");},
        url: "/station.php/main/hotelsbeds",
        dataType:"html",
        data: "hotels_id="+hotels_id+"&start_date="+start_date+"&end_date="+end_date+"&rmd="+Date.parse(new Date()),
        success: function(msg){
          hotels_beds.html(msg);
        }
      });
 }       	  	  
</script>