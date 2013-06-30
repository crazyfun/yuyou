<div id="page_content">
    <div class="show_right_content">
    	<div class=""><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("travelcompany/index",array('travel_id'=>$model->travel_id));?>">返回到报名地点列表</a></span></div></div> 
      <!--搜索操作-->  
       <div class="search_content">
       	<?php 
    		  $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'',
          'action'=>"",
	        'enableAjaxValidation'=>false,
	       
         ));
        ?>
       	   <div class="search_item"><span class="search_item_name">公司名称/地址:</span><span class="search_item_input"><?php echo EHtml::createText("company_name",$page_params['company_name'],array());?></span></div>
       	   <div class="search_item"><span class="search_item_name">所属区域:</span><span class="search_item_input"><?php echo EHtml::createAjaxselect("region_id",$page_params['region_id'],array('title'=>'可直接选择城市或输入城市','text_value'=>$page_params['region_id_text'],'type_value'=>'region','tabs'=>"[{'name':'城市','url':'/api/region','id':'','type':'region'}]",'serviceUrl'=>"/api/mixregion",'multi'=>false,'level'=>3));?></span></div>
           <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div>
       <?php $this->endWidget(); ?>
       </div>
       <!--搜索操作end-->  
       <div class="show_search_content">
       	   <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
       	   
       	<!--显示内容列表-->
       	<?php 
       	   	     $form=$this->beginWidget('CActiveForm', array(
	        					'id'=>'lists-form',
          					'action'=> '',
          					'htmlOptions'=>array(),//'enctype'=>'multipart/form-data'
	        					'enableAjaxValidation'=>false,
       					  ));  
                
                  echo $form->hiddenField($model,"travel_id",array());
            ?>
       	   <div class="show_search_text">
           <?php 
  $this->widget('zii.widgets.grid.CGridView',array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
            array('class'=>'CCheckBoxColumn',
                  'name'=>'id',
                  'value'=>'$data->id',
                  'selectableRows' => 2,
                  'checkBoxHtmlOptions' =>array('name'=>'company_id[]','class'=>'company_id'),
            ),
            array(
                'name'=>'company_name',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_attribute("company_name")',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
             array(
                'name'=>'region_id',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_attribute("region_id")',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),

            array(
                'name'=>'address',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_attribute("address")',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
             array(
                'name'=>'contact',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_attribute("contact")',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
            array(
                'name'=>'telephone',
                'type'=>'raw',
                'value'=>'$data->show_attribute("telephone")',
             
            ),
           
    ),
    'ajaxUpdate'=>true,
    )); 
?> 
         	<!--显示内容列表end-->
       	  </div>
       	  <div class="content_button"><input type="submit" class="input_submit" value="确定" name="button_ok"/></div>
          <?php $this->endWidget(); ?>
      </div>
   </div>
</div>
<script language="javascript">
	jQuery(function(){
		 jQuery("#check_all").bind("click",function(){
		 	  var check_flag=jQuery(this).attr("checked");
		 	  if(check_flag){
		 	  	jQuery(".company_id").attr("checked",true);
		 	  }else{
		 	  	jQuery(".company_id").attr("checked",false);
		 	  }
		 	
		});
		
	});
	
</script>


