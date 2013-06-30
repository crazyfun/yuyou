<?php
   $comment_id=$data->id;
   $model_id=$data->model_id;
   $parent_id=$data->parent_id;
   $relation_id=$data->relation_id;
   $comment=$data->comment;
   $create_id=$data->create_id;
   $create_time=$data->create_time;
?>
	                        <div class="reply_left"><!--左边-->
                         		<div class="reply_name"><img src="<?php echo UC_API; ?>/avatar.php?uid=<?php echo $create_id;?>&size=small&rand=<?php echo time();?>" />
                         			<?php if(empty($create_id)){
  	   		  															echo "游客";
  	   	  													}else{
  	   		  															echo "<a href='javascript:void(0);' target='_blank'>".$data->User->user_login."</a>";
  	   															}
  	   												?>
                         			
                         		 </div>
                     		 </div>
                      
                      
                         <div class="reply_right"><!--右边-->
                            <?php $level_flag=$this->get_level_flag($comment_id,$level); 
                         	  		if($level_flag){ 
  		 	                   ?>
                            <div class="reply_top" id="comment_item_<?php echo $comment_id;?>">
                            		  <a href="javascript:comments_obj.view_reply(<?php echo $comment_id;?>);">查看回复(<span id="reply_nums_<?php echo $comment_id;?>"><?php echo count($data->Comments);?></span>)</a>
                            		  <?php if($user_flag){
      	    												     if(Yii::app()->user->isGuest){ 
      														?>
             	
      														<?php }else{ ?>
      														         |<a href="javascript:comments_obj.reply(<?php echo $comment_id;?>);" id="reply_<?php echo $comment_id;?>" class="rely_a">回复</a>
      													  <?php 
      													        } 
      														  }else{     
                                  ?>
                                           |<a href="javascript:comments_obj.reply(<?php echo $comment_id;?>);" id="reply_<?php echo $comment_id;?>" class="rely_a">回复</a>
                                 <?php       	
      	                            }
                                  ?> 
      
                 						 
                            </div>
                          <?php } ?>
                          
                            <div class="reply_date"><?php $sex=CV::$sex;echo $sex[$data->User->genter]?>&nbsp;回复于:<?php echo date("Y-m-d H:i:s",$create_time);?></div>
                            <div class="reply_text">
                            	<?php echo html_entity_decode($comment);?>
                            </div> 
                           
                             <div class="replybox" id="comment_children_<?php echo $comment_id; ?>"><!--回复内容-->

                   	  	
                      			 </div>
                      
                      
                         </div>
                         <div style="clear:both;"></div>


