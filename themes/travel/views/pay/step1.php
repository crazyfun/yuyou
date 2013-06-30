<?php
      Yii::app()->clientScript->registerCssFile('/js/poshytip/tip-yellow/tip-yellow.css');
      Yii::app()->clientScript->registerScriptFile('/js/poshytip/jquery.poshytip.min.js');	
  	  $ip_convert=IpConvert::get();
		  $region_data=$ip_convert->init_region();
      $region_id=$region_data['id'];
      $insurance_select=array('0'=>'0','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>"更多");
?>
<div class="main_con">
		<div class="order_top"></div>
    <div class="order_title">
    	<span>预订：</span><h1><?php echo $travel_data->title;?></h1>
    </div>
    
    
    							<?php 
    		 							$form=$this->beginWidget('EActiveForm', array(
	        								'id'=>'pay_form',
          								'action'=>"/pay/step1",
	        								'enableAjaxValidation'=>false,
	        								'htmlOptions'=>array("onsubmit"=>"return false;"),
         							));
         							echo CHtml::hiddenField("travel_id",$travel_data->id,array());
         							echo CHtml::hiddenField("date_id","",array('id'=>'date_id'));
         							echo CHtml::hiddenField("action","order",array());
         							echo CHtml::hiddenField("company_id",$company_id,array());
        					?>
    <div class="order_main">
    	<?php 
    	$get_errors=$model->getErrors();
    	if(!empty($get_errors)){
    	?>
    	   <div class="flash_error">
    	   	<?php
    	   	$errors_str="";
    	   	foreach($get_errors as $key => $value){
    	   		$errors_str.="&nbsp;&nbsp;".$value[0];
    	   	}
    	   	echo $errors_str;
    	   	?>
    	   	</div>
    	   <?php } ?>
         <h3>产品信息</h3>
         <table class="orderpro_list">
          <thead>
            <tr>
              <th class="col1">游玩日期</th><th class="col2">名称</th><th class="col3">成人价</th><th class="col4">儿童价</th><th class="col5">数量</th><th class="col6">小计</th>
           </tr>
         </thead>
        <tbody>
          <tr>
            <td class="col1"><?php echo $travel_data->get_date_select($travel_data->id);?></td>
            <td class="col2"><a target="_blank" href="<?php echo $this->createUrl("travel/show",array("id"=>$travel_data->id));?>" title="<?php echo $travel_data->title;?>"><?php echo $travel_data->title;?></a></td>
            <td class="col3">¥<strong id="travel_adult_price"></strong></td>
            <td class="col4">¥<strong id="travel_child_price"></strong></td>
            <td class="col5 btn-nums">
            	
              <table>
             <tbody>
              <tr  style="">
                <td><span class="date_type">成人</span></td>
                <td>
                  <span class="minus" onclick="javascript:add_sub(2,'input_adult');">-</span>
                  <input name="adult_nums" id="input_adult"  class="prod-num" type="text"  maxamt="100" minamt="1" value="<?php echo $adult_nums;?>" size="2">
                  <span class="plus" onclick="javascript:add_sub(1,'input_adult');">+</span>                 </td>
                  	
                  	<td><span class="date_type">儿童</span></td>
                <td>
                  <span class="minus" onclick="javascript:add_sub(2,'input_child');">-</span>
                  <input name="child_nums" id="input_child"  class="prod-num" type="text" maxamt="100" minamt="1"  value="<?php echo $child_nums;?>" size="2">
                  <span class="plus" onclick="javascript:add_sub(1,'input_child');">+</span>                 </td>
             </tr>
             </tbody>
             </table>
             
            </td>

           <td class="col6"><span>¥</span><strong class="total" class="travel_total_price" id="travel_total_price">0</strong></td>
           </tr>
           </tbody>
           </table><!--//产品信息-->
           <div class="detail"><!--费用说明  温馨提示-->
               <ul class="detail-cur">
                   <li class="travel_tab cur-tab travel_tab_active" index="1"  style="cursor:pointer;">费用说明</li>
                   <li class="travel_tab" index="2"   style="cursor: pointer;">温馨提示</li>
               </ul>
          <div class="tab-con pro-info cur-content travel_content" id="travel_content_1" style="display: block;">
            <div id="costcontain" class="day_introduction">
             <?php echo $travel_data->tour;?>
            </div>
           </div><!--//内容一-->
          <div class="tab-con pro-info travel_content cur-content" id="travel_content_2" style="display: none;">
            <div id="refundsexplanation" class="day_introduction">
              <?php echo $travel_data->tips;?>
           </div>
        </div><!--//内容二-->
       </div><!--//费用说明  温馨提示-->
       
         <h3>报名地点</h3>
         <?php 
            $company=Company::model();
            $company_data=$company->findByPk($company_id);
         ?>
         <table class="orderpro_list">
          <thead>
            <tr>
              <th class="col1">门市名称</th><th class="col2">门市地址</th><th class="col5">联系电话</th>
           </tr>
         </thead>
         
        <tbody>
        	
          <tr>
            <td class="col1"><?php echo $company_data->company_name;?></td>
            <td class="col2"><?php echo $company_data->address;?></td>
            <td class="col5">
            	<?php echo $company_data->telephone;?>
            </td>
          </tr>
         
           </tbody>
       </table><!--//附加产品-->
       
       
       
       
       <h3>附加产品</h3>
       <?php
          $insurance=Insurance::model(); 
          $insurance_data=$insurance->get_insurance_data($travel_data->company_id);
       ?>
         <table class="orderpro_list">
          <thead>
            <tr>
              <th class="col1">产品类型</th><th class="col2">名称</th><th class="col4">价钱</th>
              <th class="col5">份数</th><th class="col6">小计</th>
           </tr>
         </thead>
         
        <tbody>
        	<?php foreach($insurance_data as $key => $value){ 
        	       echo CHtml::hiddenField("insurance_ids[]",$value->id,array());
        	?>
          <tr>
            <td class="col1"><strong>保险</strong></td>
            <td class="col2"><a class="insurance_desc" title="<?php echo $value->insurance_desc;?>" href="#"><?php echo $value->insurance_name;?></a></td>

            <td class="col4">¥<strong id="insurance_price_<?php echo $value->id;?>"><?php echo $value->insurance_price;?></strong></td>
            <td class="col5">
            	<?php echo EHtml::createSelect("insurance_number[]",$insurance_number[$key],$insurance_select,array('class'=>'insurance_number','id'=>"insurance_number_".$value->id,'index'=>$value->id));?>
            </td>
           <td class="col6">
             <span>¥</span><strong class="insurance_total_price" id="insurance_total_price_<?php echo $value->id?>">0</strong>
           </td>
           
          </tr>
         <?php } ?>
           </tbody>
       </table><!--//附加产品-->
       <div class="order_total"><!--总价-->
           产品金额：¥ <span class="jine" id="total_price">0</span>&nbsp;&nbsp;<span style="color:#000;font-size:14px;font-weight:bold;">应付：</span>¥<span class="zj" id="final_price">0</span>
      </div>
      <div class="order_commit">
        <div style="float:right;width:100px;"><input class="btn_submit" type="button" value="下一步" onclick="javascript:submit_order();"></div>
        <div style="float:left;width:400px;"><div style="float:left;line-height: 25px;"><input class="bnt_check" name="agree_order" type="checkbox" value="1" /><a href="javascript:show_agree();">同意<?php echo Yii::app()->name;?>线路预订协议</a></div></div>
      </div>   
<div style="clear:both;"></div>
    </div>
<?php $this->endWidget(); ?>
</div><!--main_con end-->
<script language="javascript">
	jQuery(function(){
		init_data();
		jQuery('.insurance_desc').poshytip();
		togglemenu({"source":"travel_tab","target":"travel_content","type":"1","effect":"2","effect_time":1000});
		jQuery("#travel_date_select").bind("change",function(){
			var adult_price=jQuery("#travel_date_select option:selected").attr("price");
			var child_price=jQuery("#travel_date_select option:selected").attr("child_price");
			jQuery("#travel_adult_price").html(adult_price);
			jQuery("#travel_child_price").html(child_price);
			cul_travel_price();
		});
		
		jQuery(".plus").bind("click",function(){
			cul_travel_price();
		});
		
		jQuery(".minus").bind("click",function(){
			cul_travel_price();
		});
		jQuery("select.insurance_number").each(function(i){
			 var index=jQuery(this).attr("index");
			 var select_val=jQuery(this).val();
			 switch(select_val){
			 	 case '6':
			 	   jQuery(this).replaceWith("<input id='insurance_number_"+index+"' type='text' name='insurance_number[]' value='0' class='prod-num insurance_number' index='"+index+"'/>");
			 	   cul_insurance_total(index);
			 	   break;
			 	 default:
			 	   cul_insurance_total(index);
			 	   break;
			 }
		});
		jQuery("select.insurance_number").live("change",function(){
			 var index=jQuery(this).attr("index");
			 var select_val=jQuery(this).val();
			 switch(select_val){
			 	 case '6':
			 	   jQuery(this).replaceWith("<input id='insurance_number_"+index+"' type='text' name='insurance_number[]' value='0' class='prod-num insurance_number' index='"+index+"'/>");
			 	   cul_insurance_total(index);
			 	   break;
			 	 default:
			 	   cul_insurance_total(index);
			 	   break;
			 }
		});
		jQuery("input.insurance_number").live("change",function(){
			 var index=jQuery(this).attr("index");
			 cul_insurance_total(index);
		});
	});
	function init_data(){
		var travel_date="<?= $travel_date ?>";
		jQuery("#travel_date_select").val(travel_date);
		var adult_price=jQuery("#travel_date_select option:selected").attr("price");
		var child_price=jQuery("#travel_date_select option:selected").attr("child_price");
		jQuery("#travel_adult_price").html(adult_price);
		jQuery("#travel_child_price").html(child_price);
		cul_travel_price();
	}

	function cul_travel_price(){
		var adult_price=jQuery("#travel_date_select option:selected").attr("price");
		var child_price=jQuery("#travel_date_select option:selected").attr("child_price");
		var adult_number=jQuery("#input_adult").val();
		var child_number=jQuery("#input_child").val();
		var total_price=(parseFloat(adult_price)*parseFloat(adult_number))+(parseFloat(child_price)*parseFloat(child_number));
		jQuery("#travel_total_price").html(total_price);
		cul_total_price();
	}
	
	function cul_insurance_total(index){
		 var insurance_price=jQuery("#insurance_price_"+index).html();
		 var insurance_number=jQuery("#insurance_number_"+index).val();
		 var total_price=parseFloat(insurance_price)*parseFloat(insurance_number);
		 jQuery("#insurance_total_price_"+index).html(total_price);
		 cul_total_price();
	}
	
	function cul_total_price(){
		var total_price=0;
		var travel_total_price=jQuery("#travel_total_price").html();

		total_price+=parseFloat(travel_total_price);
		jQuery(".insurance_total_price").each(function(i){
       var insurance_total_price=jQuery(this).html();
       total_price+=parseFloat(insurance_total_price);
    }); 
    jQuery("#total_price").html(total_price);
    jQuery("#final_price").html(total_price);
	}
	
 function submit_order(){
		var date_id=jQuery("#travel_date_select option:selected").attr("date_id");
		jQuery("#date_id").val(date_id);
		document.getElementById("pay_form").submit();
	}
	
	
	function show_agree(){
         	  jQuery.jBox("iframe:/pay/agreement", {
   						 title: "会员协议",
    					 width: 800,
    					 height: 500,
    						buttons: { '关闭': true }
							});
   }
</script>