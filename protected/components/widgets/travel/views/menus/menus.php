			<ul>
				  <li><a href="<?php echo $this->controller->createUrl('site/index');?>" title="首页"
              <?php 
                $controller_id=$this->controller->getId();
                $action_id=$this->controller->action->id;
                if($controller_id=="site"&&$action_id=="index"){
                	echo 'id="menu_select"';
                }
              
              ?>
              >首页</a></li>
					<?php foreach((array)$content as $key => $value){ ?>
        	  <li><a href="<?php echo $value['href'];?>" title="<?php echo $value['name'];?>" id="<?php echo $value['select'];?>"><?php echo $value['name']; ?></a></li>
         <?php } ?>
      </ul>
