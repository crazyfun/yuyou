
<?php
	Yii::app()->clientScript->registerScriptFile('/js/mlselection.js'); 
	$regions=Util::com_search_item(array(''=>'请选择区域'),$regions);
?>
<div class="main_con">
<div class="change_city_con">
            <div class="hotcities">
                <p class="enter_city">进入<a href="<?php echo $this->createUrl("region/set",array('region_id'=>$current_region['id'],'action'=>'select'));?>"><?php echo $current_region['name'];?><span>»</span></a>
                </p><p class="show_hot_city">
                    <span>
                        热门城市：
                        <a href="<?php echo $this->createUrl("region/set",array('region_id'=>'284','action'=>'select'));?>">武汉</a>
                   </span>
                </p>
            </div>

            <div class="province">
            	<div class="province_select_type">
            	  <?php
	  $form=$this->beginWidget('EActiveForm', array(
	        'id'=>'',
          'action'=>$this->createUrl("region/set"),
	        'enableAjaxValidation'=>false,
	        'htmlOptions'=>array('id'=>'','enctype'=>'multipart/form-data'),
         ));
         echo EHtml::createHidden("action",'select',array());
  ?>
            	<span>按省份选择：</span>	

            	<div id="region">
	    						<input type="hidden" name="region_id" value="" id="region_id" class="mls_id" />
	    						<input type="hidden" name="region_name" value="" class="mls_names" />
	   						<?php echo EHtml::createSelect("select_region",'',$regions,array('onchange'=>'javascript:hide_error();'));?>    	           
	        
							</div>
							<input type="submit" class="select_type_submit" value="确定">
						
 <?php $this->endWidget(); ?>  
              </div>
              <div class="province_select_type">             
  <?php
	  $form=$this->beginWidget('EActiveForm', array(
	        'id'=>'',
          'action'=>$this->createUrl("region/set"),
	        'enableAjaxValidation'=>false,
	        'htmlOptions'=>array('id'=>'','enctype'=>'multipart/form-data'),
         ));
          echo EHtml::createHidden("action",'input',array());
  ?>
               <span>或直接输入：</span>	
               <?php echo EHtml::createText("region_name",'',array());?>
                <input type="submit" class="select_type_submit" value="确定">
   <?php $this->endWidget(); ?>
              </div>
            </div>

            <div class="citieslist">
            	<h2>
            		按拼音首字母选择
            		<span class="arrow">»</span>
            	</h2>
            </div>
            <div class="show_citieslist">
                <ul class="region_ul">
                	
                	 <?php foreach($region_datas as $key => $value){
	 	  								$children=$value['children'];
	 	  								if(!empty($children)){
	 									?>
	 	  							<li>
	 	  								  <p>
	 	  								  <label><strong><?php echo ucfirst($value['name']);?></strong></label>
	 	  								  <span>
	 	    								<?php foreach($children as $key1 => $value1){?>
	 	        								<?php echo CHtml::link($value1['name'],$this->createUrl("region/set",array('region_id'=>$value1['id'],'action'=>'select')),array());?>
        								<?php } ?>
        								</span>
	 	  	                </p>
	 	  							</li>
	 	
	 									<?php
	 											}} 
	 									?>
  
                </ul>
            </div>
    	</div>
   </div> 	
    	<script language="javascript">
    		jQuery(function(){
    			regionInit("region");
    			jQuery(".region_ul>li").hover(function(){jQuery(this).addClass("li_hover");},function(){jQuery(this).removeClass("li_hover");});
    	  });
        function hide_error(){
          jQuery('#region').find('.error').hide();
        }
      </script>