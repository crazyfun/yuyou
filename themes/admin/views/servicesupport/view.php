<div id="page_content">
    <div class="show_right_content">
    <!--用户操作-->
    	<div class=""><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("servicesupport/index");?>">返回到服务支持列表</a></span></div></div>
    <!--用户操作end-->
    <!--编辑框-->	
    	<div class="edit_content">
    		   
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           <div class="content_inline">
           	 <div class="content_name">标题</div>
           	 <div class="content_content"><?php echo $model->title;?></div>
           	 <div class="content_error"></div>
           </div>

					 <div class="content_inline">
           	 <div class="content_name">类型</div>
           	 <div class="content_content"><?php echo $model->ConfigValues->name;?></div>
           	 <div class="content_error"></div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">提交人</div>
           	 <div class="content_content"><?php echo $model->User->user_login;?></div>
           	 <div class="content_error"></div>
           </div>
           

           
           <div class="content_inline">
           	 <div class="content_name">详细内容</div>
           	 <div class="content_content">
     <?php foreach($support_content_data as $key => $value){ ?>               
          <div class="submess_text">
            <div class="message_comment"><?php echo $value->content;?></div>
            <div class="m_time"><a href="<?php echo $this->createUrl("servicesupport/reply",array('id'=>$value->id));?>">回复</a>&nbsp;&nbsp;<?php if(!empty($value->href)){?><a href="<?php echo $value->href;?>" title="<?php echo $value->href;?>" target="_blank">查看链接</a><?php } ?><?php if(!empty($value->image)){?>&nbsp;&nbsp;<a title="<?php echo $value->image;?>" href="<?php echo "/".$value->image;?>" target="_blank">查看附件</a><?php } ?>&nbsp;&nbsp;提交时间：<?php echo date("Y-m-d H:i:s",$value->create_time);?></div>
           <?php if(!empty($value->reply_content)){ ?>
            <div class="support_messbg">
                	<div class="messtext">
                		  <div><font color="#ff0000"><?php echo $value->ReplyUser->user_login;?>回复：</font></div>
                    	<?php echo $value->reply_content;?>
                    	<div class="m_time">回复时间：<?php echo date("Y-m-d H:i:s",$value->reply_time);?></div>
                    </div> 
            </div>
          <?php } ?>
          </div>
      <?php } ?>
           	 	</div>
           	 <div class="content_error"></div>
           </div>


    	  </div>
    	 <!--编辑框end-->	
    </div>
</div>  

    
    
    
    



