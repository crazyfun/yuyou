<div id="page_content">
    <div class="show_right_content">
    <!--用户操作-->
    	<div class=""><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("webpayments/index");?>">返回到支付方式管理</a></span></div></div>
    <!--用户操作end-->
    <!--编辑框-->	
    	<div class="edit_content">
    		<div class="setting_menu"><ul class="tab_menu"><li class="menu_item menu_item_active" index='1'>支付宝</li><li class="menu_item" index='2'>快钱</li></ul></div>
    		<div id="menu_content_1" class="menu_content" style="display:block">
    		   <?php $form_bsc = $this->beginWidget('CActiveForm', array('id'=>'webpayments','action'=>"",'enableAjaxValidation'=>false,));
    		         echo CHtml::hiddenField("pay_id",$alipay->pay_id,array());
    		         echo CHtml::hiddenField("action","alipay",array());
    		    ?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
          
           <div class="content_inline">
           	 <div class="content_name">支付名称</div>
           	 <div class="content_content"><?php echo CHtml::textField("pay_name",$alipay->pay_name,array());?></div>
           	 
           </div>
           
          
           
           
           <div class="content_inline">
           	 <div class="content_name">支付描述</div>
           	 <div class="content_content"><?php echo CHtml::textArea("pay_desc",$alipay->pay_desc,array());?></div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">帐号</div>
           	 <div class="content_content"><?php echo CHtml::textField("config[alipay_account]",$alipay_config['alipay_account'],array());?></div>
           </div>
           
           
           <div class="content_inline">
           	 <div class="content_name">校验码</div>
           	 <div class="content_content"><?php echo CHtml::textField("config[alipay_key]",$alipay_config['alipay_key'],array());?></div>
           </div>
           
            <div class="content_inline">
           	 <div class="content_name">省份ID</div>
           	 <div class="content_content"><?php echo CHtml::textField("config[alipay_partner]",$alipay_config['alipay_partner'],array());?></div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">接口类型</div>
           	 <div class="content_content"><?php echo CHtml::dropDownList("config[alipay_pay_method]",$alipay_config['alipay_pay_method'],CV::$alipay_pay_method,array());?></div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">手续费</div>
           	 <div class="content_content"><?php echo CHtml::textField("pay_fee",$alipay->pay_fee,array());?></div>
           </div>
           
           
	         <div class="content_button">
	         	 <input type="submit" class="input_submit" value="确定" name="button_ok"/>
	         	 <input type="reset" class="input_cancel" value="取消" name="button_reset"/>
	         </div>
	         <?php $this->endWidget();?>
	       </div>
	       <div id="menu_content_2" class="menu_content">
	         <?php $form_bsc = $this->beginWidget('CActiveForm', array('id'=>'webpayments','action'=>"",'enableAjaxValidation'=>false,));
    		         echo CHtml::hiddenField("pay_id",$kuaiqian->pay_id,array());
    		         echo CHtml::hiddenField("action","kuaiqian",array());
    		    ?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
          
           <div class="content_inline">
           	 <div class="content_name">支付名称</div>
           	 <div class="content_content"><?php echo CHtml::textField("pay_name",$kuaiqian->pay_name,array());?></div>
           	 
           </div>
 
           
           <div class="content_inline">
           	 <div class="content_name">支付描述</div>
           	 <div class="content_content"><?php echo CHtml::textArea("pay_desc",$kuaiqian->pay_desc,array());?></div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">收款帐号</div>
           	 <div class="content_content"><?php echo CHtml::textField("config[kq_account]",$kuaiqian_config['kq_account'],array());?></div>
           </div>
           
           
           <div class="content_inline">
           	 <div class="content_name">商户密钥</div>
           	 <div class="content_content"><?php echo CHtml::textField("config[kq_key]",$kuaiqian_config['kq_key'],array());?></div>
           </div>
        
           
           <div class="content_inline">
           	 <div class="content_name">手续费</div>
           	 <div class="content_content"><?php echo CHtml::textField("pay_fee",$kuaiqian->pay_fee,array());?></div>
           </div>
           
           
	         <div class="content_button">
	         	 <input type="submit" class="input_submit" value="确定" name="button_ok"/>
	         	 <input type="reset" class="input_cancel" value="取消" name="button_reset"/>
	         </div>
	         <?php $this->endWidget();?>
          </div>
          
        
	       
	       
    	  </div>
    	 <!--编辑框end-->	
    </div>
</div>

<script>
	jQuery(function($) {
    togglemenu({'source':"menu_item",'target':"menu_content",'type':'1','effect':'1','effect_time':''});
  }); 

</script>

    
    
    
    



