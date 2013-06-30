<div class="main_con">
<div class="w750">
<div class="tg_intr_top"><img src="<?php echo $cssPath;?>/images/tg_intr_top.jpg" /></div>
<?php 
    		 							$form=$this->beginWidget('EActiveForm', array(
	        								'id'=>'',
          								'action'=>"",
	        								'enableAjaxValidation'=>false,
	        								'htmlOptions'=>array('id'=>'registe_from'),
         							));
         							echo EHtml::createHidden($id,$model->id,array());
         							echo EHtml::createHidden("action","save",array());
        					?>
<div class="tg_intr_center">
   <div class="tg_buy_top"><img src="<?php echo $cssPath;?>/images/tj_sanbu.gif" /></div>
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
            <td class="buy_padd"><a target="_blank" title="<?php echo $model->title;?>" href="<?php echo $this->createUrl("group/show",array('id'=>$model->id));?>"><?php echo $model->title;?></a></td>
            <td></td>
            <td align="center"><input id="order_amount" price="<?php echo $model->price;?>" class="buy_wbkuang" type="text" value="1" autocomplete="off" name="amount"></td>
            <td class="buy_fontz" align="center" >×</td>
            <td class="buy_fontz0" align="center">¥<span id="price"><?php echo $model->price;?></span></td>
            <td class="buy_fontz" align="center">=</td>
            <td class="buy_fontz0" align="center">¥<span id="total_money_no_cf">  </span></td>
          </tr>
          <tr>
            <td colspan="7" class="msg_er">
            	&nbsp;&nbsp;<?php echo $form->error($group_order,"amount"); ?>
            </td>
         </tr>
          <tr>
            <td class="buy_padd buy_zongj" align="right" colspan="7"><em style="font-weight:bold"> </em>
                 总额：¥<span id="total_money" class="buy_redzi"></span>
            </td>
         </tr>
       </tbody>
     </table>
   </div><!--//buy_out-->
   <div class="buy_phone"><table width="100%" border="0">
  <tr>
    <td width="11%"><strong>您的手机</strong></td>
    <td width="60%">&nbsp;</td>
    <td width="19%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="color:#ff0000;">为了方便您的操作请填写正确的手机号码</td>
    <td></td>
  </tr>
  <tr>
    <td height="31">手机号码：</td>
    <td><label style="float:left;">
    	<input type="text" value="<?php echo $user_data->cell_phone;?>" name="cell_phone"/>
      
    </label></td>
    <td class="msg_er"><?php echo $form->error($group_order,"cell_phone"); ?></td>
  </tr>
</table>
</div>
   <div class="buy_bigbut"><input class="buy_buttonbig" type="submit"  value="" name=""></div><!--//按钮-->
</div>
<?php $this->endWidget(); ?> 
<div class="tg_intr_bottom"><img src="<?php echo $cssPath;?>/images/tg_intr_bottom.jpg" /></div>
</div><!--//w750-->
<div class="R-r-right">
                  <div class="hot_rec_con">
                	<div class="R_r_title">热门推荐</a><a href="<?php echo $this->createUrl("group/list",array('channel'=>'137','category'=>$content->category_id));?>">更多></a></div>
                    <div class="hot_list">
                        <ul>
                        	<?php BZ::blocks("pattern/group/category/".$model->category_id."/view/recommend_group_block/attr/c/sort/update_time/sort_type/DESC/size/200*127/limit/5/cacheid/recommend_group_".$model->category_id);?>
                         
                        </ul>
					         </div>
                </div><!--hot_list end-->
                
       <div class="contact_us"><!--商家信息-->
         <div class="R_r_title">商家信息</div>
               <div class="map_info"><!--地图-->
               		<?php
  		
      				if($this->beginCache("WBaiduMaps", array('duration'=>"1"))){
                  $this->widget('WBaiduMaps', array( 
                     'coordinate'=>$model->Company->coordinate, 
                     'address'=>$model->Company->address          
              	  )); 
             		$this->endCache(); 
       			  }        
       			?>
               </div><!--//地图-->
               <div class="adr_info"><!--地址信息-->
                  <p>商家名称：<?php echo $model->Company->company_name;?></p>
                  <p>地址：<?php echo $model->Company->address;?></p>
                  <p>电话：<?php echo $model->Company->telephone;?></p>
                  <p>交通指南：<?php echo $model->Company->traffic;?></p>
               </div><!--//地址信息-->
      </div><!--//商家信息-->
  </div>
  </div>

<div class="clear_float"></div>
</div><!--main_con end-->


<script language="javascript">
	jQuery(function(){
		  cul_total_price();
		  jQuery("#order_amount").bind("change",function(){
		  	
		  	cul_total_price();
		  });
		  
		  
		  
		
	});
	
	function cul_total_price(){
		var order_amount=jQuery("#order_amount");
		var price=order_amount.attr("price");
		var nums=order_amount.val()||0;
		var total_price=parseFloat(price)*parseFloat(nums);
		jQuery("#total_money_no_cf").html(total_price);
		jQuery("#total_money").html(total_price);
	}
	
</script>