          <div class="submess_text">
            <h4><?php echo $data['title'];?><span>&nbsp;&nbsp;留言时间：<?php echo $data['create_time'];?></span></h4>
            <div class="message_comment"><?php echo $data['comment'];?></div>
            <div class="messbg">
            	    
                	<div class="messtext">
                		  <div><font color="#ff0000">管理员回复：</font></div>
                    	<?php echo $data['replay'];?>
                    	<div class="m_time">回复时间：<?php echo $data['replay_time'];?></div>
                    </div>
                  
            </div>
          </div>