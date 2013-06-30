<?php
 			$ip_convert=IpConvert::get();
		  $region_data=$ip_convert->init_region();
      $region_id=$region_data['id'];
      
      
?>
<div class="main_con">
	<?php 
								
		
    		 							$form=$this->beginWidget('EActiveForm', array(
	        								'id'=>'',
          								'action'=>$this->createUrl("group/list"),
          								'method'=>"GET",
	        								'enableAjaxValidation'=>false,
	        								'htmlOptions'=>array('id'=>"search_form"),
         							));

         							 echo EHtml::createHidden("action",$page_params['action'],array('id'=>'action'));
          						 echo EHtml::createHidden("channel",$page_params['channel'],array('id'=>'channel'));
          						 echo EHtml::createHidden("advanced_sort",$page_params['advanced_sort'],array('id'=>'advanced_sort'));
          						 echo EHtml::createHidden("advanced_sort_type",$page_params['advanced_sort_type'],array('id'=>'advanced_sort_type'));
          						 echo EHtml::createHidden("region_id",$page_params['region_id'],array('id'=>'region_id'));
          						 echo EHtml::createHidden("end_region_id",$page_params['end_region_id'],array('id'=>'end_region_id')); 
          						 echo EHtml::createHidden("category",$page_params['category'],array('id'=>'category'));

        					?>
<div class="tg_selectbox"><!--团购选择-->
	<?php
	                   foreach($advanced_search as $key => $value){
  												$name=$value['name'];
  												$items=$value['items'];
  											?>
  											<div class="tg_slt_unit tg_slt_line">
              						<span class="tg_slt_left"><?php echo $name;?>：</span>
              						<ul class="tg_slt_list">
              						<li><?php $item_class="no_select";if($page_params[$key]==''){$item_class="tg_slt_crt";} echo CHtml::link("全部","javascript:advance_search('".$key."','');",array('class'=>$item_class)); ?></li>
              						<?php foreach($items as $key1 => $value1){?>
              						       <li><?php $item_class="no_select";if($page_params[$key]==$key1){$item_class="tg_slt_crt";}echo CHtml::link($value1,"javascript:advance_search('".$key."','".$key1."');",array('class'=>$item_class));?></li>
  	    									<?php } ?>		
              						</ul>
              						<div class="clear_float"></div>
                         </div>
  										<?php } ?>

<div class="clear_float"></div>
</div><!--团购选择-->
<div class="tg_shoplistTop">
  <ul class="tg_shoplistTop_l">
    <?php foreach($advanced_sort as $key1 => $value1){
    	$advanced_sort_type=$page_params['advanced_sort_type'];
    	$item_class="no_select";
    	if($page_params['advanced_sort']==$key1){
    		$item_class="tg_order_crt";
    		if($advanced_sort_type=="DESC"){
    			$item_class.=" tg_order2";
    		}else{
    			$item_class.=" tg_order1";
    		}
    	}
    	if($advanced_sort_type=="DESC"){
    		$sort_type="ASC";
    	}else{
    		$sort_type="DESC";
    	}
    	echo "<li>".CHtml::link($value1,"javascript:advance_search_sort('".$key1."','".$sort_type."');",array('class'=>$item_class))."</li>";
     }
    ?>
  </ul>
</div><!--//tg_shoplistTop-->

<?php $this->endWidget(); ?> 


<div class="tg_shoplist">
  <ul>
  	
           	<?php   
    										$this->widget('zii.widgets.CListView',array(
													'dataProvider'=>$dataProvider,
													'itemView'=>"group_item",
													'ajaxUpdate'=>false,
													'viewData'=>array('cssPath'=>$cssPath),
												));
						?>

    
  </ul>
<div class="clear_float"></div>
</div><!--//tg_shoplist-->
</div><!--main_con end-->

<script language="javascript">
	
	jQuery(function(){
		jQuery(".diff_date").each(function(i){
			  set_diff_date(jQuery(this));
		});
		jQuery(".tg_shoplist_dtl").hover(function(){
			var tg_shoplist_txtlist=jQuery(this).find(".tg_shoplist_txtlist");
			var show_flag=tg_shoplist_txtlist.attr("show_flag");
			if(show_flag=="f"){
				var tg_shoplist_txtlist_height=tg_shoplist_txtlist.height()-35;
				tg_shoplist_txtlist.show().animate( { top: "-"+tg_shoplist_txtlist_height}, 1000,function(){tg_shoplist_txtlist.attr("show_flag","y");});
				
			}
		},
		function(){
			
		});
		
		jQuery(".tg_shoplist_txtlist").hover(function(){

		},function(){
			var show_flag=jQuery(this).attr("show_flag");
			if(show_flag=="y"){
					jQuery(this).animate( { top: "35px"}, 1000,function(){jQuery(this).attr("show_flag","f");jQuery(this).hide();});
					
			}
		});
		
		
	});
	
	function set_diff_date(ele){
		    var diff_date=ele.attr("end_time");
				var diff_dates=GetDateDiff(getTime(null),diff_date,"all");
				var diff_html=diff_dates[3]+"天"+diff_dates[2]+"时"+diff_dates[1]+"分"+diff_dates[0]+"秒";
				ele.html(diff_html);
				window.setTimeout(function(){set_diff_date(ele);},1000);
	}
	function advance_search(id,value){
        	jQuery("#"+id).val(value);
        	document.getElementById("search_form").submit();
   }
   
   function advance_search_sort(value,sort){
   	     jQuery("#advanced_sort").val(value);
   	     jQuery("#advanced_sort_type").val(sort);
        	document.getElementById("search_form").submit();
  }
</script>