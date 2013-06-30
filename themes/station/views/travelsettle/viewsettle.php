<div id="page_content">
    <div class="show_right_content">
    <!--用户操作-->
    	<div><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("travelsettle/index");?>">返回到结算管理</a></span></div></div>
    <!--用户操作end-->
    <!--编辑框-->	
    	<div class="edit_content">
    		<?php 
    		  $company_id=$travel_order_data->company_id;
    		  $company=Company::model();
    		  $company_data=$company->findByPk($company_id);
    		  $form=$this->beginWidget('EActiveForm', array(
	        'id'=>'',
          'action'=>"",
	        'enableAjaxValidation'=>false,
         ));
         echo $form->hiddenField($model,"id");
         echo $form->hiddenField($model,"order_id");
         echo CHtml::hiddenField("order_id",$model->order_id,array());
        ?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           <div class="content_inline"><div class="content_name">结算公司:</div><div class="content_content"><?php echo $company_data->company_name;?></div><div class="content_error"></div></div>
           <div class="content_inline"><div class="content_name">公司地址:</div><div class="content_content"><?php echo $company_data->address;?></div><div class="content_error"></div></div>
           <div class="content_inline"><div class="content_name">联系人:</div><div class="content_content"><?php echo $company_data->contact;?></div><div class="content_error"></div></div>
           <div class="content_inline"><div class="content_name">联系电话:</div><div class="content_content"><?php echo $company_data->contact_phone;?></div><div class="content_error"></div></div>
           <div class="content_inline"><div class="content_name">公司座机:</div><div class="content_content"><?php echo $company_data->telephone;?></div><div class="content_error"></div></div>
           <div class="content_inline"><div class="content_name">银行名称:</div><div class="content_content"><?php echo $company_data->bank_name;?></div><div class="content_error"></div></div>
           <div class="content_inline"><div class="content_name">户名:</div><div class="content_content"><?php echo $company_data->bank_owner;?></div><div class="content_error"></div></div>
           <div class="content_inline"><div class="content_name">银行帐号:</div><div class="content_content"><?php echo $company_data->bank_account;?></div><div class="content_error"></div></div>
           <div class="content_inline"><div class="content_name">结算银行流水号:</div><div class="content_content"><?php echo $model->out_serial;?></div><div class="content_error"></div></div>
           <div class="content_inline"><div class="content_name">订单总价:</div><div class="content_content"><?php echo $travel_order_data->get_total_price($travel_order_data->id);?></div><div class="content_error"></div></div>
           <div class="content_inline"><div class="content_name">总结算:</div><div class="content_content"><?php echo $travel_order_data->get_total_settle_price($travel_order_data->id);?></div><div class="content_error"></div></div>
           <div class="content_inline"><div class="content_name">结算状态:</div><div class="content_content"><?php echo $model->show_attribute("status");?></div><div class="content_error"></div></div>
           <div class="content_inline"><div class="content_name">备注:</div><div class="content_content"><?php echo $model->show_attribute("comment");?></div><div class="content_error"></div></div>
	         <?php if($model->status=='2'){ ?>
	           <div class="content_button"><input type="submit" class="input_submit" value="确认结算" name="button_ok"/></div>
	         <?php }?>
    	<?php $this->endWidget(); ?>
    	</div>
    	 <!--编辑框end-->	
    </div>
</div>
    
    



    
    
    
    
    



