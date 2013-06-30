<?php

      Yii::app()->clientScript->registerScriptFile('/js/jQuery.selectbox.js');	
      Yii::app()->clientScript->registerCssFile('/js/autocompleted/styles.css');
		  Yii::app()->clientScript->registerScriptFile("/js/autocompleted/jquery.autocomplete-min.js");
		  $is_group=Util::com_search_item(array(''=>'不限'),CV::$is_group);
		  
?>
<div class="htmain">
   <div class="ht_search"><!--搜索-->
      <div class="ht_stitle"><h2>酒店搜索</h2></div>
      <div class="ht_sbox">
         <div class="ht_s2">
         	
         				<?php 
								 			$start_date=$page_params['start_date'];
								 			$end_date=$page_params['end_date'];
       	     		 			$format_start_date=strtotime($start_date);
       	        			$min_end_date=date("Y-m-d",mktime(0, 0, 0, date("m",$format_start_date),date("d",$format_start_date)+1, date("Y",$format_start_date)));
       	         			$max_end_date=date("Y-m-d",mktime(0, 0, 0, date("m",$format_start_date),date("d",$format_start_date)+27, date("Y",$format_start_date)));
    		 							$form=$this->beginWidget('EActiveForm', array(
	        								'id'=>'',
          								'action'=>$this->createUrl("site/hotels"),
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
        					
        					  
         <ul>                 
           <li><span>酒店名称：</span><?php echo EHtml::createText("title",$page_params['title'],array('style'=>'width:80px;'));?></li>
           <li><span>酒店位置：</span><?php echo EHtml::createText("hotel_address",$page_params['hotel_address'],array('style'=>'width:80px;'));?></li>
           <li><span>城市：</span><?php echo EHtml::createAjaxselect("hotel_region",$page_params['hotel_region'],array('title'=>'可直接选择城市或输入城市','type_value'=>'region','text_value'=>$page_params['hotel_region_text'],'tabs'=>"[{'name':'城市','url':'/api/region','id':'','type':'region'}]",'serviceUrl'=>"/api/mixregion",'multi'=>false,'level'=>3,'style'=>'width:80px;')) ?></li>
           <li><span>入住时间：</span><?php echo EHtml::createDate('start_date',$page_params['start_date'],array('doubleCalendar'=>true,'dateFmt'=>'yyyy-MM-dd','style'=>'width:80px;'));?></li>
           <li><span>退房时间：</span><?php echo EHtml::createDate('end_date',$page_params['end_date'],array('doubleCalendar'=>true,'minDate'=>$min_end_date,'maxDate'=>$max_end_date,'dateFmt'=>'yyyy-MM-dd','style'=>'width:80px;'));?></li>
         	 
         </ul>
         
         
         <input name="" type="submit" value="" class="bnt_sea"/>
         
         <?php $this->endWidget(); ?>
         
         <div style="clear:both;"></div>
      </div>
      <h2 class="ht_stitle2">搜索范围</h2>
      <div class="ht_s3">
         <ul>   
         	
         	 <?php foreach($advanced_search as $key => $value){
  												$name=$value['name'];
  												$items=$value['items'];
  											?>
  											<li>
              						<span><?php echo $name;?>：</span>
              						<?php $item_class="";if($page_params[$key]==''){$item_class="htona";} echo CHtml::link("不限","javascript:advance_search('".$key."','');",array('class'=>$item_class)); ?>
              						<?php foreach($items as $key1 => $value1){?>
              						        <?php $item_class="";if($page_params[$key]==$key1){$item_class="htona";}echo CHtml::link($value1,"javascript:advance_search('".$key."','".$key1."');",array('class'=>$item_class));?>
  	    									<?php } ?>		
           						  </li>
  				<?php } ?>

         </ul>
         <div style="clear:both;"></div>
      </div>
      </div>
   </div><!--//搜索-->
   <div class="ht_px"><!--排序-->
      排序：<?php echo CHtml::dropDownList("advanced_sort",$page_params['advanced_sort'],$advanced_sort,array('id'=>'search_advanced_sort'));?>
     
   </div><!--//排序-->
   <div class="ht_porList"><!--ht_porList-->
      <table cellpadding="0" cellspacing="0">
         <thead>                                                                     
            <tr>
               <td class="td1">编号</td>
               <td class="td2">产品名称 </td>
               <td class="td3">酒店设施</td>
               <td class="td4">星级</td>
               <td class="td5">价格</td>
               <td colspan="2" class="td7">操作</td>
            </tr>
         </thead><!--//标题-->
         <tbody>
         	
         	<?php   
    										$this->widget('zii.widgets.CListView',array(
													'dataProvider'=>$dataProvider,
													'itemView'=>"hotels_item",
													'ajaxUpdate'=>false,
												));
				?>
            
         </tbody>
      </table>
   </div><!--//ht_porList-->
</div>
<?php 
    		 							$form=$this->beginWidget('EActiveForm', array(
	        								'id'=>'submit_hotels_beds',
          								'action'=>$this->createUrl("hotelspay/step1"),
	        								'enableAjaxValidation'=>false,
	        								'htmlOptions'=>array("style"=>'display:none;'),
         							));
         							echo CHtml::hiddenField("start_date",$page_params['start_date'],array());
         							echo CHtml::hiddenField("end_date",$page_params['end_date'],array());
         							echo CHtml::hiddenField("hotels_price_id","",array("id"=>"submit_hotels_price_id"));
        	?>
        	
        	
        	 <?php $this->endWidget(); ?> 
<script language="javascript">
	 var start_date="<?= $page_params['start_date'];?>";
   var end_date="<?= $page_params['end_date'];?>";
	jQuery(function(){
		jQuery(".hotel_yd").live("click",function(){
         	  	   	var hotels_price_id=jQuery(this).attr("hotels_price_id");
         	  	   	jQuery("#submit_hotels_price_id").val(hotels_price_id);
         	  	    document.getElementById("submit_hotels_beds").submit();
         	  	  });
     jQuery(".htl_room_table").each(function(i){
				var hotels_id=jQuery(this).attr("hotels_id");
				get_hotels_beds(jQuery(this),hotels_id,start_date,end_date);
			});	
		 jQuery("#search_advanced_sort").bind("change",function(){
	 	  	 var select_value=jQuery(this).val();
	 	  	 
	 	  	 advance_search("advanced_sort",select_value);

	 	  });
	 	  
	 	  jQuery(".h_sear_li:even").addClass("bgcolor_red");
	 	  jQuery(".h_sear_li").hover(function(){jQuery(this).addClass("search_sclist_hover");},function(){jQuery(this).removeClass("search_sclist_hover");});
		
		
		
	});
	
	function get_hotels_beds(obj,hotels_id,start_date,end_date){
 		jQuery.ajax({
	    async:true,
        type: "Get",
        cache:true,
        beforeSend:function(){obj.html("<div class='progress_img'><img src='/css/images/loading.gif' width='19' height='18'/></div>");},
        url: "/station.php/main/hotelsbeds",
        dataType:"html",
        data: "hotels_id="+hotels_id+"&start_date="+start_date+"&end_date="+end_date+"&rmd="+Date.parse(new Date()),
        success: function(msg){
          obj.html(msg);
        }
      });
    }
	 function advance_search(id,value){
        	jQuery("#"+id).val(value);
        	document.getElementById("search_form").submit();
   }
	
</script>