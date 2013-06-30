               <div class="membermsg"><!--站内消息-->
                     <b>【通知】</b>您有<font color="#FF0000"><?php $messages=Messages::model(); echo $messages->get_unread_message();?></font>条未读消息<a href="<?php echo $this->createUrl("user/message");?>">查看详情</a>
                    </div>
                    <div class="memberbody"><!--用户内容-->
                    	<div class="memberlibox">
                        	<div class="memberli">
                        	   <div class="memberli_left">用户名：</div>
                               <div class="memberli_right"><?php echo $model->user_login;?></div>
                            </div>
                            <div class="memberli">
                        	   <div class="memberli_left">用户邮箱：</div>
                               <div class="memberli_right"><?php echo $model->user_email;?></div>
                               <a class="memberbnt" href="<?php echo $this->createUrl("user/editemail");?>">修改</a>
                              
                            </div>
                            <div class="memberli">
                        	   <div class="memberli_left">真实姓名：</div>
                               <div class="memberli_right"><?php echo $model->real_name;?></div>
                            </div>
                            <div class="memberli">
                        	   <div class="memberli_left">性别：</div>
                               <div class="memberli_right"><?php echo CV::$sex[$model->genter];?></div>
                            </div>
                            <div class="memberli">
                        	   <div class="memberli_left">抵用劵：</div>
                              <div class="memberli_right"><?php echo $model->conpon;?></div>
                              <a class="memberbnt" href="<?php echo $this->createUrl("user/pay");?>">充值</a>
                            </div>
                            
                            <div class="memberli">
                        	   	 <div class="memberli_left">生日:</div>
                               <div class="memberli_right"><?php echo $model->birthday;?></div>
                            </div>
                            
                            <div class="memberli">
                        	   	 <div class="memberli_left">手机号码:</div>
                               <div class="memberli_right"><?php echo $model->cell_phone;?></div>
                            </div>
  
                            
                            <div class="memberli">
                        	   	 <div class="memberli_left">身份证号码:</div>
                               <div class="memberli_right"><?php echo $model->code;?></div>
                            </div>
                            
                            <div class="memberli">
                        	   	 <div class="memberli_left">地址:</div>
                               <div class="memberli_right"><?php echo $model->address;?></div>
                            </div>
                        </div>
                    
                    </div>        