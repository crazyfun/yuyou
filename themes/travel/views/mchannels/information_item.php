
          <li>
            <h1><a href="<?php echo $data->set_channel_link("archives",$data->id);?>" title="<?php echo $data->title;?>"><?php echo $data->title;?></a></h1>
           <p><?php echo $data->scontent;?></p>
             <div class="sear_explain"><span>资讯类别:<?php echo $data->show_attribute("category_id");?></span><span>查看次数:<?php echo $data->views;?></span><span>发布时间:<?php echo $data->modify_time;?></span></div>
          </li>