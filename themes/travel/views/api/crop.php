
  <?php 
      Yii::app()->clientScript->registerCssFile('/js/imagearea/stylish-select.css');
      Yii::app()->clientScript->registerCssFile('/js/imagearea/imgcropper.css');
      Yii::app()->clientScript->registerScriptFile('/js/imagearea/jquery.imgareaselect-0.8.min.js');
      Yii::app()->clientScript->registerScriptFile('/js/imagearea/jquery.stylish-select.min.js');
   ?>
   <div class="im_left">
     <img id="myimg" src="/<?php echo $image_name;?>"/>
   </div>
	 <div class="im_right">
     <div id="viewDiv" style="width:200px;height:200px;overflow:hidden;">
     </div>
     <form method="POST" name="upload_pictrue" id="upload_pictrue">
     	 <input type="hidden" name="image_name" value="<?php echo $image_name;?>"/>
       <input type="hidden" name="crop_x" id="crop_x" value=""/>
       <input type="hidden" name="crop_y" id="crop_y" value=""/>
       <input type="hidden" name="crop_w" id="crop_w" value=""/>
       <input type="hidden" name="crop_h" id="crop_h" value=""/>
       <input type="hidden" id="crop_size" name="crop_size" value="<?php echo $crop_size;?>"/>
       <input type="hidden" id="crop_aspect" name="crop_aspect" value="<?php echo $crop_aspect;?>"/>
       <br/>
       <input style="float:right;" type="submit" name="crop" class="operate_green" value="裁剪"/> 
     </form>
     
   </div>
   <div class="clear_both">
   	
   </div>
   <div class="im_setting">
   	  <div>裁剪比例:<input type="text" name="img_aspect" id="img_aspect" value="<?php echo $crop_aspect;?>"/>&nbsp;&nbsp;裁剪的大小:<input type="text" name="img_size" id="img_size" id="img_size" value="<?php echo $crop_size;?>"/>&nbsp;&nbsp;<input class="operate_green" type="button" onclick="javascript:setting();" value="确定"/></div>
   	  <div class="text_555555">裁剪比例:长宽比，以后在选择时候就会维持不变。e.g. "4:3"。裁剪的大小:裁剪后需要任外等比缩放的尺寸。e.g."400*200,300*100"</div>
   </div>
<script language="javascript">
	  function preview(img, selection){
	    jQuery('#crop_x').val(selection.x1);
	  	jQuery('#crop_y').val(selection.y1);
	  	jQuery('#crop_w').val(selection.width);
	  	jQuery('#crop_h').val(selection.height);
	  	var scaleX = 200/ (selection.width || 1); 
	  	var scaleY = 200/ (selection.height || 1); 
	  	   jQuery('#viewDiv > img').css({ 
	  	   	  width: Math.round(scaleX * parseInt("<?= $image_width ?>")) + 'px', 
		  		  height: Math.round(scaleY * parseInt("<?= $image_height ?>")) + 'px', 
		  		  marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
		  		  marginTop: '-' + Math.round(scaleY * selection.y1) + 'px'
		  	}); 
    }
  
	jQuery(function(){
		  var success_message="<?= $success_message;?>";
		  if(success_message){
		  	window.parent.opener.location.reload();
		  }
	    jQuery("#viewDiv").append(jQuery('<img src="/<?= $image_name ?>"  style="position: relative;" />').css({ 
	    	float: 'left', 
	    	position: 'relative', 
	    	overflow: 'hidden', 
	    	width: '200px', 
	    	height: '200px'
	    })); 
		  jQuery('#myimg').imgAreaSelect({instance: true,aspectRatio: '<?= $crop_size ?>',onSelectChange: preview,handles: true}); 
	});
	
	function setting(){
		 document.getElementById("crop_size").value=document.getElementById("img_size").value;
		 document.getElementById("crop_aspect").value=document.getElementById("img_aspect").value;
		 var aspect=document.getElementById("img_aspect").value;
		 jQuery('#myimg').imgAreaSelect({instance: true,aspectRatio:aspect,onSelectChange: preview,handles: true}); 
	}
</script>

 