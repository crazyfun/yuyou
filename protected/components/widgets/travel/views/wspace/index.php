        <ul>
        <?php foreach($content as $key => $value){ ?>
                           <li> 
                            
                                <a title="<?php echo $value->User->user_login;?>" href="javascript:void(0);" class="rec_img_con" target="_blank"><p><img src="<?php echo UC_API; ?>/avatar.php?uid=<?php echo $value->create_id;?>&size=small&rand=<?php echo time();?>" /></p></a>
                                <p class="hot_rec_p"><a title="<?php echo $value->User->user_login;?>" href="javascript:void(0);" target="_blank"><span><?php echo $value->User->user_login;?></span></a></p>
                          
                            </li>
        <?php } ?> 
      </ul>
