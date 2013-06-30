<div class="main_con">
<div class="w750">
<div class="tg_intr_top"><img src="<?php echo $cssPath;?>/images/tg_intr_top.jpg" /></div>
<div class="tg_intr_center">
   <div class="tg_buy_top"><img src="<?php echo $cssPath;?>/images/tj_sanbu3.gif" /></div>
   <div class="buy_out">
          <?php $this->widget("FlashInfo");?>
         <p><span class="pay_title">产品名称：</span><a  href="<?php echo $this->createUrl("group/show",array("id"=>$model->Group->id));?>" target="_blank"><?php echo $model->Group->title;?></a></p> 
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
          								'action'=>"/grouppay/step3",
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