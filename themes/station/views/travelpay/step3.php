<div class="main_con">
	 <div class="order_top order_top3"></div>
    <div class="order_title">
    	<span>预订：</span><h1><a href="<?php echo $this->createUrl("travel/show",array("id"=>$model->Travel->id));?>" target="_blank"><?php echo $model->Travel->title;?></a></h1>
    </div>
    <?php 
    		 							$form=$this->beginWidget('EActiveForm', array(
	        								'id'=>'pay_form',
          								'action'=>$this->createUrl("travelpay/step3"),
	        								'enableAjaxValidation'=>false,
	        								'htmlOptions'=>array('onsubmit'=>'return false;'),
         							));
         							echo CHtml::hiddenField("order_id",$model->id,array());
         							echo CHtml::hiddenField("action","order",array());
        					?>
    <div class="order_main">
    	   <?php $this->widget("FlashInfo");?>
         <h3>线路信息</h3>
         <table class="orderpro_list">
          <thead>
            <tr>
              <th class="col2">线路名称</th><th class="col1">出发时间</th><th class="col3">出发地</th><th class="col3">目的地</th>
              <th class="col4">出游人数</th>
           </tr>
         </thead>
        <tbody>
          <tr>
            <td class="col2"><a href="<?php echo $this->createUrl("travel/show",array("id"=>$model->Travel->id));?>" target="_blank"><?php echo $model->Travel->title;?></a></td>
            <td class="col1 date"><?php echo $model->travel_date;?></td>
            <td class="col3"><?php echo $model->Travel->show_attribute("start_region");?></td>
            <td class="col3"><?php echo $model->Travel->show_attribute("end_region");?></td>
            <td class="col4"><?php echo $model->adult_nums;?>成人,<?php echo $model->child_nums;?>儿童 </td>
            
           </tr>
           </tbody>
           </table>
       
       <?php
           
           $tem_order_insurance=TempOrderInsurance::model();
           $order_insurance_datas=$tem_order_insurance->with("Insurance")->findAll("t.order_id=:order_id",array(':order_id'=>$model->id));
       
       ?>
         <h3>保险信息</h3>
         <table class="orderpro_list">
          <thead>
            <tr>
              <th class="col2">保险名称</th><th class="col2">说明</th><th class="col3">份数</th><th class="col3">小计</th>
           </tr>
         </thead>
        <tbody>
        	<?php foreach($order_insurance_datas as $key => $value){ ?>
          <tr>
            <td class="col2"><?php echo $value->Insurance->insurance_name;?></td>
            <td class="col2"><?php echo $value->Insurance->insurance_desc;?></td>
            <td class="col3"><?php echo $value->insurance_number;?></td>
            <td class="col3"><strong><?php echo ($value->insurance_number*$value->Insurance->insurance_price);?></strong></td>
           </tr>
         <?php } ?>
         </tbody>
       </table>
         <!--//保险信息--> 
         <div class="order_price">总价：<span class="order_show"><?php echo $model->total_price;?></span>元</div>
         <h3>联系人信息</h3>
         <table class="orderpro_list">
          <thead>
            <tr>
              <th class="col2">姓名</th><th class="col5">手机</th> 
           </tr>
         </thead>
        <tbody>
        	<?php
        	    $tem_order_contacter=TemOrderContacter::model();
        	    $main_contacter_data=$tem_order_contacter->find("t.order_id=:order_id AND t.main=:main",array(':order_id'=>$model->id,':main'=>'1'));
        	    $contacter_data=$tem_order_contacter->findAll("t.order_id=:order_id AND t.main<>:main",array(':order_id'=>$model->id,':main'=>'1'));
        	 ?>
          <tr>
            <td class="col2"><?php echo $main_contacter_data->contacter;?></td>
            <td class="col5"><?php echo $main_contacter_data->contacter_phone;?></td>
           </tr>
           </tbody>
           </table>
         <!--//联系人信息--> 
         <h3>游客信息</h3>
         <table class="orderpro_list">
          <thead>
            <tr>
              <th class="col1">姓名</th><th class="col5">证件类型</th><th class="col2">证件号码</th><th class="col3">儿童</th><th class="col3">上车地点</th><th class="col5">手机</th> 
           </tr>
         </thead>
        <tbody>
        	<?php foreach($contacter_data as $key => $value){ ?>
          <tr>
            <td class="col1"><?php echo $value->contacter;?></td>
            <td class="col5"><?php echo $value->show_attribute("code_type");?></td>
            <td class="col2"><?php echo $value->show_attribute("code_value");?></td>
            <td class="col3"><?php echo $value->show_attribute("is_child");?></td>
            <td class="col3"><?php echo $value->show_attribute("address_id");?></td>
            <td class="col5"><?php echo $value->show_attribute("contacter_phone");?></td>
           </tr>
         <?php } ?>
           </tbody>
           </table>
          
         <!--//游客信息--> 
         <h3>其他信息</h3>
         <div class="user-info remark2">
           <div class="inp_left">订单备注：</div>
           <div class="inp_center"><textarea name="comment" class="dingdan_xuqiu"  rows="4" cols="70"><?php echo $model->comment;?></textarea></div>
           <div class="clear_float"></div>
         </div><!--订单备注-->
         <div class="order_commit">
        <input class="btn_submit" type="button" onclick="javascript:create_order();" value="生成订单">
        <div style="clear:both;"></div>
      </div>   
    </div>
   <?php $this->endWidget(); ?>
</div><!--main_con end-->

<script language="javascript">
	var user_id="<?= Yii::app()->user->id; ?>";
	function create_order(){
		if(user_id){
			document.getElementById("pay_form").submit();
		}else{
			pop_login();
			
		}
		
	}
</script>