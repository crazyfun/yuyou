<?php

      Yii::app()->clientScript->registerScriptFile('/js/jQuery.selectbox.js');	
      Yii::app()->clientScript->registerCssFile('/js/autocompleted/styles.css');
		  Yii::app()->clientScript->registerScriptFile("/js/autocompleted/jquery.autocomplete-min.js");
		  $is_group=Util::com_search_item(array(''=>'不限'),CV::$is_group);
		  
?>
<div class="htmain">
   <div class="ht_search"><!--搜索-->
      <div class="ht_stitle"><h2>线路搜索</h2></div>
      <div class="ht_sbox">
      	<?php 
								
								      $region=Region::model();
  										$start_region=$region->get_options_regions();
  										$start_region=Util::com_search_item(array(''=>'选择出发城市'),$start_region);
    		 							$form=$this->beginWidget('EActiveForm', array(
	        								'id'=>'',
          								'action'=>$this->createUrl("site/welcome"),
          								'method'=>"GET",
	        								'enableAjaxValidation'=>false,
	        								'htmlOptions'=>array('id'=>"search_form"),
         							));

         							 echo EHtml::createHidden("action",$action,array('id'=>'action'));
          						 echo EHtml::createHidden("channel_id",$page_params['channel_id'],array('id'=>'channel_id'));
          						 echo EHtml::createHidden("budget",$page_params['budget'],array('id'=>'budget'));
          						 echo EHtml::createHidden("advanced_sort",$page_params['advanced_sort'],array('id'=>'advanced_sort'));
        					?>
         <div class="ht_s2">
         	
         	
         <ul>                 
           <li><span class="search_li_span">关键字：</span><?php echo CHtml::textField("keywords",$page_params['keywords'],array());?></li>
           <li><span class="search_li_span">供应商：</span><?php echo EHtml::createText("company_name",$page_params['company_name'],array());?></li>
           <li><span class="search_li_span">景区：</span><?php echo EHtml::createText("travel_area",$page_params['travel_area'],array());?></li>
           <li><span class="search_li_span">出发时间：</span><?php echo EHtml::createDate("start_date",$page_params['start_date'],array());?></li>
           <li>
           	
           	
           	<span class="search_li_span">出发地：</span>
           	 	<input type="hidden" name="region_id" value="<?php echo $page_params['region_id'];?>" id="region_id_condition"/>
        	  <input type="hidden" name="region_id_type" value="<?php echo $page_params['region_id_type'];?>" id="region_id_type"/>
        	  <input name="region_id_text" value="<?php echo $page_params['region_id_text'];?>" type="text" id="region_id_text"/>
           	 
        	  
           	</li>
           <li><span class="search_li_span">目的地：</span>
             <input type="hidden" name="search_condition" value="<?php echo $page_params['search_condition'];?>" id="search_condition"/>
        	   <input type="hidden" name="search_type" value="<?php echo $page_params['search_type'];?>" id="search_type"/>
        	   <input name="search_text" value="<?php echo $page_params['search_text'];?>" type="text" id="sear_dest" class="sear_dest"/>
        	  </li>
           <li><span class="search_li_span">线路特色：</span>
           		<input type="hidden" name="line_type" value="<?php echo $page_params['line_type'];?>" id="line_type_condition"/>
        	    <input type="hidden" name="line_type_type" value="travelcategory" id="line_type_type"/>
           	 	<input name="line_type_text" value="<?php echo $page_params['line_type_text'];?>" type="text" id="line_type_text"/>
           	
           </li>
         </ul>
         <?php echo CHtml::submitButton("",array("class"=>'bnt_sea'));?>
         <div style="clear:both;"></div>
      </div>
      <div style="clear:both;"></div>
      <h2 class="ht_stitle2">搜索范围</h2>
      <div class="ht_s3">
      	
      		<ul>  
    								 <?php foreach($advanced_search as $key => $value){
  												$name=$value['name'];
  												$items=$value['items'];
  											?>
  											<li>
  												<span><?php echo $name;?>：</span>
              						
              						<?php $item_class="no_select";if($page_params[$key]==''){$item_class="htona";} echo CHtml::link("不限","javascript:advance_search('".$key."','');",array('class'=>$item_class)); ?>
              						<?php foreach($items as $key1 => $value1){?>
              						        <?php $item_class="no_select";if($page_params[$key]==$key1){$item_class="htona";}echo CHtml::link($value1,"javascript:advance_search('".$key."','".$key1."');",array('class'=>$item_class));?>
  	    									<?php } ?>		
              						
           						  </li>
  										<?php } ?>
        </ul>
         <div style="clear:both;"></div>
      </div>
      
      <?php $this->endWidget(); ?> 
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
               <td class="td3">出发时间</td>
               <td class="td4">供应商</td>
               <td class="td5">线路特色</td>
               <td class="td6">是否成团</td>
               <td class="td7">价格参考</td>
               <td class="td8">操作</td>
            </tr>
         </thead><!--//标题-->
         <tbody>
         	
         	          <?php   
    										$this->widget('zii.widgets.CListView',array(
													'dataProvider'=>$dataProvider,
													'itemView'=>"travel_item",
													'ajaxUpdate'=>false,
													'viewData'=>array('cssPath'=>$cssPath),
													'enablePagination'=>false,
												));
											?>
			
                       	

         </tbody>
      </table>
      <div class="ht_porList_pages">
      <?php $pages=$dataProvider->getPagination();
                	    			$this->widget('CLinkPager', array(
    													'pages' => $pages,
    													
														));
                       		?>	
      	
      </div>
   </div><!--//ht_porList-->
   <script language="javascript">
   	jQuery("#sear_dest").selectBox({
	 	  'type':"search_type",
	 	  'hidden':"search_condition",
	 	  'title':"可直接选择城市或输入城市",
	 	  'tabs':[{'name':"城市",'url':"/api/region",'id':'','type':'region'}],
	 	  'multi':false,
	 	  'level':3
	 	
	 	});

	 	
	 	jQuery("#region_id_text").selectBox({
	 	  'type':"region_id_type",
	 	  'hidden':"region_id_condition",
	 	  'title':"可直接选择城市或输入城市",
	 	  'tabs':[{'name':"城市",'url':"/api/region",'id':'','type':'region'}],
	 	  'multi':false,
	 	  'level':3
	 	});
	 	
	 	
	 	jQuery("#line_type_text").selectBox({
	 	  'type':"line_type_type",
	 	  'hidden':"line_type_condition",
	 	  'title':"可选择线路特色",
	 	  'tabs':[{'name':"线路类别",'url':"/api/linetype",'id':'','type':'travelcategory'}],
	 	  'multi':false,
	 	  'level':2
	 	});
	 	
	 	jQuery(function(){
	 	  jQuery("#search_advanced_sort").bind("change",function(){
	 	  	 var select_value=jQuery(this).val();
	 	  	 advance_search("advanced_sort",select_value);
	 	  });
	 	  jQuery(".search_sclist:even").addClass("ht_even");
	 	  jQuery(".search_sclist").hover(function(){jQuery(this).addClass("ht_hover");},function(){jQuery(this).removeClass("ht_hover");});
	 	  jQuery(".admin_play_select").each(function(i){
      var travel_date_select=jQuery(this).find("option:selected");
	 	  var seats=travel_date_select.attr("seats");
	 	  var group=travel_date_select.attr("group");
	 	  var buy_numbers=travel_date_select.attr("buy_numbers");
	 	  var travel_id=travel_date_select.attr("travel_id");
	 	  var price=travel_date_select.attr("price");
	 	  var fa_price=travel_date_select.attr("fa_price");
	 	  var child_price=travel_date_select.attr("child_price");
	 	  var fc_price=travel_date_select.attr("fc_price");
	 	  var travel_number_obj=jQuery("#travel_number_"+travel_id);
	 	  var travel_price_obj=jQuery("#travel_price_"+travel_id);
	 	  var travel_number_html="<p>已预订数："+(buy_numbers||0)+"人</p><p>计划人数："+seats+"人</p><p>成团人数："+group+"人</p><P>";
	 	  if(buy_numbers>=group){
	 	  	travel_number_html+="<img src='/themes/station/css/images/ht_icon.jpg' />";
	 	  }else{
	 	  	travel_number_html+="<img src='/themes/station/css/images/ht_icon2.jpg' />";
	 	  	
	 	  }
      travel_number_html+="</P>";
      
	 	  travel_number_obj.html(travel_number_html);
	 	  
	 	  var travel_price_html="<p>成人价："+price+" 元</p><p>成人结算价：<s class='td_red'>"+fa_price+"</s>元</p><P>儿童价："+child_price+" 元</P><P>儿童结算价:<s class='td_red'>"+fc_price+"</s>元</P>";
	 	  travel_price_obj.html(travel_price_html);
      }); 
	 	  
	 	  jQuery(".admin_play_select").bind("change",function(){
	 	  	var travel_date_select=jQuery(this).find("option:selected");
	 	  var seats=travel_date_select.attr("seats");
	 	  var group=travel_date_select.attr("group");
	 	  var travel_id=travel_date_select.attr("travel_id");
	 	   var buy_numbers=travel_date_select.attr("buy_numbers");
	 	  var price=travel_date_select.attr("price");
	 	  var fa_price=travel_date_select.attr("fa_price");
	 	  var child_price=travel_date_select.attr("child_price");
	 	  var fc_price=travel_date_select.attr("fc_price");
	 	  var travel_number_obj=jQuery("#travel_number_"+travel_id);
	 	  var travel_price_obj=jQuery("#travel_price_"+travel_id);
	 	  var travel_number_html="<p>已预订数："+(buy_numbers||0)+"人</p><p>计划人数："+seats+"人</p><p>成团人数："+group+"人</p><P>";
	 	  if(buy_numbers>=group){
	 	  	travel_number_html+="<img src='/themes/station/css/images/ht_icon.jpg' />";
	 	  }else{
	 	  	travel_number_html+="<img src='/themes/station/css/images/ht_icon2.jpg' />";
	 	  	
	 	  }
      travel_number_html+="</P>";
	 	  travel_number_obj.html(travel_number_html);
	 	  
	 	  var travel_price_html="<p>成人价："+price+" 元</p><p>成人结算价：<s class='td_red'>"+fa_price+"</s>元</p><P>儿童价："+child_price+" 元</P><P>儿童结算价:<s class='td_red'>"+fc_price+"</s>元</P>";
	 	  travel_price_obj.html(travel_price_html);
	 	  	
	 	  });
	 	  
              
              
	 	  
	 	  
	 });
	 function advance_search(id,value){
        	jQuery("#"+id).val(value);
        	document.getElementById("search_form").submit();
   }
   </script>