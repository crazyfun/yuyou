<table cellspacing="0" cellpadding="0" border="0"><tbody>
          		<tr>
          			<th style="padding-left:10px;" class="col1">房型</th>
          			<th class="col3 child_name">床型</th>
          			<th class="col4">早餐</th>
          			<th class="col5">宽带</th>
          			<th class="col3">市场价</th>
          			<th class="col6">誉游价</th>
          			<th class="col6">结算价</th>
          			<th class="col7"></th>
          		</tr>
          		<?php foreach($hotels_beds_datas as $key => $value){
          			$hotels_price_datas=$value->HotelsPrice;
          			$hotels_price_count=count($hotels_price_datas);
          			foreach($hotels_price_datas as $key1 => $value1){
          				$hotels_room_remain=$value1->get_room_remain($value1->id,$start_date,$end_date);
          			if($key1==0){
          		?>
          		<tr>
          			<td rowspan="<?php echo $hotels_price_count;?>" class="room_type">
          				<?php echo $value->show_attribute("name");?>
          			</td>

								<td class="child_name">
									<?php echo $value1->show_attribute("bed");?>
								</td>
								<td><?php echo $value1->show_attribute("breakfast");?></td>
								<td><?php echo $value1->show_attribute("line");?></td>
								<td class="child_o_price">
									<del><dfn>¥</dfn><?php echo $value1->show_attribute("o_price");?></del>
								</td>
								<td class="child_price">
									<dfn>¥</dfn><?php echo $value1->show_attribute("price");?>
								</td>
								<td class="child_price">
									<dfn>¥</dfn><?php echo $value1->show_attribute("settle_price");?>
								</td>
								<td>
									
									<div style="position:relative;">
								<?php if($hotels_room_remain){ ?>
			
										<a href="javascript:void(0);" hotels_price_id="<?php echo $value1->id;?>"  class="hotel_yd">&nbsp;</a>
								<?php }else{ 
									   $over_beds_datas=$value1->get_over_beds($value1->id,$start_date,$end_date);
								?>
										<input type="button" class="hotel_yd_gray" name="">
										<div class="tips_wrapper hotels_tips_over">
											<div class="tips_top">
										  </div>
										  <div class="tips_content">
										  	<table cellspacing="0" cellpadding="0" border="0">
										  		<?php 
										  			$over_numbers=count($over_beds_datas);
										  			$over_numbers_times=ceil($over_numbers/5);
										  			for($ii=0;$ii < $over_numbers_times;$ii++){
										  		?>
										  		<tr>
          		             <?php 
          		             $slice_offset=$ii*5;
          		             $slice_over_beds_datas=array_slice($over_beds_datas,$slice_offset,5);
          		             foreach($slice_over_beds_datas as $o_key => $o_value){ ?>
          									<th class="col3"><?php echo $o_key;?></th>
                           <?php } ?>
          								</tr>
										  		<tr>
          		             <?php foreach($slice_over_beds_datas as $o_key => $o_value){ ?>
          									<td class="col3"><?php echo $o_value;?></td>
                           <?php } ?>
          								</tr>
          							<?php } ?>
          								
										  	</table>
										  </div>
										</div>
								<?php } ?>
							</div>
								</td>
						</tr>
						
					<?php }else{
						
					?>
						<tr>
								<td class="child_name">
									<?php echo $value1->show_attribute("bed");?>
								</td>
								<td><?php echo $value1->show_attribute("breakfast");?></td>
								<td><?php echo $value1->show_attribute("line");?></td>
								<td class="child_o_price">
									<del><dfn>¥</dfn><?php echo $value1->show_attribute("o_price");?></del>
								</td>
								<td class="child_price">
									<dfn>¥</dfn><?php echo $value1->show_attribute("price");?>
								</td>
								<td class="child_price">
									<dfn>¥</dfn><?php echo $value1->show_attribute("settle_price");?>
								</td>
								<td>
									
									<div style="position:relative;">
								<?php if($hotels_room_remain){ ?>
										<a href="javascript:void(0);" hotels_price_id="<?php echo $value1->id;?>"  class="hotel_yd">&nbsp;</a>
								<?php }else{ 
									   $over_beds_datas=$value1->get_over_beds($value1->id,$start_date,$end_date);
								?>
										<input type="button" class="hotel_yd_gray" name="">
										<div class="tips_wrapper hotels_tips_over">
											<div class="tips_top">
										  </div>
										  <div class="tips_content">
										  	<?php 
										  			$over_numbers=count($over_beds_datas);
										  			$over_numbers_times=ceil($over_numbers/5);
										  			for($ii=0;$ii < $over_numbers_times;$ii++){
										  		?>
										  	<table cellspacing="0" cellpadding="0" border="0">
										  		<tr>
          		             <?php 
          		             $slice_offset=$ii*5;
          		             $slice_over_beds_datas=array_slice($over_beds_datas,$slice_offset,5);
          		             foreach($slice_over_beds_datas as $o_key => $o_value){ ?>
          									<th class="col3"><?php echo $o_key;?></th>
                           <?php } ?>
          								</tr>
										  		<tr>
          		             <?php foreach($slice_over_beds_datas as $o_key => $o_value){ ?>
          									<td class="col3"><?php echo $o_value;?></td>
                           <?php } ?>
          								</tr>
          							<?php } ?>
										  	</table>
										  </div>
										</div>
								<?php } ?>
							</div>
								</td>
						</tr>
						
				 <?php
						}		
					 }
				  } 
				 ?>
						</tbody>
						</table>
	
	
             <div style="clear:both;"></div>
             <script language="javascript">
             	jQuery(function(){
             		jQuery(".hotel_yd_gray").hover(function(){
            			jQuery(this).parent().find(".tips_wrapper").slideDown("fast");
            		},function(){
            			jQuery(this).parent().find(".tips_wrapper").slideUp("fast");
            		});
             	});
             </script>