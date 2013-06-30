<div class="gc_con">
        		 	  
        		 	   <div class="gc_tips_title">出游联系信息</div>
        		 	   <table class="gc_table">
        		 	   	  <tbody>
        		 	   	  	  <tr>
        		 	   	  	  	<td class="gc_title">联系人：</td>
        		 	   	  	  	<td class="gc_input"><?php echo $model->show_attribute("contact_name");?></td>
        		 	   	  	  	<td class="gc_title">手机号码：</td>
        		 	   	  	  	<td class="gc_input"><?php echo $model->show_attribute("contact_phone");?></td>
        		 	   	  	  </tr>
        		 	   	  	  
        		 	   	  	  <tr>
        		 	   	  	  	<td class="gc_title">联系电话：</td>
        		 	   	  	  	<td class="gc_input"><?php echo $model->show_attribute("contact_tel");?></td>
        		 	   	  	  	<td class="gc_title">E-mail：</td>
        		 	   	  	  	<td class="gc_input"><?php echo $model->show_attribute("contact_email");?></td>
        		 	   	  	  </tr>
        		 	   	  	  
        		 	   	  	  
        		 	   	  	  <tr>
        		 	   	  	  	<td class="gc_title">回复时间：</td>
        		 	   	  	  	<td class="gc_input" colspan="3"><?php echo $model->show_attribute("reply_time");?></td>
        		 	   	  	  	
        		 	   	  	  </tr>
        		 	   	  	  
        		 	   	  	  

        		 	   	  </tbody>
        		 	   	</table>
        		 	</div>
        		 	
        		 	<div class="gc_com">
        		 		<div class="gc_tips_title">出游信息</div>
        		 		<table class="gc_table" id="gc_com_message">
        		 		   <tr>
        		 	   	  	  <td class="gc_title">公司名称：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $model->show_attribute("company_name");?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">出发城市：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $model->show_attribute("start_region");?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">目的地：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $model->show_attribute("end_region");?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">出发日期：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $model->show_attribute("start_time");?></td>
        		 	   	 </tr>
        		 	   	  <tr>
        		 	   	  	  <td class="gc_title">返程日期：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $model->show_attribute("end_time");?></td>
        		 	   	 </tr>
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">人数：</td>
        		 	   	  	  <td class="gc_cinput">成人数：<?php echo $model->show_attribute("adults");?>人&nbsp;&nbsp;儿童数：<?php echo $model->show_attribute("childs");?>人</td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">天数：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $model->show_attribute("travel_nums");?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">出游预算：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $model->show_attribute("travel_budget");?>元/人</td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">交通工具：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $model->show_attribute("transport");?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title"></td>
        		 	   	  	  <td class="gc_cinput"><?php echo $model->show_attribute("transport_tips");?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">住宿标准：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $model->show_attribute("stay");?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title"></td>
        		 	   	  	  <td class="gc_cinput"><?php echo $model->show_attribute("stay_tips");?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">用餐标准：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $model->show_attribute("dinning");?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title"></td>
        		 	   	  	  <td class="gc_cinput"><?php echo $model->show_attribute("dinning_tips");?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">导游要求：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $model->show_attribute("guide");?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title"></td>
        		 	   	  	  <td class="gc_cinput"><?php echo $model->show_attribute("guide_tips");?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">购物安排：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $model->show_attribute("shopping");?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title"></td>
        		 	   	  	  <td class="gc_cinput"><?php echo $model->show_attribute("shopping_tips");?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">会议安排：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $model->show_attribute("meeting");?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title"></td>
        		 	   	  	  <td class="gc_cinput"><?php echo $model->show_attribute("meeting_tips");?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	     
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">其他需求：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $model->show_attribute("other_tips");?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 			 <tr>
        		 			 	    <td class="gc_title">过期状态</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $model->show_attribute("status");?></td>
        		 	   	  	  
        		 	   	 </tr>
        		 		</table>
        		 		
        		  </div>