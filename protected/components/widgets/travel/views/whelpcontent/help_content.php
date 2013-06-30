					<?php foreach($information_datas as $key => $value){ ?>
					      <p id="h<?php echo $value->id;?>" class="qt"><strong><?php echo $value->title;?></strong></p>
                <div class="paragraph">
                	<?php echo $value->content;?>
                </div>
                <P class="totop"><a href="#page_content">返回顶部</a></P>

         <?php } ?>							
