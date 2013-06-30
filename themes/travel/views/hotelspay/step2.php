
<?php   
      Yii::app()->clientScript->registerCssFile('/js/poshytip/tip-yellow/tip-yellow.css');
      Yii::app()->clientScript->registerScriptFile('/js/poshytip/jquery.poshytip.min.js');
 ?>
<div class="main_con">
<div class="w750">
<div class="tg_intr_top"><img src="<?php echo $cssPath;?>/images/tg_intr_top.jpg" /></div>
<div class="tg_intr_center">
   <div class="tg_buy_top"><img src="<?php echo $cssPath;?>/images/tj_sanbu1.gif" /></div>
   <div class="buy_out">
       <table class="buy_heatab" width="100%" cellspacing="0" cellpadding="0" border="0">
           <tbody>
           <tr class="buy_hhbg">
              <td width="42%" align="center">名称</td>
              <td width="2%" align="center"><img src="<?php echo $cssPath;?>/images/tj_line.gif" /></td>
              <td width="15%" align="center">数量/间</td>
              <td width="2%" align="center"><img src="<?php echo $cssPath;?>/images/tj_line.gif" /></td>
              <td width="17%" align="center">单价</td>
              <td width="2%" align="center"><img src="<?php echo $cssPath;?>/images/tj_line.gif" /></td>
              <td width="17%" align="center">天数</td>
              <td width="2%" align="center"><img src="<?php echo $cssPath;?>/images/tj_line.gif" /></td>
              <td width="20%" align="center">总价</td>
          </tr>
          <tr>
            <td class="buy_padd"><a target="_blank" href="<?php echo $this->createUrl("hotels/show",array('id'=>$model->Hotels->id));?>"><?php echo $model->Hotels->title;?></a></td>
            <td></td>
            <td class="buy_fontz" align="center"><?php echo $model->numbers;?></td>
            <td class="buy_fontz" align="center">×</td>
            <td class="buy_fontz" align="center">¥<span id="price"><?php echo $model->HotelsPrice->price;?></span></td>
            <td class="buy_fontz" align="center">×</td>
            <td class="buy_fontz" align="center"><span id="price"><?php echo $diff_days;?></span>天</td>
            <td class="buy_fontz" align="center">=</td>
            <td class="buy_fontz0" align="center">¥<span id="total_money_no_cf"><?php echo $model->total_price;?></span></td>
          </tr>
          <tr>
            <td class="buy_botline" colspan="9">
            	  <p>我们将尽快确认资源，以手机短信的形式通知到您，请耐心等待，您也可以进行<a id="yuyuequan" title="1、在您进行预授权后，一旦产品资源得到确认，您的订单款项将自动扣除，即订单支付成功。</br>2、若您预订的产品资源无法确认，则您授权的预授权返回您的银行账户，无需您任何操作及手续费。" href="#">预授权</a></p>
                <strong>您的手机号：</strong>购买成功后 <?php echo Yii::app()->name;?>订单号将发送到手机：<?php echo $model->contacter_phone;?>，凭短信去商家消费。
            </td>
          </tr>

          <tr>
            <td class="buy_padd buy_zongj" align="right" style="font-family:Arial;" colspan="9"><em style="font-weight:bold"> </em>
                 总额：<span id="total_money" class="buy_redzi">¥<?php echo $model->total_price;?></span>
            </td>
         </tr>
       </tbody>
     </table>
   </div><!--//buy_out-->
   <div class="buy_zf"><!--支付方式-->
   	  <?php $this->widget("FlashInfo");?>
      <div class="zf_top">请选择支付方式</div>
      
      	
      	<?php 
    		 							$form=$this->beginWidget('EActiveForm', array(
	        								'id'=>'pay_form',
          								'action'=>"/hotelspay/step2",
	        								'enableAjaxValidation'=>false,
	        								'htmlOptions'=>array(),
         							));
         							echo CHtml::hiddenField("action","save",array());
         							echo CHtml::hiddenField("id",$model->id,array());
        			?>
         <div class="montitle"><span>网上支付</span>选择网银、支付宝、财付通、银联在线等方式进行充值，即时到账</div>
         <div class="bank_lists">
                    	  <?php
                    	     $pay_lists=array('kuaiqian_abc','kuaiqian_bcom','kuaiqian_boc','kuaiqian_ccb','kuaiqian_cmb','kuaiqian_cmbc','kuaiqian_icbc','kuaiqian_sdb');
                    	     $payment_type=CV::$travel_payment_type;
                    	     foreach($pay_lists as $key => $value){ 
                    	         $bank_data=$payment_type[$value];
                    	  ?>
                    	  		<div class="bank_item"><span class="bank_radio"><?php echo CHtml::radioButton("type",false,array('value'=>$value));?></span><span class="bank_image"><?php echo CHtml::image($cssPath."/images/".$bank_data['image'],$bank_data['name'],array()); ?></span></div>
                    	  <?php } ?>
          </div>
          
          <div class="clear_both"></div>
                    <div class="montitle">
                    	  请选择其他合作支付平台进行支付
                    </div>
 
                     <div class="bank_lists">
                    	 <?php
                    	     $pay_lists=array('alipay','kuaiqian');
                    	     foreach($pay_lists as $key => $value){ 
                    	         $bank_data=$payment_type[$value];
                    	  ?>
                    	  		<div class="bank_item"><span class="bank_radio"><?php echo CHtml::radioButton("type",false,array('value'=>$value));?></span><span class="bank_image"><?php echo CHtml::image($cssPath."/images/".$bank_data['image'],$bank_data['name'],array()); ?></span></div>
                    	  <?php } ?>
                    	   <?php
                    	     if(!Yii::app()->user->isGuest){
                    	     	$pay_lists=array('coupon');
                    	    }else{
                    	    	$pay_lists=array();
                    	    }
                    	     
                    	     foreach($pay_lists as $key => $value){ 
                    	         $bank_data=$payment_type[$value];
                    	  ?>
                    	  		<div class="bank_item"><span class="bank_radio"><?php echo CHtml::radioButton("type",false,array('value'=>$value));?></span><?php echo $bank_data['name']?></div>
                    	  <?php } ?>
                    	<span class="pay_error"><?php  echo $form->error($model,"type");?></span>
                    </div>
                    <div class="clear_both"></div> 
      
       <div class="order_commit">
        <input class="btn_submit" type="button"  onclick="javascript:create_order();" value="确认支付" >  
        <div class="clear_float"></div>    
      </div> 
         
        <?php $this->endWidget(); ?> 
         
    
   </div><!--//支付方式-->
</div>
<div class="tg_intr_bottom"><img src="<?php echo $cssPath;?>/images/tg_intr_bottom.jpg" /></div>
</div><!--//w750-->
<div class="R-r-right">
                <div class="hot_rec_con">
                	<div class="R_r_title">热门推荐酒店</a><a href="<?php echo $this->createUrl("search/index",array('action'=>'hotels'));?>">更多></a></div>
                    <div class="hot_list">
                        <ul>
                        	<?php BZ::blocks("pattern/hotels/view/recommend_hotels_block/attr/c/sort/update_time/sort_type/DESC/size/200*127/limit/5/cacheid/recommend_hotels");?>
                        </ul>
					         </div>
                </div><!--hot_list end-->
                
               <div class="contact_us"><!--商家信息-->
         <div class="R_r_title">酒店信息</div>
               <div class="map_info"><!--地图-->
               		<?php
  		
      				if($this->beginCache("WBaiduMaps", array('duration'=>"1"))){
                  $this->widget('WBaiduMaps', array( 
                  
                     'coordinate'=>$model->Hotels->hotel_coordinate, 
                     'address'=>$model->Hotels->hotel_address          
              	  )); 
             		$this->endCache(); 
       			  }        
       			?>
               </div><!--//地图-->
               <div class="adr_info"><!--地址信息-->
                  <p>酒店名称：<?php echo $model->Hotels->title;?></p>
                  <p>地址：<?php echo $model->Hotels->hotel_address;?></p>
                  <p>电话：<?php echo $model->Hotels->hotel_telephone;?></p>
               </div><!--//地址信息-->
      </div><!--//商家信息-->
  </div>
</div>
<div class="clear_float"></div>
</div><!--main_con end-->

<script language="javascript">
	jQuery(function(){
		
		jQuery('#yuyuequan').poshytip();
	});
	
	var user_id="<?= Yii::app()->user->id; ?>";
	function create_order(){
		if(user_id){
			document.getElementById("pay_form").submit();
		}else{
			pop_login();
			
		}
		
	}


</script>