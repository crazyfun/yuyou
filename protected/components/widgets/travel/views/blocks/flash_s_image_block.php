   <?php foreach($content as $key => $value){ ?>
            <li>
            	<div class="scpic"><a href="<?php echo $value['href'];?>" title="<?php echo $value['title'];?>"><p><img src="<?php echo $value['image']; ?>" alt="<?php echo $value['title']; ?>"/></p></a></div>
              <a href="<?php echo $value['href'];?>"><?php echo $value['title'];?></a>
            </li>
    <?php } ?>
    <script type="text/javascript">  
        jQuery(function(){  
            var speed=20; //数字越大速度越慢
						var tab=document.getElementById("scrollpic");
						var tab1=document.getElementById("scrollpic1");
						var tab2=document.getElementById("scrollpic2");
						tab2.innerHTML=tab1.innerHTML;
						function Marquee(){
								if(tab2.offsetWidth-tab.scrollLeft<=0)
									tab.scrollLeft-=tab1.offsetWidth
								else{
									tab.scrollLeft++;
								}
							}
						var MyMar=setInterval(Marquee,speed);
						tab.onmouseover=function() {clearInterval(MyMar)};
						tab.onmouseout=function() {MyMar=setInterval(Marquee,speed)};
        });  
    </script>
              