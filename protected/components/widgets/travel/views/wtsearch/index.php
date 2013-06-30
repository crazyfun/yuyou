<?php 
  $travel=Travel::model();
  $travel_area=TravelArea::model();
  $zhoubian_end_region=$travel->get_end_region("131",'',20);
  $guonei_end_region=$travel->get_end_region("132",'',20);
  $chujing_end_region=$travel->get_end_region("133",'',20);
  $tuandui_end_region=$travel->get_end_region("134",'',20);
  $travel_category=TravelCategory::model();
  $rejing_datas=$travel_area->get_hot_travel_areas();
  $xingcheng_datas=$travel_category->get_category_datas(5);
  $chuyou_datas=$travel_category->get_category_datas(16);
  $zhuti_datas=$travel_category->get_category_datas(24);
  $teshe_datas=$travel_category->get_category_datas(32);
  $config_values=ConfigValues::model();
  $jiage_values=$config_values->get_ralation_values(11);
?>

<div class="sort_left"></div>
        	<h2 class="left_part_title">旅游分类</h2>
            <div class="newSubMenu" id="newSubMenu">
                <div class="newMenuBlock">
                    
                    <h3 class="firstTitle fst" index="1"><div class="submenu_item"><img src="/themes/travel/css/images/left_icon1.png" /><i class="i1"></i><sup></sup>旅游目的地</div>
                    	
                    	<div style="display: none;" class="newSubMenuCon MDD" id="newSubMenuCon_1" >
                        <div class="newPel">
                            <dl>
                                <dt><a href="<?php echo $this->controller->createUrl("search/index",array("action"=>"travel","channel_id"=>"131"));?>" title="周边游">周边游</a></dt>
                                <dd>
                                <?php foreach($zhoubian_end_region as $key => $value){ ?>
                                 <a title="<?php echo $value->region_name;?>" href="<?php echo $this->controller->createUrl("search/index",array("action"=>"travel",'channel_id'=>'131',"search_type"=>"region","search_condition"=>$value->region_id,'search_text'=>$value->region_name));?>"><?php echo $value->region_name;?></a>
                               <?php } ?>
                                 <a class="all" href="<?php echo $this->controller->createUrl("search/index",array("action"=>"travel","channel_id"=>"131"));?>" title="周边游">更多</a>
                              </dd>
                            </dl>
                            <dl>
                                <dt><a href="<?php echo $this->controller->createUrl("search/index",array("action"=>"travel","channel_id"=>"132"));?>" title="国内游">国内游</a></dt>
                                <dd>
                                	<?php foreach($guonei_end_region as $key => $value){ ?>
                                     <a title="<?php echo $value->region_name;?>" href="<?php echo $this->controller->createUrl("search/index",array("action"=>"travel",'channel_id'=>'132',"search_type"=>"region","search_condition"=>$value->region_id,'search_text'=>$value->region_name));?>"><?php echo $value->region_name;?></a>
                                 <?php } ?>
                                 <a class="all" href="<?php echo $this->controller->createUrl("search/index",array("action"=>"travel","channel_id"=>"132"));?>" title="国内游">更多</a>	
                                </dd>
                            </dl>
                            <dl>
                                <dt><a href="<?php echo $this->controller->createUrl("search/index",array("action"=>"travel","channel_id"=>"133"));?>" title="出境游">出境游</a></dt>
                                <dd>
                                	<?php foreach($chujing_end_region as $key => $value){ ?>
                                   <a title="<?php echo $value->region_name;?>" href="<?php echo $this->controller->createUrl("search/index",array("action"=>"travel",'channel_id'=>'133',"search_type"=>"region","search_condition"=>$value->region_id,'search_text'=>$value->region_name));?>"><?php echo $value->region_name;?></a>
                                 <?php } ?>
                                 <a class="all" href="<?php echo $this->controller->createUrl("search/index",array("action"=>"travel","channel_id"=>"133"));?>" title="出境游">更多</a>	
                                </dd>
                            </dl>
                            
                            <dl class="bd0">
                                <dt><a href="<?php echo $this->controller->createUrl("search/index",array("action"=>"travel","channel_id"=>"134"));?>" title="团队游">团队旅游</a></dt>
                                <dd>
                                	<?php foreach($tuandui_end_region as $key => $value){ ?>
                                   <a title="<?php echo $value->region_name;?>" href="<?php echo $this->controller->createUrl("search/index",array("action"=>"travel",'channel_id'=>'134',"search_type"=>"region","search_condition"=>$value->region_id,'search_text'=>$value->region_name));?>"><?php echo $value->region_name;?></a>
                                 <?php } ?>
                                 <a class="all" href="<?php echo $this->controller->createUrl("search/index",array("action"=>"travel","channel_id"=>"134"));?>" title="团队游">更多</a>	
                                </dd>
                            </dl>
                        </div>
                       
                    </div>
                    </h3>
                    
                </div>
                
                <div class="newMenuBlock">
                    <h3 class="firstTitle" index="2"><div class="submenu_item"><img src="/themes/travel/css/images/left_icon2.png" /><i class="i2"></i><sup></sup>行程天数</div>
                    	
                    <div style="display: none;" class="newSubMenuCon MDD" id="newSubMenuCon_2">
                        <div class="newPel date">
                            <div class="txtt">
                            	<?php foreach($xingcheng_datas as $key => $value){ ?>
                            	
                            	  <a href="<?php echo $this->controller->createUrl("search/index",array("action"=>"travel","day_linetype"=>$value->category_id));?>" title="<?php echo $value->category_name;?>"><?php echo $value->category_name;?></a>
                            <?php } ?>
                            	
                            </div>
                        </div>
                        
                         
                        
                        
                    </div>	
                    </h3><!--hover的时候添加class currentLink-->
                    
                </div>
                
                <div class="newMenuBlock">
                    <h3 class="firstTitle" index="3"><div class="submenu_item"><img src="/themes/travel/css/images/left_icon3.png" /><i class="i3"></i><sup></sup>价格预算</div>
                     <div style="display: none;" class="newSubMenuCon MDD" id="newSubMenuCon_3">
                        <div class="newPel">
                            <div class="txtt">
                            	<?php foreach($jiage_values as $key => $value){ ?>
                            	     <a href="<?php echo $this->controller->createUrl("search/index",array("action"=>"travel","budget"=>$key));?>" title="<?php echo $value;?>"><?php echo $value;?></a>
                            	
                             <?php } ?>
                            	
                            </div>
                        </div>
                        
                        
                        
                        
                    </div>	
                    </h3>
                    
                </div>
                <div class="newMenuBlock">
                    <h3 class="firstTitle" index="4"><div class="submenu_item"><img src="/themes/travel/css/images/left_icon4.png" /><i class="i4"></i><sup></sup>出游方式</div>
                    	
                    	 <div style="display: none;" class="newSubMenuCon MDD" id="newSubMenuCon_4">
                        <div class="newPel">
                            <div class="txtt">
                            	  <?php foreach($chuyou_datas as $key => $value){ ?>
                            	    <a href="<?php echo $this->controller->createUrl("search/index",array("action"=>"travel","type_linetype"=>$value->category_id));?>" title="<?php echo $value->category_name;?>"><?php echo $value->category_name;?></a>
                            	  
                            	<?php } ?>
                            	
                            </div>
                        </div>
                        
                      
                        
                        
                    </div>
                    </h3>
                   
                </div>
                
                
                 <div class="newMenuBlock">
                    <h3 class="firstTitle" index="5"><div class="submenu_item"><img src="/themes/travel/css/images/left_icon5.png" /><i class="i5"></i><sup></sup>特色旅游</div>
                    	
                    	 <div style="display: none;" class="newSubMenuCon MDD" id="newSubMenuCon_5">
                        <div class="newPel">
                            <div class="txtt">
                            	  <?php foreach($teshe_datas as $key => $value){ ?>
                            	    <a href="<?php echo $this->controller->createUrl("search/index",array("action"=>"travel","type_linetype"=>$value->category_id));?>" title="<?php echo $value->category_name;?>"><?php echo $value->category_name;?></a>
                            	  
                            	<?php } ?>
                            	
                            </div>
                        </div>
                        
                        
                        
                        
                    </div>
                    </h3>
                   
                </div>
                
                
                
                <div class="newMenuBlock">
                    <h3 class="firstTitle lst" index="6"><div class="submenu_item"><img src="/themes/travel/css/images/left_icon6.png" /><i class="i6"></i><sup></sup>主题旅游</div>
                    	<div style="display: none;" class="newSubMenuCon MDD" id="newSubMenuCon_6">
                        <div class="newPel">
                            <div class="theme">
                            	<?php foreach($zhuti_datas as $key => $value){ ?>
                            	
                            	  <a href="<?php echo $this->controller->createUrl("search/index",array("action"=>"travel","theme_linetype"=>$value->category_id));?>" title="<?php echo $value->category_name;?>"><?php echo $value->category_name;?></a>
                            <?php } ?>
                            </div>
                        </div>
                        
                         
                        
                        
                    </div>
                    	
                    </h3>
                    
                </div>
            </div>
    <script language="javascript">
    jQuery(function(){
      jQuery(".firstTitle").hover(
    		function(){
    			 var index=jQuery(this).attr("index");
    			 jQuery(this).find(".submenu_item").addClass("submenu_item_hover");
	  		   jQuery(".newSubMenuCon").hide();
	  		   jQuery("#newSubMenuCon_"+index).show();
    		},
    		function(){
	  		   var index=jQuery(this).attr("index");
	  		   jQuery("#newSubMenuCon_"+index).hide();
	  		   jQuery(this).find(".submenu_item").removeClass("submenu_item_hover");
	  		}
    );
  });        	
     </script>