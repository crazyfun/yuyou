<?php 
  $images_category=ImagesCategory::model();
  $category_select=$images_category->get_select('0');
  $category_select=Util::com_search_item(array('图片分类'),$category_select);
?>
<div id="page_content">
    <div class="show_right_content">
    	<div class=""><div class="user_operate_content"></div></div> 
      <!--搜索操作-->  
       <div class="search_content">
       	<?php 
    		  $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'',
          'action'=>"",
	        'enableAjaxValidation'=>false,
	       
         ));
        ?>
       	   <div class="search_item"><span class="search_item_name">图片名称:</span><span class="search_item_input"><?php echo EHtml::createText("name",$page_params['name'],array());?></span></div>
       	   <div class="search_item"><span class="search_item_name">图片分类:</span><span class="search_item_input"><?php echo EHtml::createSelect("category_id",$page_params['category_id'],$category_select,array());?></span></div>
           <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div>
       <?php $this->endWidget(); ?>
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
                
           
       	   	  		$this->widget('zii.widgets.CListView',array(
												'dataProvider'=>$dataProvider,
												'itemView'=>'images_item',
												'ajaxUpdate'=>false,
									));
						
                
              $this->endWidget();
             ?>
         	<!--显示内容列表end-->
       	  </div>
      </div>
   </div>
</div>
 <script language="javascript">
    	   var s_select_images=new Array();
    	   jQuery(document).ready(function(){
    	   	  s_select_images=self.parent.select_images;
    	   	  jQuery(".select_travel_image").each(function(){
    	   	  	var image_id=jQuery(this).attr("id");
    	   	  	if(s_select_images.find_value(image_id)){
    	   	  		jQuery(this).attr("checked",true);
    	   	  	} 
            });
            jQuery(".select_travel_image").bind("click",function(){
            	   var checked_flag=jQuery(this).attr("checked");
            	   var image_id=jQuery(this).attr("id");
            	   var push_key=self.parent.select_images.find_value(image_id);
            	   if(checked_flag){
            	      	if(!push_key){
            	      		self.parent.select_images.push(image_id);
            	      	}
            	   }else{
            	   	if(push_key){
            	      		self.parent.select_images.splice(push_key-1,1);
            	      	}
            	      	
            	   }
            	   
            });
    	   });
    	
    </script>