<?php 
  Yii::app()->clientScript->registerScriptFile('/js/jQuery.selectbox.js');	
  Yii::app()->clientScript->registerCssFile('/js/autocompleted/styles.css');
  Yii::app()->clientScript->registerScriptFile("/js/autocompleted/jquery.autocomplete-min.js");
?>
<div id="page_content">
    <div class="show_right_content">
    <!--用户操作-->
    	<div class=""><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("index",array());?>">返回到服务商管理</a></span><span><a href="<?php echo $this->createUrl("add");?>">新增服务商</a></span></div></div>
    <!--用户操作end-->
    <!--编辑框-->	
    	<div class="edit_content">
    		
    		
    		 <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
    		 <?php 
    		     $form = $this->beginWidget('EActiveForm', array('action'=>"",'enableAjaxValidation'=>false,'htmlOptions'=>array('enctype'=>'multipart/form-data')));
    		     echo $form->createHidden($model,'id',array());
    		  ?>
    		
           <div class="content_inline">
           	 <div class="content_name">公司名称</div>
           	 <div class="content_content"><?php echo $form->createText($model,"company_name",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'company_name');?></div>
           </div>
					<div class="content_inline">
           	 <div class="content_name">公司性质</div>
           	 <div class="content_content"><?php echo $form->createSelect($model,"company_type",CV::$company_type,array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'company_type');?></div>
           </div>
            <div class="content_inline">
           	 <div class="content_name">联系人</div>
           	 <div class="content_content"><?php echo $form->createText($model,"contact",array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'contact');?></div>
           </div>
						<div class="content_inline">
           	 <div class="content_name">联系电话</div>
           	 <div class="content_content"><?php echo $form->createText($model,'contact_phone',array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'contact_phone');?></div>
           </div>
           <div class="content_inline">
           	 <div class="content_name">公司座机</div>
           	 <div class="content_content"><?php echo $form->createText($model,'telephone',array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'telephone');?></div>
           </div>
           
            <div class="content_inline">
           	 <div class="content_name">邮箱</div>
           	 <div class="content_content"><?php echo $form->createText($model,'email',array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'email');?></div>
           </div>
           
           
           <div class="content_inline">
           	 <div class="content_name">地址</div>
           	 <div class="content_content"><?php echo $form->createText($model,'address',array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'address');?></div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">交通指南</div>
           	 <div class="content_content"><?php echo $form->createText($model,'traffic',array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'traffic');?></div>
           </div>
          
           <div class="content_inline">
           	 <div class="content_name">公司坐标</div>
           	 <div class="content_content"><?php echo $form->createText($model,'coordinate',array('id'=>'coordinate','onclick'=>'javascript:baidu_maps();'));?></div>
           	 <div class="content_error"><?php echo $form->error($model,'coordinate');?></div>
           </div>
           
            <div class="content_inline">
           	 <div class="content_name">所属区域</div>
           	 <div class="content_content">
           	 	<?php echo $form->createAjaxselect($model,"region_id",array('title'=>'可直接选择城市或输入城市','type_value'=>'region','tabs'=>"[{'name':'城市','url':'/api/region','id':'','type':'region'}]",'serviceUrl'=>"/api/mixregion",'multi'=>false,'level'=>3));?>  
        	  </div>
           	 <div class="content_error"><?php echo $form->error($model,'region_id');?></div>
           </div>
           
            <div class="content_inline">
           	 <div class="content_name">QQ1</div>
           	 <div class="content_content"><?php echo $form->createText($model,'qq1',array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'qq1');?></div>
           </div>
           <div class="content_inline">
           	 <div class="content_name">QQ2</div>
           	 <div class="content_content"><?php echo $form->createText($model,'qq2',array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'qq2');?></div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">QQ3</div>
           	 <div class="content_content"><?php echo $form->createText($model,'qq3',array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'qq3');?></div>
           </div>
           
           
           <div class="content_inline">
           	 <div class="content_name">银行名称</div>
           	 <div class="content_content"><?php echo $form->createText($model,'bank_name',array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'bank_name');?></div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">户名</div>
           	 <div class="content_content"><?php echo $form->createText($model,'bank_owner',array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'bank_owner');?></div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">银行帐号</div>
           	 <div class="content_content"><?php echo $form->createText($model,'bank_account',array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'bank_account');?></div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">开通状态</div>
           	 <div class="content_content"><?php echo $form->createSelect($model,'status',CV::$open_status,array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'status');?></div>
           </div>

           <div class="content_inline">
           	 <div class="content_name">开始时间</div>
           	 <div class="content_content"><?php echo $form->createDate($model,'start_time',array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'start_time');?></div>
           	 <div class="content_tip">如果未设置，则第二天自动开通</div>
           </div>
           
           
           <div class="content_inline">
           	 <div class="content_name">结束时间</div>
           	 <div class="content_content"><?php echo $form->createDate($model,'end_time',array());?></div>
           	 <div class="content_error"><?php echo $form->error($model,'end_time');?></div>
           	 <div class="content_tip">商家签约到期自动关闭</div>
           </div>
           
           <div class="content_button">
	         	 <input type="submit" class="input_submit" value="确定" name="button_ok"/>
	         	 <input type="reset" class="input_cancel" value="取消" name="button_reset"/>
	        </div>
	     <?php $this->endWidget();?>
    	  </div>
    	 <!--编辑框end-->	
    </div>
</div>




  	<script language="javascript">
    	
        function baidu_maps(){
        	var address=document.getElementById("coordinate").value;
        	set_bmap(address);
        	
        }
    	</script> 