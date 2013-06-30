
       <div class="banbox"><!--banbox-->
         <div class="ban_left" id="slide_images"><a href="javascript:void(0);" target="_blank"><img alt="" src="" width="500" height="368"/></a></div>
         <div class="ban_right">
            <ul class="slide_items">
            	<?php foreach($content as $key => $value){ ?>
                  <li key="<?php echo $key+1;?>" title="<?php echo $value['title'];?>" src="<?php echo $value['flash_img'];?>" href="<?php echo $value['img_href'];?>" ><h2><?php echo $value['title'];?></h2><p><?php echo $value['describe'];?></p></li>
               <?php } ?>
            </ul>
         </div>
      </div><!--//banbox-->
      <script language="javascript">
      	var timeout=5000;
      	var timeout_flag="";
      	jQuery(function(){
      	  var first_child=jQuery(".slide_items > li:first-child");
      	  first_child.addClass("ban_on");
      	  var title=first_child.attr("title");
      	  var src=first_child.attr("src");
      	  var href=first_child.attr("href");
      	  jQuery("#slide_images>a").attr("href",href).attr("title",title);
      	  jQuery("#slide_images>a>img").attr("src",src);
      	  jQuery("#slide_images>a>img").attr("alt",title);
      	  jQuery("#slide_images>a>img").fadeIn("slow");	
      	  jQuery(".slide_items > li").hover(function(){
      	  	  jQuery(".slide_items > li.ban_on").removeClass("ban_on");
      	  	  jQuery(this).addClass("ban_on");
      	  	  var title=jQuery(this).attr("title");
      	  	  var src=jQuery(this).attr("src");
      	  	  var href=jQuery(this).attr("href");
      	  	  var key=jQuery(this).attr("key");
      	  	  jQuery("#slide_images>a").attr("href",href);
      	  	  jQuery("#slide_images>a").attr("title",title);
      	  	  jQuery("#slide_images>a>img").attr("src",src);
      	  		jQuery("#slide_images>a>img").attr("alt",title);
      	 			jQuery("#slide_images>a>img").fadeIn(2000);	  
      	  	  window.clearTimeout(timeout_flag);
      	  	  timeout_flag=window.setTimeout(slide,timeout);
      	  	 
      	  },function(){
      	  });
      	  
      	  timeout_flag=window.setTimeout(slide,timeout);
      	});
      	
      	function slide(){
      		var slide_item=jQuery(".slide_items > li.ban_on");
      		var key=slide_item.attr("key");
      	  key++;
      		if(key>5){
      			key=1;
      		}
      		var next_slide_item=jQuery(".slide_items > li[key='"+key+"']");
      		jQuery(".slide_items > li.ban_on").removeClass("ban_on");
      	  next_slide_item.addClass("ban_on");
      	  var title=next_slide_item.attr("title");
      	  var src=next_slide_item.attr("src");
      	  var href=next_slide_item.attr("href");
      	  jQuery("#slide_images>a").attr("href",href);
      	  jQuery("#slide_images>a").attr("title",title);
      	  jQuery("#slide_images>a>img").attr("src",src);
      	  jQuery("#slide_images>a>img").attr("alt",title);
      	  jQuery("#slide_images>a>img").fadeIn(2000);	  
      	  timeout_flag=window.setTimeout(slide,timeout);

      	}
      </script>
      
      

           
