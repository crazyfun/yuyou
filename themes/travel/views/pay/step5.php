<?php
			$company=Company::model();
      $company_data=$company->findByPk($model->company_id);
?>		
<div class="main_con">
  	<div class="order_top order_top5"></div>
    <div class="ord_hintbox ord_info">
    	   <?php $this->widget("FlashInfo");?>
         <p><span class="pay_title">线路名称：</span><a  href="<?php echo $this->createUrl("travel/show",array("id"=>$model->Travel->id));?>" target="_blank"><?php echo $model->Travel->title;?></a></p> 
         <p><span class="pay_title">出发时间：</span><?php echo $model->travel_date;?> </p>
         <p><span class="pay_title">应付总额：</span>¥<?php echo $model->total_price;?>元 </p>
         <p><span class="pay_title">支付方式：</span><?php  $payment_type=CV::$travel_payment_type; $bank_data=$payment_type[$banker]; echo $bank_data['name']; ?></p>
         <p><span class="pay_title">门市名称：</span><?php echo $company_data->company_name;?></p>
         <p><span class="pay_title">门市地址：</span><?php echo $company_data->address;?></p>
         <p><span class="pay_title">联系方式：</span><?php echo $company_data->telephone;?></p>
         <?php 
            switch($pay_data->type){
            	case 'coupon':
            	  $user=User::model();
            	  $user_data=$user->findByPk(Yii::app()->user->id);
            	  echo '<p><span class="pay_title">账户余额：'.$user_data->conpon.'</span></p>';
            	  break;
            	case 'huikuan':
            	  $company=Company::model();
            	  $company_data=$company->findByPk($model->company_id);
            	  echo '<p><span class="pay_title">银行帐号：银行名称:'.$company_data->bank_name.',帐户名:'.$company_data->bank_owner.',银行帐号:'.$company_data->bank_account.'</span></p>';
            	  break;
            	case 'menshi':
            	  break;
            }

         ?>
         <?php if($pay_data->type=="coupon"){
         	
         	$form=$this->beginWidget('EActiveForm', array(
	        								'id'=>'pay_form',
          								'action'=>"/pay/step5",
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
         	
         	
         	
        
    </div><!--//ord_hintbox-->
      
</div>
             
              