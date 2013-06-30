<?php foreach($content as $key => $value){ ?>
 <a href="<?php echo $value->server_address;?>" downloads_id="<?php echo $value->downloads_id;?>" title="<?php echo $value->server_name;?>" class="downbnt"><?php echo $value->server_name;?></a>
<?php } ?>

<script language="javascript">
	jQuery(function(){
	 jQuery(".downbnt").bind('click',function(){
	 	var id=jQuery(this).attr("downloads_id");
		jQuery.ajax({
			   type: "POST",
			   beforeSend: function(){
				  
			   },
			   url: '/api/downloads',
			   processData:true,
			   data: 'id='+id,
			   dataType:'json',
			   success: function(msg){
			   	 
			   }
	  });
	});
	});
	
</script>