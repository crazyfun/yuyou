<div class="order_main">
	     <h3>订单信息</h3>
         <table class="orderpro_list">
          <thead>
            <tr>
              <th class="col2">酒店名称</th><th class="col3">城市</th><th class="col3">入住时间</th><th class="col3">退房时间</th><th class="col3">房间数</th><th class="col3">入住人数</th><th class="col3">总价</th>
              <th class="col4">到店时间</th>
              <th class="col3">订单状态</th>
              <th class="col3">付款状态</th>
              <th class="col3">付款时间</th>
              <th class="col3">提交时间</th>
           </tr>
         </thead>
        <tbody>
          <tr>
            <td class="col2"><a href="<?php echo $this->createUrl("hotels/show",array("id"=>$model->hotels_id));?>" target="_blank"><?php echo $model->Hotels->title;?></a></td>
            <td class="col3"><?php echo $model->Hotels->show_attribute("hotel_region");?></td>
            <td class="col3"><?php echo $model->start_date;?></td>
            <td class="col3"><?php echo $model->end_date;?></td>
            <td class="col3"><?php echo $model->numbers;?></td>
            <td class="col3"><?php echo $model->live_numbers;?></td>
            <td class="col3"><?php echo $model->total_price;?></td>
            <td class="col4"><?php echo $model->start_time;?></td>
            <td class="col3">
            	<?php echo $model->show_attribute("status");?>
            </td>
            <td class="col3"><?php echo $model->show_attribute("pay_status");?></td>
            <td class="col3"><?php echo $model->show_attribute("pay_time");?></td>
            <td class="col3"><?php echo $model->show_attribute("create_time");?></td>
            
           </tr>
           </tbody>
           </table>


         <h3>房型信息</h3>
         <table class="orderpro_list">
          <thead>
            <tr>
              <th class="col2">房型</th><th class="col3">价钱</th><th class="col3">宽带</th><th class="col3">床型</th><th class="col3">早餐</th>
           </tr>
         </thead>
        <tbody>
        	
          <tr>
            <td class="col2"><?php echo $model->HotelsBeds->name;?></td>
            <td class="col3"><?php echo $model->HotelsPrice->price;?></td>
            <td class="col3"><?php echo $model->HotelsPrice->show_attribute("line");?></td>
            <td class="col3"><?php echo $model->HotelsPrice->show_attribute("bed");?></td>
            <td class="col3"><?php echo $model->HotelsPrice->show_attribute("breakfast");?></td>
           </tr>
         
         </tbody>
       </table>
	
	
   	<h3>联系人信息</h3>
         <table class="orderpro_list">
          <thead>
            <tr>
              <th class="col2">姓名</th><th class="col5">手机</th> <th class="col5">座机</th> <th class="col5">邮箱</th> 
           </tr>
         </thead>
        <tbody>
        
          <tr>
            <td class="col2"><?php echo $model->contacter;?></td>
            <td class="col5"><?php echo $model->contacter_phone;?></td>
            <td class="col5"><?php echo $model->contacter_telephone;?></td>
            <td class="col5"><?php echo $model->email;?></td>
           </tr>
           </tbody>
           </table>
         <!--//联系人信息-->
         

         
         <h3>酒店信息</h3>
         <table class="orderpro_list">
          <thead>
            <tr>
              <th class="col1">酒店地址</th><th class="col1">酒店电话</th><th class="col2">订单备注</th> 
           </tr>
         </thead>
        <tbody>
        	
          <tr>
            <td class="col1"><?php echo $model->Hotels->hotel_address;?></td>
            <td class="col1"><?php echo $model->Hotels->hotel_telephone;?></td>
            <td class="col2"><?php echo $model->show_attribute("commment");?></td>
           </tr>
           </tbody>
           </table>
</div>