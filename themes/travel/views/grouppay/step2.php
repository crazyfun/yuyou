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
              <td width="15%" align="center">数量</td>
              <td width="2%" align="center"><img src="<?php echo $cssPath;?>/images/tj_line.gif" /></td>
              <td width="17%" align="center">单价</td>
              <td width="2%" align="center"><img src="<?php echo $cssPath;?>/images/tj_line.gif" /></td>
              <td width="20%" align="center">总价</td>
          </tr>
          <tr>
            <td class="buy_padd"><a target="_blank" href="<?php echo $this->createUrl("group/show",array('id'=>$model->Group->id));?>"><?php echo $model->Group->title;?></a></td>
            <td></td>
            <td class="buy_fontz" align="center"><?php echo $model->amount;?></td>
            <td class="buy_fontz" align="center">×</td>
            <td class="buy_fontz" align="center">¥<span id="price"><?php echo $model->Group->price;?></span></td>
            <td class="buy_fontz" align="center">=</td>
            <td class="buy_fontz0" align="center">¥<span id="total_money_no_cf"><?php echo $model->total_price;?></span></td>
          </tr>
          <tr>
            <td class="buy_botline" colspan="7">
                <strong>您的手机号：</strong>团购成功后 <?php echo Yii::app()->name;?>订单号将发送到手机：<?php echo $model->cell_phone;?>，凭短信去商家消费。
            </td>
          </tr>
          <tr>
            <td class="buy_botline" colspan="7">
            	<?php 
            	  $user=User::model();
            	  $user_id=Yii::app()->user->id;
            	  $user_data=$user->findByPk($user_id);
            	?>
                <strong>您的账户信息：</strong>账户:<?php echo $user_data->user_login;?> 邮箱:<?php echo $user_data->user_email;?> (请确认是你的账号后再购买)
            </td>
          </tr>
          <tr>
            <td class="buy_padd buy_zongj" align="right" style="font-family:Arial;" colspan="7"><em style="font-weight:bold"> </em>
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
          								'action'=>"/grouppay/step2",
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
        <input class="btn_submit" type="submit" value="确认支付" >  
        <div class="clear_float"></div>    
      </div> 
         
        <?php $this->endWidget(); ?> 
         
    
   </div><!--//支付方式-->
</div>
<div class="tg_intr_bottom"><img src="<?php echo $cssPath;?>/images/tg_intr_bottom.jpg" /></div>
</div><!--//w750-->
<div class="R-r-right">
                <div class="hot_rec_con">
                	<div class="R_r_title">热门推荐</a><a href="<?php echo $this->createUrl("group/list",array('channel'=>'137','category'=>$content->category_id));?>">更多></a></div>
                    <div class="hot_list">
                        <ul>
                        	<?php BZ::blocks("pattern/group/category/".$model->Group->category_id."/view/recommend_group_block/attr/c/sort/update_time/sort_type/DESC/size/200*127/limit/5/cacheid/recommend_group_".$model->Group->category_id);?>
                         
                        </ul>
					         </div>
                </div><!--hot_list end-->
                
               <div class="contact_us"><!--商家信息-->
         <div class="R_r_title">商家信息</div>
               <div class="map_info"><!--地图-->
               		<?php
  		
      				if($this->beginCache("WBaiduMaps", array('duration'=>"1"))){
                  $this->widget('WBaiduMaps', array( 
                     'coordinate'=>$model->Group->Company->coordinate, 
                     'address'=>$model->Group->Company->address          
              	  )); 
             		$this->endCache(); 
       			  }        
       			?>
               </div><!--//地图-->
               <div class="adr_info"><!--地址信息-->
                  <p>商家名称：<?php echo $model->Group->Company->company_name;?></p>
                  <p>地址：<?php echo $model->Group->Company->address;?></p>
                  <p>电话：<?php echo $model->Group->Company->telephone;?></p>
                  <p>交通指南：<?php echo $model->Group->Company->traffic;?></p>
               </div><!--//地址信息-->
      </div><!--//商家信息-->
  </div>
</div>
<div class="clear_float"></div>
</div><!--main_con end-->