<div class="order_main">
	     <h3>订单信息</h3>
         <table class="orderpro_list">
          <thead>
            <tr>
              <th class="col2 t_center">线路名称</th><th class="col1">出发时间</th><th class="col3">出发地</th><th class="col3">目的地</th><th class="col3">总价</th><th class="col3">需支付</th><th class="col3">抵用劵</th>
              <th class="col4">出游人数</th>
              <th class="col3">订单状态</th>
              <th class="col3">付款状态</th>
              <th class="col3">付款时间</th>
              <th class="col3">提交时间</th>
           </tr>
         </thead>
        <tbody>
          <tr>
            <td class="col2"><a href="<?php echo $this->createUrl("travel/show",array("id"=>$model->Travel->id));?>" target="_blank"><?php echo $model->Travel->title;?></a></td>
            <td class="date"><?php echo $model->travel_date;?></td>
            <td class="col3"><?php echo $model->Travel->show_attribute("start_region");?></td>
            <td class="col3"><?php echo $model->Travel->show_attribute("end_region");?></td>
            <td class="col3"><?php echo $model->show_attribute("all_price");?></td>
            <td class="col3"><?php echo $model->show_attribute("total_price");?></td>
            <td class="col3"><?php echo $model->show_attribute("coupon");?></td>
            <td class="col4"><?php echo $model->adult_nums;?>成人,<?php echo $model->child_nums;?>儿童 </td>
            <td class="col3">
            	<?php if($model->status=='1'||$model->status=='2'||$model->status=='3'||$model->status=='4'||$model->status=='5'){
            		      echo "正在处理";
            	}
            	if($model->status=='6'||$model->status=='7'){
            		     echo "已成功";
            	}
            	if($model->status=='8'){
            		     echo "已取消";
            	}
            	?>
            </td>
            <td class="col3"><?php echo $model->show_attribute("pay_status");?></td>
            <td class="col3"><?php echo $model->show_attribute("pay_time");?></td>
            <td class="col3"><?php echo $model->show_attribute("create_time");?></td>
            
           </tr>
           </tbody>
           </table>

       <?php
           $travel_order_insurance=TravelOrderInsurance::model();
           $order_insurance_datas=$travel_order_insurance->with("Insurance")->findAll("t.order_id=:order_id",array(':order_id'=>$model->id));
       
       ?>
         <h3>保险信息</h3>
         <table class="orderpro_list">
          <thead>
            <tr>
              <th class="col2 t_center">保险名称</th><th class="col2 t_center">说明</th><th class="col3">份数</th><th class="col3">小计</th>
           </tr>
         </thead>
        <tbody>
        	<?php foreach($order_insurance_datas as $key => $value){ ?>
          <tr>
            <td class="col2"><?php echo $value->Insurance->insurance_name;?></td>
            <td class="col2"><?php echo $value->Insurance->insurance_desc;?></td>
            <td class="col3"><?php echo $value->insurance_number;?></td>
            <td class="col4"><strong><?php echo ($value->insurance_number*$value->Insurance->insurance_price);?></strong></td>
           </tr>
         <?php } ?>
         </tbody>
       </table>
	
	
   	<h3>联系人信息</h3>
         <table class="orderpro_list">
          <thead>
            <tr>
              <th class="col1">姓名</th><th class="col5">手机</th> 
           </tr>
         </thead>
        <tbody>
        	<?php
        	    $travel_order_contacter=TravelOrderContacter::model();
        	    $main_contacter_data=$travel_order_contacter->find("t.order_id=:order_id AND t.main=:main",array(':order_id'=>$model->id,':main'=>'1'));
        	    $contacter_data=$travel_order_contacter->findAll("t.order_id=:order_id AND t.main<>:main",array(':order_id'=>$model->id,':main'=>'1'));
        	 ?>
          <tr>
            <td class="col1"><?php echo $main_contacter_data->contacter;?></td>
            <td class="col5"><?php echo $main_contacter_data->contacter_phone;?></td>
           </tr>
           </tbody>
           </table>
         <!--//联系人信息-->
         
                  <h3>游客信息</h3>
         <table class="orderpro_list">
          <thead>
            <tr>
              <th class="col1">姓名</th><th class="col5">证件类型</th><th class="col2 t_center">证件号码</th><th class="col3">儿童</th><th class="col3">上车地点</th><th class="col5">手机</th> 
           </tr>
         </thead>
        <tbody>
        	<?php foreach($contacter_data as $key => $value){ ?>
          <tr>
            <td class="col1"><?php echo $value->contacter;?></td>
            <td class="col5"><?php echo $value->show_attribute("code_type");?></td>
            <td class="col2 t_center"><?php echo $value->show_attribute("code_value");?></td>
            <td class="col3"><?php echo $value->show_attribute("is_child");?></td>
            <td class="col3"><?php echo $value->show_attribute("address_id");?></td>
            <td class="col5"><?php echo $value->show_attribute("contacter_phone");?></td>
           </tr>
         <?php } ?>
           </tbody>
           </table>
         <!--//游客信息--> 
         <?php
					$company=Company::model();
      		$company_data=$company->findByPk($model->company_id);
				?>	
				

         
         <h3>门市信息</h3>
         <table class="orderpro_list">
          <thead>
            <tr>
              <th class="col1">门市名称</th><th class="col5">门市地址</th><th class="col1">联系电话</th><th class="col2">订单备注</th> 
           </tr>
         </thead>
        <tbody>
        	
          <tr>
            <td class="col1"><?php echo $company_data->company_name;?></td>
            <td class="col5"><?php echo $company_data->address;?></td>
            <td class="col1"><?php echo $company_data->telephone;?></td>
            <td class="col2"><?php echo $model->show_attribute("comment");?></td>

           </tr>
         
         
           </tbody>
           </table>
</div>
<div class="order_print_wrapper"><a href="javascript:void('0')" onclick="javascript:window.open('<?php echo $this->createUrl("gtravelorder/print",array('id'=>$model->id));?>','打印订单','alwaysRaised=yes,scrollbars=yes,location=yes,status=yes,resizable=yes,toolbar=yes,menubar=yes');" class="print_button">打印订单</a></div>