<?php
$travel_images=TravelImages::model();
$travel_route=TravelRoute::model();
  $travel_route_datas=$travel_route->get_route_datas($model->id);
?>
<div class="print">
	 <table class="print_table">
	 	   <tr><td class="p_table_title">线路名称:</td><td colspan="5"><strong><?php echo $model->title;?></strong></td></tr>
	 	   <tr>
	 	   	<td class="p_table_title">出发地:</td><td class="p_table_content"><?php echo $model->StartRegion->region_name;?></td>
	 	   	<td class="p_table_title">途径:</td><td class="p_table_content"><?php echo $model->show_attribute("mid_region");?></td>
	 	   	<td class="p_table_title">目的地:</td><td class="p_table_content"><?php echo $model->EndRegion->region_name;?></td>
	 	    
	 	   </tr>
	 	   <tr>
	 	   	<td class="p_table_title">出游天数:</td><td class="p_table_content"><?php echo $model->route_number;?>天</td>
	 	   	<td class="p_table_title">成人价格:</td><td class="p_table_content"><?php echo $model->get_travel_price($model->id);?>起</td>
	 	   	<td class="p_table_title">儿童价格:</td><td class="p_table_content"><?php echo $model->get_child_price($model->id);?>起</td>
	 	   </tr>
	 	   <tr>
       <td class="p_table_title">提前报名:</td><td class="p_table_content"><?php echo $model->application;?></td>
       <td class="p_table_title">往返交通:</td><td class="p_table_content"><?php echo $model->transportation;?></td>
       	 <td class="p_table_title">&nbsp;</td><td class="p_table_content">
       	 	   &nbsp;
       	</td>
     </tr>
     <tr>
     	
       <td colspan="6" class="p_talbe_wrapper">线路行程:</td>	
     <tr>
     	<tr>
     	
       <td colspan="6">
       	 <div class="row_sbox">
   	<?php 
   	$travel_route_number=count($travel_route_datas);
   	foreach($travel_route_datas as $key => $value){ 
   	    $area_images_datas=$travel_images->get_area_images($value->travel_route);	
   ?>
   	    <div class="day_tit"><strong><?php echo $value->show_attribute("route_day");?></strong><span><?php echo $value->show_attribute("travel_route");?></span></div>
        <div class="day_introduction">
        	<?php echo $value->route_describe;?>
        </div>
        <ul class="day_ul">
        	<?php if(!empty($value->route_dining)){ ?>
          <li><b>用餐</b>  <?php echo $value->route_dining;?></li>
         <?php } ?>
         <?php if(!empty($value->route_stay)){ ?>
          <li><b>住宿</b>  <?php echo $value->route_stay;?></li>
         <?php } ?>
         <?php if(!empty($value->route_flight)){ ?>
          <li><b>航班</b>  <?php echo $value->route_flight;?></li>
         <?php } ?>
        </ul>


    <?php } ?>
   		     
  </div>
       	
       	
       	
       	</td>	
     </tr>
     	
     <tr><td colspan="6" class="p_talbe_wrapper">特色推荐:</td>	</tr>
     <tr><td colspan="6">
     	 <div class="row_sbox">
     	  <?php echo $model->recommended;?>
     	 </div>
     </td></tr>
     
     
     <tr><td colspan="6" class="p_talbe_wrapper">费用说明:</td>	</tr>
     <tr><td colspan="6">
     	 <div class="row_sbox">
     	  <?php echo $model->tour;?>
     	</div>
     </td></tr>
     
     
     <tr><td colspan="6" class="p_talbe_wrapper">重要提示:</td>	</tr>
     <tr><td colspan="6">
     	 <div class="row_sbox">
     	   <?php echo $model->tips;?>
     	 </div>
     </td></tr>
     
     
     <tr><td colspan="6" class="p_talbe_wrapper">接待标准:</td>	</tr>
     <tr><td colspan="6">
     	 <div class="row_sbox">
     	  <?php echo $model->receptionstandards;?>
     	 </div>
     </td></tr>
     
     
     <tr><td colspan="6" class="p_talbe_wrapper">预订通知:</td>	</tr>
     <tr><td colspan="6">
     	 <div class="row_sbox">
     	  <?php echo $model->notice;?>
     	 </div>
     </td></tr>
     <tr>
     	  <td colspan="6" style="text-align:right;"><?php echo Util::current_time('mysql');?></td>
     </tr>
	 </table>
	 <OBJECT id=WebBrowser classid=CLSID:8856F961-340A-11D0-A96B-00C04FD705A2 height=0 width=0 VIEWASTEXT>
</OBJECT>
<div class="input_submit" id="print_button"> 
	<input type="button" onclick="javascript:preview(1)" value="web打印"/>
	<input type=button value="打印" onclick="document.all.WebBrowser.ExecWB(6,1)" >
	<input type=button value="页面设置" onclick="document.all.WebBrowser.ExecWB(8,1)" >
	<input type=button value="打印预览" onclick="document.all.WebBrowser.ExecWB(7,1)">
<div>

</div>