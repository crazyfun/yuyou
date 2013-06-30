<div id="page_content">
    <div class="show_right_content">
    <!--用户操作-->
    	<div><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("permissions/index");?>">返回到权限管理</a></span></div></div>
    <!--用户操作end-->
    <!--编辑框-->	
    	<div class="edit_content">
    		<?php 
    		  $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'',
          'action'=>"",
	        'enableAjaxValidation'=>false,
         ));
         echo $form->hiddenField($model,"id");
        ?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           <div class="content_title"><?php if($model->id) echo "修改权限"; else echo "添加权限"; ?></div>
           <div class="content_inline"><div class="content_name">权限名:</div><div class="content_content"><?php echo $form->textField($model,"permissions_name",array());?></div><div class="content_error"><?php echo $form->error($model,'permissions_name'); ?></div></div>
	         <div class="content_inline"><div class="content_name">权限值:</div><div class="content_content">
	         <?php if(Yii::app()->user->id==CV::SUPER_USER){
	         	   $this->widget('PermissionsVars', array(
  	  	  	        'menu'=>$model->get_admin_permissions(),
	                  'permissions_value'=>$model->permissions_value,
	               ));
	          }else{
	          	 $this->widget('PermissionsVars', array(
  	  	  	        'menu'=>$model->get_user_permissions(),
	                  'permissions_value'=>$model->permissions_value,
	               ));
	          }
	         ?>	
	         	    
	         </div><div class="content_error"><?php echo $form->error($model,'permissions_value'); ?></div></div>
	         <div class="content_button"><input type="submit" class="input_submit" value="确定" name="button_ok"/><input type="reset" class="input_cancel" value="取消" name="button_reset"/></div>
	   
    	<?php $this->endWidget(); ?>
    	</div>
    	 <!--编辑框end-->	
    </div>
</div>
    
    



    
    
    
    
    



