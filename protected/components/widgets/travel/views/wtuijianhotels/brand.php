							<?php
								$hotels_brand=HotelsBrand::model();
  							$region_datas=$hotels_brand->get_search_options_brands();
  							$first_region=array_slice($region_datas,0,7);
  							$end_region=array_slice($region_datas,7);
							?>		
			<div class="h_special"><!--特价酒店-->
              <h2 class="h_stitle">
              <span class="h_stpan">品牌酒店推荐</span>
              <div class="main_rbmenu">
                <ul>
                	
                	
                	<?php foreach($first_region as $key => $value){
                		 if($key==0){
                	?>
                	     <li class="current2"><a category="<?php echo $this->category;?>" brand_id="<?php echo $value['id'];?>" show="line_list_brand" view="brand"  class="show_travel_region" end_region="" limit="<?php echo $this->limit;?>" sort="<?php echo $this->sort;?>" sort_type="<?php echo $this->sort_type;?>"  attr="<?php echo $this->attr;?>"  title="<?php echo $value['name'];?>"><?php echo $value['name'];?></a></li>
                	     <script language="javascript">
                	     	  jQuery(function(){
														var end_region="";
														var attr="<?= $this->attr ?>";
														var limit="<?= $this->limit ?>";
														var sort="<?= $this->sort ?>";
														var sort_type="<?= $this->sort_type ?>";
														var show="line_list_brand";
														var view="brand";
														var brand_id="<?= $value['id'] ?>";
														var categroy="<?= $this->category ?>";
                	     	  	get_hotels_datas(show,categroy,end_region,attr,limit,sort,sort_type,view,brand_id);
                	     	  });
                	     </script>
                	     	
                  <?php }else{ ?>
                  	   <li class=""><a category="<?php echo $this->category;?>" brand_id="<?php echo $value['id'];?>" show="line_list_brand" view="brand" end_region="" limit="<?php echo $this->limit;?>" sort="<?php echo $this->sort;?>" sort_type="<?php echo $this->sort_type;?>" attr="<?php echo $this->attr;?>"  title="<?php echo $value['name'];?>" class="show_travel_region"><?php echo $value['name'];?></a></li>
                  <?php
                        }
                       } 
                  ?> 
			      </ul>
			      
			        
                        <div class="p_abs main_rbmore h_more_sort"><div class="h_more_sort_item">更多品牌<em class="h_arrow"></em></div>
                              <div class="p_abs h_destination_area">
                                <ul class="clearfix destination_data_list">
                                  <li>
                                       <?php foreach($end_region as $key => $value){?>
                                        <a category="<?php echo $this->category;?>" brand_id="<?php echo $value['id'];?>" show="line_list_brand" view="brand" end_region="" limit="<?php echo $this->limit;?>" sort="<?php echo $this->sort;?>" sort_type="<?php echo $this->sort_type;?>"  attr="<?php echo $this->attr;?>"  title="<?php echo $value['name'];?>" class="show_travel_region"><?php echo $value['name'];?></a>
                                       <?php } ?>
                                  </li>
                              
                                </ul>
                              </div>
        				</div>
        			

           </div><!--//main_rbmenu-->
         </h2><!--//h_stitle-->
           <div class="h_speclist" id="line_list_brand">

         </div>
       </div><!--//特价酒店-->
       
      
              