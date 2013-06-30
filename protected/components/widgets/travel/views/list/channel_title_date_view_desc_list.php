
										<li class="subt_list">
                    	<h3><span>[<a href="<?php echo $data->channel_href?>" title="<?php echo $data->channel_name;?>"><?php echo $data->channel_name;?></a>]</span><a href="<?php echo $data->href;?>" title="<?php echo $data->title;?>"><?php echo $data->title;?></a></h3>
                      <div class="subt_time"><span><small>日期：</small><?php echo $data->modify_time;?></span><span><small>点击：</small><?php echo $data->views;?></span></div>
                        <div class="subt_ms"><?php echo $data->scontent;?></div>
                    </li>