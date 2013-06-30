<div id="page_content">
    <div class="show_right_content">
    	<?php if(!empty($user_operate)){ ?>
    	<!--用户操作-->
    	<div class=""><div class="user_operate_content"><?php echo $user_operate; ?></div></div> 
    	<!--用户操作end--> 
      <?php } ?>
      <!--搜索操作-->  
       <div class="search_content">
       	<?php
           echo CHtml::beginForm("","post",array());
		       foreach($search_datas as $key => $value){
		    ?>
			       <div class="search_item" <?php if($value['type']=="hidden") echo "style='display:none;'" ?>><span class="search_item_name"><?php echo $value['name'];?>:</span><span class="search_item_input"><?php if($value['type'] == 'multitext') EHtml::selectCreate($value['type'],$key,$value['select'],$value['value'],$value['htmlOptions']);else echo EHtml::selectCreate($value['type'],$key,$value['select'],$value['value'],$value['htmlOptions']); ?></span></div>
		    <?php } ?>
		         
		         <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div>
		   <?php 
	         echo CHtml::endForm();
		   ?>  
       </div>
       <!--搜索操作end-->  
       <div class="show_search_content">
       	<!--显示内容列表-->
       	   <div class="show_search_text">
            <?php 
       	   	     $form=$this->beginWidget('CActiveForm', array(
	        					'id'=>'lists-form',
          					'action'=> '',
          					'htmlOptions'=>array('onsubmit'=>'javascript:return false;'),//'enctype'=>'multipart/form-data'
	        					'enableAjaxValidation'=>false,
       					  ));  
                $this->widget('zii.widgets.grid.CGridView',$dataProvider); 
              $this->endWidget();
             ?>
             <?php if(!empty($operates)){ ?>
             <div class="operate_all"><?php echo $operates;?></div>
           <?php } ?>
         	<!--显示内容列表end-->
       	  </div>
      </div>
   </div>
</div>