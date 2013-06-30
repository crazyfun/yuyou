
<?php foreach($content as $key => $value){ ?>
                      <li>
                            <a href="<?php echo $value['href'];?>" title="<?php echo $value['title'];?>" target="_blank"><h2><?php echo $value['title'];?></h2><img src="<?php echo $value['image'];?>" alt="<?php echo $value['title'];?>" width="200" height="127"/></a>
                              <div class="hot_buybox">
                                  <div class="hot_b_num"><strong><?php echo $value['buy_numbers'];?></strong>人购买</div>
                                  <div class="hot_b_see"><a href="<?php echo $value['href'];?>" title="<?php echo $value['title'];?>" target="_blank">去看看</a></div>
                              </div>
                           </li>
<?php } ?>  