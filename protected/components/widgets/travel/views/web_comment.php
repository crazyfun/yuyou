
 <?php echo CHtml::beginForm(
             $this->controller->createUrl("/comment/comment/comments"),
             "POST",
             array("id"=>'modelcomment','onsubmit'=>'return false;'));
   ?>          		
          		<input type="hidden" name="action" value="comment"/>
        			<input type="hidden" name="model_id" value="<?php echo $model_id;?>"/>
        			<input type="hidden" name="content_id" value="<?php echo $content_id;?>"/>
        			<input type="hidden" name="level" value="<?php echo $level;?>"/>
       			  <input type="hidden" name="user_flag" value="<?php echo $user_flag;?>"/>
               <?php if($input_type=="textarea"){
           							echo EHtml::selectCreate($input_type,"content",'',array(),array('class'=>'comment'));
        						}else{ 
      	   							EHtml::selectCreate($input_type,"content",'',array(),array('toobar'=>'Comments','class'=>'comment'));
         						} 
      				?>
      
      
                <div class="rev_bntbox"><!--按钮-->

      <?php if($this->user_flag){
      	     if(Yii::app()->user->isGuest){ 
      ?>
              <input type="button" class="rev_b1" onclick="javascript:pop_no_pay_login();" value="登录"/>
      <?php }else{ ?>
              <input type="button" class="rev_b1" onclick="javascript:submit_comments('modelcomment');" value="发表评论"/>
      <?php } ?>
      
     <?php }else{     
     ?>
             <input type="button" class="rev_b1" onclick="javascript:submit_comments('modelcomment');" value="发表评论"/>
      <?php       	
      	    }
      ?> 
                </div>
   <?php echo CHtml::endForm();?> 
                
                <div class="reply" id="comments_datas"><!--回复-->
                	
                </div>
                <!--end 回复-->
 <script language="javascript">
    var model_id="<?= $model_id ?>";
    var content_id="<?= $content_id ?>";
    var level="<?= $level ?>";
    var user_flag="<?= $user_flag ?>";
 	  var comments_obj="";
 	  jQuery(document).ready(function(){
 		  comments_obj=new comments(model_id,content_id,level,user_flag,"comments_datas");
 	  });
 	  function submit_comments(conmments_form){
		  comments_obj.comment(conmments_form)
	  } 
 </script>