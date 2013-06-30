							<?php
								$travel=Travel::model();
  							$region_datas=$travel->get_end_region($this->channel_id,'',-1,$this->attr);
  							$first_region=array_slice($region_datas,0,8);
  							$end_region=array_slice($region_datas,8);
							?>
							<div class="more_places">
                <ul class="f14 tab">
                	<?php foreach($first_region as $key => $value){
                		 if($key==0){
                	?>
                	     <li class="current"><a end_region="<?php echo $value['region_id'];?>" limit="<?php echo $this->limit;?>" sort="<?php echo $this->sort;?>" sort_type="<?php echo $this->sort_type;?>" channel_id="<?php echo $this->channel_id;?>" attr="<?php echo $this->attr;?>"  title="<?php echo $value['region_name'];?>" class="show_travel_region"><?php echo $value['region_name'];?></a></li>
                	     <script language="javascript">
                	     	  jQuery(function(){
                	     	  	var channel_id="<?= $this->channel_id ?>";
														var end_region="<?= $value['region_id'] ?>";
														var attr="<?= $this->attr ?>";
														var limit="<?= $this->limit ?>";
														var sort="<?= $this->sort ?>";
														var sort_type="<?= $this->sort_type ?>";
														var show="line_list_"+"<?= $this->channel_id ?>";
                	     	  	get_travel_datas(show,channel_id,end_region,attr,"",limit,sort,sort_type,"");
                	     	  });
                	     </script>
                	     	
                  <?php }else{ ?>
                  	   <li class=""><a end_region="<?php echo $value['region_id'];?>" limit="<?php echo $this->limit;?>" sort="<?php echo $this->sort;?>" sort_type="<?php echo $this->sort_type;?>" channel_id="<?php echo $this->channel_id;?>" attr="<?php echo $this->attr;?>"  title="<?php echo $value['region_name'];?>" class="show_travel_region"><?php echo $value['region_name'];?></a></li>
                  <?php
                        }
                       } 
                  ?> 
       				   </ul>
       				      
                        <div class="p_abs more_sort"><div class="more_sort_item">更多目的地<em class="h_arrow"></em></div>
                              <div class="p_abs destination_area">
                                <ul class="clearfix destination_data_list">
                                  <li>
                                       <?php foreach($end_region as $key => $value){?>
                                        <a end_region="<?php echo $value['region_id'];?>" limit="<?php echo $this->limit;?>" sort="<?php echo $this->sort;?>" sort_type="<?php echo $this->sort_type;?>" channel_id="<?php echo $this->channel_id;?>" attr="<?php echo $this->attr;?>"  title="<?php echo $value['region_name'];?>" class="show_travel_region"><?php echo $value['region_name'];?></a>
                                       <?php } ?>
                                  </li>
                                  
                                </ul>
                              </div>
        				</div>
        			
        				
                    </div><!--more_places end-->
                    
                     <div class="line_list" id="line_list_<?php echo $this->channel_id;?>">
                    	 
                    	 
                    	 
                    </div><!--line_list end-->
              