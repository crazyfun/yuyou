           <h2>酒店目的地推荐</h2>
           <div class="hotel_name">
           	<?php foreach($region_datas as $key => $value){ ?>
              <dl>
                 <dt><?php echo $value['name'];?></dt>
                 <dd>
                 	<?php foreach($value['children'] as $key1=> $value1){?>
                 	   <a href="<?php echo $this->controller->createUrl("search/index",array('action'=>'hotels','hotel_region'=>$key1));?>" target="_blank"><?php echo $value1;?></a>
                  <?php } ?>
                 	</dd>
              </dl>
            <?php } ?>
              <div class="hotel_more"><a href="<?php echo $this->controller->createUrl("search/index",array('action'=>'hotels'));?>" target="_blank">更多目的地推荐>></a></div>
           </div>