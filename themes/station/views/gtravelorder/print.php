 <?php
           $travel_order_insurance=TravelOrderInsurance::model();
           $order_insurance_datas=$travel_order_insurance->with("Insurance")->findAll("t.order_id=:order_id",array(':order_id'=>$model->id));
           
        	 $travel_order_contacter=TravelOrderContacter::model();
        	 $main_contacter_data=$travel_order_contacter->find("t.order_id=:order_id AND t.main=:main",array(':order_id'=>$model->id,':main'=>'1'));
        	 $contacter_data=$travel_order_contacter->findAll("t.order_id=:order_id AND t.main<>:main",array(':order_id'=>$model->id,':main'=>'1'));

        	 $company=Company::model();
      		 $company_data=$company->findByPk($model->company_id);
        	
?>
<div class="print">
	 <table class="print_table">
	 	   <tr><td colspan="6" style="text-align:center;"><strong><?php echo $model->Travel->title;?></strong></td></tr>
	 	   
	 	   <tr>
	 	   	<td colspan="6">甲方:<?php echo $company_data->company_name;?></td>
	 	   
	 	   </tr>
	 	   
	 	   <tr>
	 	   	<td colspan="6">乙方:</td>
	 	    
	 	   </tr>
	 	   
	 	   
	 	   
	 	   <tr><td colspan="6" class="p_talbe_wrapper">订单信息:</td>	</tr>
	 	   <tr>
	 	   	<td class="p_table_title">出发时间:</td><td class="p_table_content"><?php echo $model->travel_date;?></td>
	 	   	<td class="p_table_title">出发地:</td><td class="p_table_content"><?php echo $model->Travel->show_attribute("start_region");?></td>
	 	   	<td class="p_table_title">目的地:</td><td class="p_table_content"><?php echo $model->Travel->show_attribute("end_region");?></td>
	 	    
	 	   </tr>
	 	   <tr>
	 	   	<td class="p_table_title">成人数:</td><td class="p_table_content"><?php echo $model->adult_nums;?>人</td>
	 	   	<td class="p_table_title">儿童数:</td><td class="p_table_content"><?php echo $model->child_nums;?>人</td>
	 	   	<td class="p_table_title">总价:</td><td class="p_table_content"><?php echo $model->show_attribute("total_price");?>元</td>
	 	   </tr>
	 	 
     <tr>
     	
       <td colspan="6" class="p_talbe_wrapper">保险信息:</td>	
     </tr>
     <?php foreach($order_insurance_datas as $key => $value){ ?>
     	<tr>
	 	   	<td class="p_table_title">保险名称:</td><td class="p_table_content"><?php echo $value->Insurance->insurance_name;?></td>
	 	   	<td class="p_table_title">份数:</td><td class="p_table_content"><?php echo $value->insurance_number;?></td>
	 	   	<td class="p_table_title">小计:</td><td class="p_table_content"><?php echo ($value->insurance_number*$value->Insurance->insurance_price);?>元</td>
     </tr>
     <?php } ?>
     	
     <tr><td colspan="6" class="p_talbe_wrapper">联系人信息:</td>	</tr>
     <tr>
     	  <td class="p_table_title">姓名:</td><td class="p_table_content"><?php echo $main_contacter_data->contacter;?></td>
	 	   	<td class="p_table_title">手机:</td><td class="p_table_content"><?php echo $main_contacter_data->contacter_phone;?></td>
	 	   	<td class="p_table_title">&nbsp;</td><td class="p_table_content">&nbsp;</td>
    </tr>
     
     
     <tr><td colspan="6" class="p_talbe_wrapper">游客信息:</td>	</tr>
     
     
     <tr>
     	 <td colspan="6">
     	 	  <table class="print_table">
     	 	  	<?php foreach($contacter_data as $key => $value){ ?>
     	 	  	  <tr>
     	 	  	   <td class="p_table_title">姓名:</td><td class="p_table_content"><?php echo $value->contacter;?></td>
	 	   				 <td class="p_table_title">证件类型:</td><td class="p_table_content"><?php echo $value->show_attribute("code_type");?></td>
	 	   	      <td class="p_table_title">证件号码:</td><td class="p_table_content"><?php echo $value->show_attribute("code_value");?></td>
     	         <td class="p_table_title">儿童:</td><td class="p_table_content"><?php echo $value->show_attribute("is_child");?></td>
	 	   				<td class="p_table_title">上车地点:</td><td class="p_table_content"><?php echo $value->show_attribute("address_id");?></td>
	 	   				<td class="p_table_title">手机:</td><td class="p_table_content"><?php echo $value->show_attribute("contacter_phone");?></td>
            </tr>
             <?php } ?>
     	 	  </table>
     	 </td>
    </tr> 
     <tr><td colspan="6" class="p_talbe_wrapper">门市信息:</td>	</tr>
     <tr>
     	  <td class="p_table_title">门市名称:</td><td class="p_table_content"><?php echo $company_data->company_name;?></td>
	 	   	<td class="p_table_title">门市地址:</td><td class="p_table_content"><?php echo $company_data->address;?></td>
	 	   	<td class="p_table_title">联系电话:</td><td class="p_table_content"><?php echo $company_data->telephone;?></td>
     	</tr>
     	
     	<tr>
     	  <td class="p_table_title">订单备注:</td><td colspan="5"><?php echo $model->show_attribute("comment");?></td>
     	</tr>
     	
     	<tr>
     	  <td colspan="6" style="text-align:right;">甲方签字:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>乙方签字:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
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