<div class="order_main">
	     <h3>订单信息</h3>
         <table class="orderpro_list">
          <thead>
            <tr>
              <th class="col2 t_center">产品名称</th><th class="col3">手机号码</th><th class="col3">产品价格</th><th class="col3">购买数量</th><th class="col3">总价</th><th class="col3">订单状态</th><th class="col3">付款状态</th><th class="col4">付款时间</th><th class="col3">下单时间</th>
           </tr>
         </thead>
        <tbody>
          <tr>
            <td class="col2"><?php echo $model->show_group_title();?></td>
            <td class="col3"><?php echo $model->cell_phone;?></td>
            <td class="col3"><?php echo $model->Group->price;?></td>
            <td class="col3"><?php echo $model->amount;?></td>
            <td class="col3"><?php echo $model->total_price;?></td>
            <td class="col3"><?php echo $model->show_attribute("status");?></td>
            <td class="col3"><?php echo $model->show_attribute("pay_status");?></td>
            <td class="col4"><?php echo $model->show_attribute("pay_time");?></td>
            <td class="col3">
            	<?php echo $model->show_attribute("create_time");?>
            </td>

           </tr>
           </tbody>
           </table>


	
	
   	<h3>商家信息</h3>
         <table class="orderpro_list">
          <thead>
            <tr>
              <th class="col1">商家</th><th class="col5">地址</th><th class="col5">联系电话</th><th class="col5">交通</th>  
           </tr>
         </thead>
        <tbody>
        	
          <tr>
            <td class="col1"><?php echo $model->Group->Company->company_name;?></td>
            <td class="col5"><?php echo $model->Group->Company->address;?></td>
            <td class="col5"><?php echo $model->Group->Company->telephone;?></td>
            <td class="col5"><?php echo $model->Group->Company->traffic;?></td>
           </tr>
           </tbody>
           </table>
         <!--//联系人信息-->



</div>