   <?php   
      Yii::app()->clientScript->registerCssFile('/js/poshytip/tip-yellow/tip-yellow.css');
      Yii::app()->clientScript->registerScriptFile('/js/poshytip/jquery.poshytip.min.js');
      
      $company_id=$model->Travel->company_id;
      $company=Company::model();
      $company_data=$company->findByPk($company_id);
      
      
   ?>	
<div class="main_con">
	<div class="order_top order_top4"></div>
    <div class="ord_hintbox">
    	  <a class="ord_hintbox_prolink" href="<?php echo $this->createUrl("travel/show",array("id"=>$model->Travel->id));?>" target="_blank"><?php echo $model->Travel->title;?></a>
       
        <span class="price">应付总额：<strong>¥<?php echo $model->total_price;?></strong>元</span>
     <div class="clear_float"></div>   
    </div><!--//ord_hintbox-->
    <div class="ord_tipbox">
       <div class="atr_pay_hint">
          <span>您的订单已提交成功.</span>
          <?php 
             $travel_attr=explode(",",$model->Travel->attr);
             $status=$model->status;
             if(!in_array("p",(array)$travel_attr)){
             	  if($status=='2'){
          ?>
                 <p>此产品已经进行了资源确认请放心支付，支付成功后系统会把订单号以短信的方式通知您。</p>
        <?php }else{ ?>
                 <p>我们将尽快确认资源，以手机短信的形式通知到您，请耐心等待，您也可以进行<a id="yuyuequan" title="1、在您进行预授权后，一旦产品资源得到确认，您的订单款项将自动扣除，即订单支付成功。</br>2、若您预订的产品资源无法确认，则您授权的预授权返回您的银行账户，无需您任何操作及手续费。" href="#">预授权</a>。资源确认前请不要关闭此页面，确认后重新刷新此页面完成预定。</p>
         <?php } ?>
          
        <?php }else{ ?>
           <p>此产品支持在线预定，支付成功后系统会把订单号以短信的方式通知您。</p>
        <?php } ?>
          <ul class="atr_pay_listtxt">
             <li>• 您可在<a target="_blank" href="<?php echo $this->createUrl("user/travelorder");?>">我的线路订单</a>中查看订单状态</li>
          </ul>
         </div>
    </div><!--//ord_tipbox-->
							<?php 
    		 							$form=$this->beginWidget('EActiveForm', array(
	        								'id'=>'pay_form',
          								'action'=>"/pay/step4",
	        								'enableAjaxValidation'=>false,
	        								'htmlOptions'=>array(),
         							));
         							echo CHtml::hiddenField("action","order",array());
         							echo CHtml::hiddenField("order_id",$model->id,array());
        			?>
  <?php if($model->status!='2'){ ?>
    <div class="o_con_tab">
    	<?php $this->widget("FlashInfo");?>
    <div id="hotnews_caption">
       <ul>
         <li class="current" onclick="secBoard('hotnews_caption','list',1);">在线支付</li>
         <li class="normal" onclick="secBoard('hotnews_caption','list',2);">电话预约</li>
       </ul>
    </div><!--//标题-->
    <div id="hotnews_content">
      
      <div class="current" id="list_1">
      	
      	
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
                    	     	$pay_lists=array('huikuan','menshi');
                    	    }else{
                    	    	$pay_lists=array('huikuan','menshi');
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
      
      </div><!--//内容一-->
    <?php } ?>
      
    <div class="normal" id="list_2">
        <ul class="ord_step_hint">
           <li class="ord_step_cont">提交订单，并致电客服（<?php echo $company_data->telephone;?>）并告知订单号</li>
           <li class="ord_step_arrow"></li>
           <li class="ord_step_cont">客服人员在核实您的个人信息后，帮您确认资源</li>
           <li class="ord_step_arrow"></li>
           <li class="ord_step_cont">资源确认后您可以在线支付完成预定</li>
        </ul>
    </div><!--//内容二-->
<div class="clear_float"></div>  
    </div>
  <script type="text/javascript">
    function secBoard(elementID,listName,n) {
    	var elem = document.getElementById(elementID);
    	var elemlist = elem.getElementsByTagName("li");
    	for (var i=0; i<elemlist.length; i++) {
    		elemlist[i].className = "normal";
    		var m = i+1;
    		document.getElementById(listName+"_"+m).className = "normal";
    	}
    	elemlist[n-1].className = "current";
    	document.getElementById(listName+"_"+n).className = "current";
    }
  </script>   
    </div><!--//o_con_tab-->
<?php $this->endWidget(); ?>

    
</div><!--main_con end-->

<script language="javascript">
	jQuery(function(){
		
		jQuery('#yuyuequan').poshytip();
	});
</script>