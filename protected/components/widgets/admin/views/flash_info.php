<?php 
    if($type == CV::FAIL){
?>
    <div class="flash_error"><?php echo $flash;?></div>
<?php
    }else if($type == CV::SUCCESS){
?>
    <div class="flash_success"><?php echo $flash;?></div>
<?php
    }else if($type == CV::TIP){
?>
    <div class="flash_tip"><?php echo $flash;?></div>
<?php
    }
?>

