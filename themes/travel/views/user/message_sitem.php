 <tr class="<?php if($data->status=='1'){ echo "new_message";}?>" id="message_item_<?php echo $data->id;?>">
    <td class="checkbox_toggle"><input type="checkbox" name="ids[]" value="<?php echo $data->id;?>"  class="check_ids" status="<?php echo $data->status;?>" /></td>
    <td class="msg_icon">
    	<?php if($data->status=='1'){?>
    	   <img src="/themes/default/css/images/icon1.png" />
    	<?php }else{ ?>
    		 <img src="/themes/default/css/images/icon2.png" />
    	<?php } ?>
    </td>
    <td class="profile_pic"><img src="<?php echo UC_API; ?>/avatar.php?uid=<?php echo $data->user_id;?>&size=small&rand=<?php echo time();?>" id="avatar" /></td>
    <td class="name_and_date"><span class="notname1">至:<?php echo $data->SendUser->user_login;?> </span><span class="notdate"><?php echo date("Y-m-d H:i:s",$data->create_time);?></span> </td>
    <td class="subject">
      <DIV class="subject_wrap"><a class="subject_text" href="<?php echo $this->createUrl("user/messageshow",array('id'=>$data->id,'type'=>$type));?>"><?php echo $data->title;?></a></div>
    </td>
    <td class="delete_msg"><a  href="javascript:delete_message('<?php echo $data->id;?>');">&nbsp;</a> </td>
</tr>
   
