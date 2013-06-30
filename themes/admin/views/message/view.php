<div id="page_content">
    <div class="show_right_content">
    	<div class="edit_content">
    		 
       <div class="tabmenu">
						<ul>
							<li><a href="<?php echo $this->createUrl("message/index",array('type'=>'1'));?>" title="" id="tablink1" class="<?php if($type=='1'){echo "tabactive";}?>">写站内信</a></li>
							<li><a href="<?php echo $this->createUrl("message/index",array('type'=>'2'));?>" title="" id="tablink2" class="<?php if($type=='2'){echo "tabactive";}?>">收件箱</a></li>
							<li><a href="<?php echo $this->createUrl("message/index",array('type'=>'3'));?>" title="" id="tablink3" class="<?php if($type=='3'){echo "tabactive";}?>">发件箱</a></li>
						</ul>
					</div>
					<div class="noticemessage">
                       		  <?php echo $message_data->get_admin_pre_message($type,$message_data->id);?>
                            <h3 class="subject2"><?php echo $message_data->title;?></h3>
                            <?php echo $message_data->get_admin_next_message($type,$message_data->id);?>
                       
        </div>
        <div class="noticemain">
                        	<div class="noticeleft">
                            	 <div class="author_picture"><img src="<?php echo UC_API; ?>/avatar.php?uid=<?php echo $message_data->create_id;?>&size=small&rand=<?php echo time();?>"/></div>
                                <div class="notname1"><?php echo $message_data->User->user_login;?></div>
                                <div class="notdate"><?php echo date("Y-m-d H:i:s",$message_data->create_time);?></div>

                            </div>
                            <div class="noticeright">
                                <div class="noticetitle"><?php echo $message_data->content;?></div>
                                <div class="noticefield">
                               	  
                                  <div class="bnthf"><a href="<?php echo $this->createUrl("message/index",array('type'=>'2'));?>" class="bntsubmit gray">返回收件箱</a></div>
                                </div>
                            </div>	
       </div>
       
       
					</div>
    	 <!--编辑框end-->	
    </div>
</div>