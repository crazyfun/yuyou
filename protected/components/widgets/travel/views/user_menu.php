                <div class="membertop_title">我的主页</div>
                 <?php 
        			    foreach($menus as $key => $value){
			       		     $sub_menus=$value['menus'];
			           ?>
			           
										<div class="membermenu2"><!--用户中心-->
                    	<h3 class="<?php echo $value['class'];?>"><a href="<?php if(empty($value['url'])){echo "javascript:toggle_menu('".$value['class']."');";}else{ echo $this->controller->createUrl($value['url']); } ?>"><?php echo $value['name'];?></a></h3>
                        <?php if(!empty($sub_menus)){ ?> 
                        <ul id="<?php echo $value['class'];?>">
                        	 <?php foreach($sub_menus as $key1 => $value1){ ?>
                    	         <li class="<?php echo $value1['class'];?>"><a <?php if($key1==$this->controller->user_tag) echo "class='user_item_active'";?> href="<?php echo $this->controller->createUrl($value1['url']);?>"><?php echo $value1['name']?></a></li>
                           <?php } ?>
                        	
                      </ul>
                    <?php } ?>
                    </div>
                <?php } ?>
                
                
                <script language="javascript">
                		function toggle_menu(id){
                			var slide_obj=jQuery("#"+id);
                			if(slide_obj.css("display")=="none"){
                				slide_obj.slideDown("fast");
                				slide_obj.parent().removeClass("membermenu");
                				slide_obj.parent().addClass("membermenu2");
                			}else{
                				slide_obj.slideUp("fast");
                				slide_obj.parent().removeClass("membermenu2");
                				slide_obj.parent().addClass("membermenu");
                			}
                		}
                </script>
