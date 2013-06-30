<div id="page_content">
    <div class="show_right_content">
    	<?php if(!empty($user_operate)){ ?>
    <!--用户操作-->
    	<div class=""><div class="user_operate_content"><?php echo $user_operate ?></div></div>
    <!--用户操作 end-->
    <?php } ?>
    <!--编辑框-->	
    	<div class="edit_content">
    		<?php 
    		  $form=$this->beginWidget('EActiveForm', array('id'=>'','action'=>"",'enableAjaxValidation'=>false,'htmlOptions'=>array('enctype'=>'multipart/form-data')));//'enctype'=>'multipart/form-data');
          echo $form->hiddenField($model,"id");
        ?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           <div class="content_title"><?php if($model->id) echo "修改".$name; else echo "添加".$name; ?></div>
           <?php foreach($add_datas as $key => $value){ ?>
              <div class="content_inline">
              	<?php if($value['type']=="hidden"){
              		 echo $form->selectCreate($value['type'],$model,$key,$value['value'],$value['htmlOptions']);
              	}else{ ?>
              	<div class="content_name"><?php echo empty($value['name'])?$model->getAttributeLabel($key):$value['name'];?>:</div><div class="content_content"><?php if($value['type'] == 'multitext') $form->selectCreate($value['type'],$model,$key,$value['value'],$value['htmlOptions']);else echo $form->selectCreate($value['type'],$model,$key,$value['value'],$value['htmlOptions']); ?><?php echo isset($value['tip'])?$value['tip']:'';?></div>
              	<div class="content_error"><?php echo $form->error($model,$key); ?></div>
              	<?php if(!empty($value['desc'])){ ?>
              	  <br/><div class="content_tip"><?php echo $value['desc'];?></div>
                <?php }
                 } 
                 ?>
             </div>
           <?php } ?>
	         <div class="content_button"><?php echo CHtml::submitButton("submit",array("name"=>"button_ok","id"=>"search_submit","value"=>"确定",'class'=>'input_submit'));?><?php echo CHtml::resetButton("reset",array("name"=>"button_reset","id"=>"search_reset","value"=>"取消",'class'=>"input_cancel"));?><?php echo $operates;?></div>
    	<?php $this->endWidget(); ?>
    	</div>
    	 <!--编辑框end-->	
    </div>
</div>