<div class="main_con">
<div class="w750">
<div class="tg_intr_top"><img src="<?php echo $cssPath;?>/images/tg_intr_top.jpg" /></div>
<div class="tg_intr_center">
   <div class="tg_buy_top"><img src="<?php echo $cssPath;?>/images/tj_sanbu3.gif" /></div>
   <div class="buy_out">
          <?php $this->widget("FlashInfo");?>
         <p><span class="pay_title">产品名称：</span><a  href="<?php echo $this->createUrl("hotels/show",array("id"=>$model->Hotels->id));?>" target="_blank"><?php echo $model->Hotels->title;?></a></p> 
         <p><span class="pay_title">应付总额：</span>¥<?php echo $model->total_price;?>元 </p>
         <p><span class="pay_title">支付方式：</span><?php  $payment_type=CV::$travel_payment_type; $bank_data=$payment_type[$banker]; echo $bank_data['name']; ?></p>
         <?php 
            switch($pay_data->type){
            	case 'coupon':
            	  $user=User::model();
            	  $user_data=$user->findByPk(Yii::app()->user->id);
            	  echo '<p><span class="pay_title">账户余额：'.$user_data->conpon.'</span></p>';
            	  break;
              default:
                break;
            }

         ?>
         <?php if($pay_data->type=="coupon"){
         	
         	$form=$this->beginWidget('EActiveForm', array(
	        								'id'=>'pay_form',
          								'action'=>"/hotelspay/step3",
	        								'enableAjaxValidation'=>false,
	        								'htmlOptions'=>array(),
         							));
         							echo CHtml::hiddenField("action","coupon",array());
         							echo CHtml::hiddenField("order_id",$model->id,array());
         							echo CHtml::hiddenField("pay_id",$pay_data->id,array());
         	
         ?>
              
              <div class="order_commit">
              	<p><span class="pay_title">*请输入支付密码：<input type="password" class="inp-txt" name="pay_password"/></span></p>
        				<div class="clear_float"></div>
        				<input class="btn_submit" type="submit" value="确认支付" >  
        				<div class="clear_float"></div>    
      				</div> 
      				
       <?php 
            $this->endWidget();
       }else{
       	
       	 ?>
        <div class="order_commit">
             <?php echo $pay_online;?>
             <div class="clear_float"></div>    
        </div>
      <?php } ?>
   </div><!--//buy_out-->
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