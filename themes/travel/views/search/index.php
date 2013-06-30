<?php
      Yii::app()->clientScript->registerScriptFile('/js/jQuery.selectbox.js');	
      Yii::app()->clientScript->registerCssFile('/js/autocompleted/styles.css');
		  Yii::app()->clientScript->registerScriptFile("/js/autocompleted/jquery.autocomplete-min.js");
  	  $ip_convert=IpConvert::get();
		  $region_data=$ip_convert->init_region();
      $region_id=$region_data['id'];
      $block_region_id=empty($page_params['region_id'])?$region_id:$page_params['region_id'];
 ?>
<div class="main_con">
<div class="s_topbpx">
								<?php 
								      $region=Region::model();
  										$start_region=$region->get_options_regions();
  										$start_region=Util::com_search_item(array(''=>'选择出发城市'),$start_region);
    		 							$form=$this->beginWidget('EActiveForm', array(
	        								'id'=>'',
          								'action'=>$this->createUrl("search/index"),
          								'method'=>"GET",
	        								'enableAjaxValidation'=>false,
	        								'htmlOptions'=>array('id'=>"search_form"),
         							));

         							 echo EHtml::createHidden("action",$action,array('id'=>'action'));
          						 echo EHtml::createHidden("channel_id",$page_params['channel_id'],array('id'=>'channel_id'));
          						 echo EHtml::createHidden("budget",$page_params['budget'],array('id'=>'budget'));
          						 echo EHtml::createHidden("day_linetype",$page_params['day_linetype'],array('id'=>'day_linetype'));
          						 echo EHtml::createHidden("type_linetype",$page_params['type_linetype'],array('id'=>'type_linetype'));
          						 echo EHtml::createHidden("theme_linetype",$page_params['theme_linetype'],array('id'=>'theme_linetype'));
          						 echo EHtml::createHidden("teshe_linetype",$page_params['teshe_linetype'],array('id'=>'teshe_linetype'));
          						 echo EHtml::createHidden("advanced_sort",$page_params['advanced_sort'],array('id'=>'advanced_sort'));
        					?>
    	<span>出发地：
    		 <?php echo CHtml::dropDownList("region_id",$page_params['region_id'],$start_region,array('class'=>'sear_sel'));?>
    	</span>
        <span>目的地：
        	  <input type="hidden" name="search_condition" value="<?php echo $page_params['search_condition'];?>" id="search_condition"/>
        	  <input type="hidden" name="search_type" value="<?php echo $page_params['search_type'];?>" id="search_type"/>
        	  <input name="search_text" value="<?php echo $page_params['search_text'];?>" type="text" class="sear_dest" id="search_text"/>
        	</span>
        <span>关键字：<?php echo CHtml::textField("keywords",$page_params['keywords'],array('class'=>'sear_keyword'));?></span>
        <span><?php echo CHtml::submitButton("",array("class"=>'sear_bnt'));?></span>

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
  <div class="sea_results">
  	       				  <?php   
    										$this->widget('zii.widgets.CListView',array(
													'dataProvider'=>$dataProvider,
													'itemView'=>"travel_item",
													'ajaxUpdate'=>false,
													'viewData'=>array('cssPath'=>$cssPath),
												));
											?>
  </div> 
</div><!--//w750-->
<div class="R-r-right">
                <div class="hot_rec_con">
                	<div class="R_r_title">热卖推荐</a></div>
                    <div class="hot_rec">
                        <ul>
                        	 
                        	 <?php BZ::blocks("pattern/travel/view/travel_remai/region_id/".$block_region_id."/sort/update_time/sort_type/DESC/limit/10/attr/c,f/tlen/24/size/60*40/cacheid/search_tuijian_".$block_region_id);?>
                        	
                           
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
<div class="clear_float"></div>
</div><!--main_con end-->
<script language="javascript">
	 jQuery(".sear_dest").selectBox({
	 	  'type':"search_type",
	 	  'hidden':"search_condition",
	 	  'title':"可直接选择城市/景点或输入城市",
	 	  'tabs':[{'name':"城市",'url':"/api/searchregion",'id':'','type':'region'},{'name':'景区','url':"/api/searchscenic",'id':'','type':'scenic'}],
	 	  'serviceUrl':"/api/regionandscenic",
	 	  'multi':false,
	 	  'level':1
	 	
	 	});
	 jQuery(function(){
	 	 
	 	  jQuery("#search_advanced_sort").bind("change",function(){
	 	  	 var select_value=jQuery(this).val();
	 	  	 
	 	  	 advance_search("advanced_sort",select_value);

	 	  });
	 	  
	 	  
	 	  jQuery("#search_text").bind("blur",function(){
	 	  var type_value=jQuery("#search_condition").val();
	 	  if(!type_value){
	 	     jQuery(this).val("");
	 	     jQuery("#search_condition").val("");
	 	     jQuery("#search_type").val("");
	 	     
	 	  }

	 	});
	 	
	 	
	 	jQuery("#search_text").live("keyup",function(){
      var this_val=jQuery(this).val();
      if(!this_val){
    	   jQuery(this).val("");
	 	     jQuery("#search_condition").val("");
	 	     jQuery("#search_type").val("");
      }	
    });
    
    
	 	
	 	
	 	  jQuery(".search_sclist:even").addClass("bgcolor_red");
	 	  jQuery(".search_sclist").hover(function(){jQuery(this).addClass("search_sclist_hover");},function(){jQuery(this).removeClass("search_sclist_hover");});
	 });
	 function advance_search(id,value){
        	jQuery("#"+id).val(value);
        	document.getElementById("search_form").submit();
   }
        
        
        
</script>