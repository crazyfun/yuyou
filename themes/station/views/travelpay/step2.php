<?php
      Yii::app()->clientScript->registerCssFile('/js/poshytip/tip-yellow/tip-yellow.css');
      Yii::app()->clientScript->registerScriptFile('/js/poshytip/jquery.poshytip.min.js');
?>
<div class="main_con">
		<div class="order_top order_top2"></div>
    <div class="order_title">
    	<span>预订：</span><h1><a href="<?php echo $this->createUrl("travel/show",array("id"=>$order_data->Travel->id));?>" target="_blank"><?php echo $order_data->Travel->title;?></a></h1>
    </div>
       						<?php 
    		 							$form=$this->beginWidget('EActiveForm', array(
	        								'id'=>'pay_form',
          								'action'=>$this->createUrl("travelpay/step2"),
	        								'enableAjaxValidation'=>false,
	        								'htmlOptions'=>array('onsubmit'=>'return false;'),
         							));
         							echo CHtml::hiddenField("order_id",$model->order_id,array());
         							echo CHtml::hiddenField("action","order",array());
        					?>
     
    <div class="order_main">
    	
    	<div class="con_name">
        <?php $this->widget("FlashInfo");?>
       </div>
       
       
         <h3>订单联系人信息<span>（*为必填项，请准确填写联系人信息，以便客服能顺利与您联系，进行资源确认）</span></h3>
         <div class="user-info">
           <div class="inp_left"><span>*</span>联系人姓名：</div>
           <div class="inp_center">
           	 <?php echo EHtml::createText("Main[contacter]",$main_model->contacter,array('class'=>'inp-txt main_contacter'));?>
           	
           </div>
           <div class="msg_er"><?php echo $form->error($main_model,"contacter");?></div>
          <div class="inp_left"><span>*</span>联系人手机：</div>
          <div class="inp_center"><?php echo EHtml::createText("Main[contacter_phone]",$main_model->contacter_phone,array('class'=>'inp-txt main_contacter_phone'));?></div>
        <div class="msg_er"><?php echo $form->error($main_model,"contacter_phone");?></div>
          <div class="clear_float"></div>
        </div>
         <!--//订单联系人信息-->
      <h3>游玩人信息<span>(*为必填项，请准确填写游客信息，以便办理登机手续和购买保险。若填写的信息与真实信息不符，保险公司将无法承担赔偿责任。)</span></h3>
                <div class="user-info">
        <?php if(!Yii::app()->user->isGuest){ 
        	$contacter=Contacter::model();
        	$user_id=Yii::app()->user->id;
        	$contacter_datas=$contacter->findAll("t.user_id=:user_id",array(':user_id'=>$user_id));
        	
        ?>
        <div class="con_name"><!--联系人-->
             <h4>我的联系人</h4>  
             <ul>
             	<?php foreach($contacter_datas as $key => $value){ ?>
               <li><input name="" index="<?php echo $key+1;?>" class="check_contacter" type="checkbox" value="<?php echo $value->contacter;?>" contacter_phone="<?php echo $value->contacter_phone;?>" code_type="<?php echo $value->code_type;?>" code_value="<?php echo $value->code_value;?>" is_child="<?php echo $value->is_child;?>" /><?php echo $value->contacter;?></li>
              <?php } ?>
             </ul>
             <div class="clear_float"></div>
        </div><!--//联系人-->
        
        
                <div class="con_name"><!--身份信息-->
             <h4>有效身份信息(<font color="#E44360">需要添加<?php echo $people_nums;?>位游客信息</font>)</h4>  
             <div class="con_name_info">
                 <table width="100%" cellpadding="0" cellspacing="0">
                    <thead>
                      <tr>
                        <td width="5%"></td>
                        <td width="18%"><span class="memberli_required">*</span>姓名</td>
                        <td width="11%"><span class="memberli_required">*</span>证件类型</td>
                        <td width="18%"><span class="memberli_required">*</span>证件号码</td>
                        <td width="18%">手机号</td>
                        <td width="12%">儿童</td>
                        <td width="12%">上车地点</td>
                        <td width="17%"><input name="" type="checkbox" id="check_all" value="" class="cn_input"/>全部</td>
                      </tr>
                    </thead><!--//标题-->
                    <tbody id="contacter_body">
                    	<?php 
                    	
                    	foreach((array)$Contacter['contacter'] as $key => $value){ 
                    		
                    	?>
                       <tr>
                         <td align="center"><a class="delete_contacter" href="javascript:void(0);">删除</a></td>
                         <td><input name="Contacter[contacter][]" value="<?php echo $value;?>" type="text" class="contacter_contacter" /></td>
                         <td>
                         	<select name="Contacter[code_type][]">
                           <option value="1" <?php if($Contacter['code_type'][$key]==1) echo "checked='Checked'";   ?>>身份证</option>
                           <option value="2" <?php if($Contacter['code_type'][$key]==2) echo "checked='Checked'";   ?>>护照</option>
                         </select>
                         </td>
                         <td><input name="Contacter[code_value][]" value="<?php echo $Contacter['code_value'][$key];?>" type="text" class="contacter_code_value" /></td>
                         <td><label>
                         <input name="Contacter[contacter_phone][]" value="<?php echo $Contacter['contacter_phone'][$key];?>" type="text" />
                         </label></td>
                         <td><input name="Contacter[is_child][]" class="is_children" type="checkbox" <?php if($Contacter['is_child'][$key]=='1') echo "checked='CHECKED'"; ?> value="1" />儿童小于12周岁</td>
                         <td><?php echo EHtml::createSelect("Contacter[travel_address][]", $Contacter['travel_address'][$key],$address_select,array('class'=>'travel_address_select'));?></td>
                         <td><input name="Contacter[save][]" type="checkbox" class="save_contacter" value="1" class="cn_input"/>
                         保存</td>
                      </tr>
                    <?php } ?>
                      
                    </tbody>
                 </table>
                 <div class="clear_float"><a href="javascript:add_contacter('','','','','','');" class="tj_bnt">添加一位游玩人</a></div>
          </div>
        </div><!--//身份信息-->
        
      <?php
   		 	
       		}else{
       ?>
       
       
        <div class="con_name"><!--身份信息-->
             <h4>有效身份信息(<font color="#E44360">需要添加<?php echo $people_nums;?>位游客信息</font>)</h4>  
             <div class="con_name_info">
                 <table width="100%" cellpadding="0" cellspacing="0">
                    <thead>
                      <tr>
                        <td width="5%"></td>
                        <td width="18%"><span class="memberli_required">*</span>姓名</td>
                        <td width="11%"><span class="memberli_required">*</span>证件类型</td>
                        <td width="18%"><span class="memberli_required">*</span>证件号码</td>
                        <td width="18%">手机号</td>
                        <td width="12%">儿童</td>
                        <td width="12%">上车地点</td>
                      </tr>
                    </thead><!--//标题-->
                    <tbody id="contacter_body">
                    	<?php 
                    	
                    	foreach((array)$Contacter['contacter'] as $key => $value){ 
                    		
                    	?>
                       <tr>
                         <td align="center"><a class="delete_contacter" href="javascript:void(0);">删除</a></td>
                         <td><input name="Contacter[contacter][]" value="<?php echo $value;?>" type="text" class="contacter_contacter" /></td>
                         <td>
                         	<select name="Contacter[code_type][]">
                           <option value="1" <?php if($Contacter['code_type'][$key]==1) echo "checked='Checked'";   ?>>身份证</option>
                           <option value="2" <?php if($Contacter['code_type'][$key]==2) echo "checked='Checked'";   ?>>护照</option>
                         </select>
                         </td>
                         <td><input name="Contacter[code_value][]" value="<?php echo $Contacter['code_value'][$key];?>" type="text" class="contacter_code_value" /></td>
                         <td><label>
                         <input name="Contacter[contacter_phone][]" value="<?php echo $Contacter['contacter_phone'][$key];?>" type="text" />
                         </label></td>
                         <td><input name="Contacter[is_child][]" class="is_children" type="checkbox" <?php if($Contacter['is_child'][$key]=='1') echo "checked='CHECKED'"; ?> value="1" />儿童小于12周岁</td>
                         <td><?php echo EHtml::createSelect("Contacter[travel_address][]",$Contacter['travel_address'][$key],$address_select,array('class'=>'travel_address_select'));?></td>
                      </tr>
                    <?php } ?>
                      
                    </tbody>
                 </table>
                 <div class="clear_float"><a href="javascript:add_contacter('','','','','','');" class="tj_bnt">添加一位游玩人</a></div>
          </div>
        </div><!--//身份信息-->
        
       
      
     <?php } ?>
        </div>
         <!--//游玩人信息-->
         <h3>订单备注</h3>
         <div class="user-info remark2">
           <div class="inp_left">订单备注：</div>
           <div class="inp_center"> <?php echo EHtml::createTextarea("comment",$order_data->comment,array('class'=>'inp-dingdan_xuqiu','rows'=>'4','cols'=>'70'));?></div>
           <div class="clear_float"></div>
         </div><!--订单备注-->
         <div class="order_commit">
        <input class="btn_submit" type="button" value="确认下单" onclick="javascript:submit_order();">
        <div style="clear:both;"></div>
      </div>   
    </div>
    <?php $this->endWidget(); ?>
</div><!--main_con end-->

<script language="javascript">
	var people_nums="<?= $people_nums ?>";
	var contacter_nums="<?= $contacter_number ?>"||0;
	var user_id="<?= Yii::app()->user->id ?>";
	jQuery(function(){
		jQuery("#check_all").bind("click",function(){
			  var checked=jQuery(this).attr("checked");
			  if(checked){
			  	jQuery(".save_contacter").attr("checked",true);
			  }else{
			  	jQuery(".save_contacter").attr("checked",false);
			  }
		});
		jQuery(".delete_contacter").live("click",function(){
			var id=jQuery(this).parent().parent().attr("id");
			var ids=id.split("_");
			if(ids[1]){
				jQuery(".check_contacter[index='"+ids[1]+"']").attr("checked",false);
			}
			jQuery(this).parent().parent().remove();
			contacter_nums--;
		});
		jQuery(".check_contacter").bind("click",function(){
			  var checked=jQuery(this).attr("checked");
			  if(checked){
			  if(contacter_nums<people_nums){
			  	var index=jQuery(this).attr("index");
			  	var contacter=jQuery(this).val();
			  	var contacter_phone=jQuery(this).attr("contacter_phone");
			  	var code_type=jQuery(this).attr("code_type");
			  	var code_value=jQuery(this).attr("code_value");
			  	var is_child=jQuery(this).attr("is_child");
			  	add_contacter(contacter,contacter_phone,code_type,code_value,is_child,index);
			   }else{
			   	
			   	jQuery(this).attr("checked",false);
			   	jQuery.jBox.tip("只能填写"+people_nums+"个游客信息", '提示');
			   }
			  }else{
			  	var index=jQuery(this).attr("index");
			  	jQuery("#contacter_"+index).remove();
			  	contacter_nums--;
			  	
			  }
			  
		});
	})
	function add_contacter(contacter,contacter_phone,code_type,code_value,is_child,index){  
		  if(contacter_nums<people_nums){
		  	 	 contacter_nums++;
		     	 var html="";
		       html+='<tr id="contacter_'+index+'"><td align="center"><a class="delete_contacter" href="javascript:void(0);">删除</a></td><td><input class="contacter_contacter" name="Contacter[contacter][]" value="';
		       html+=contacter;
		       html+='" type="text" /></td><td><select name="Contacter[code_type][]"><option value="1"';
		       var checked="";
		       if(code_type==1){
		       	checked='checked="CHECKED"';
		       }else{
		       	checked="";
		       }
		       html+=checked;
		       html+='>身份证</option><option value="2"';
		       if(code_type==2){
		       	checked='checked="CHECKED"';
		       }else{
		       	checked="";
		       }
		       html+=checked;
		       html+='>护照</option></select></td><td><input class="contacter_code_value" name="Contacter[code_value][]" value="';
		       html+=code_value;
           html+='" type="text" /></td><td><label><input name="Contacter[contacter_phone][]" value="';
           html+=contacter_phone;
           html+='" type="text" /></label></td><td><input name="Contacter[is_child][]" class="is_children" type="checkbox"';
          if(is_child==1){
           		checked='checked="CHECKED"';
          }else{
          	checked="";
          }
          html+=checked;
          html+='value="1" />儿童小于12周岁</td>';
          html+='<td><?= $address_select_html ?></td>';
          if(user_id){
          	html+='<td><input name="Contacter[save][]" type="checkbox" class="save_contacter" value="1" class="cn_input"/>保存</td>';
          }
          html+='</tr>';
          jQuery("#contacter_body").append(html);
          
        }else{
        	jQuery.jBox.tip("只能填写"+people_nums+"个游客信息", '提示');
        }
	}
	
	function submit_order(){
		if(contacter_nums!=people_nums){
			jQuery.jBox.tip("请填写"+people_nums+"个游客信息", '提示');
		}else{
	  var submit_flag=true;
		var main_contacter=jQuery(".main_contacter").val();
		var main_contacter_phone=jQuery(".main_contacter_phone").val();
		if(!main_contacter){
			jQuery(".main_contacter").focus();
			jQuery.jBox.tip("请填写联系人姓名", '提示');
			submit_flag=false;
		}
		if(submit_flag){
		if(!main_contacter_phone){
			jQuery(".main_contacter_phone").focus();
			jQuery.jBox.tip("请填写联系人手机", '提示');
			submit_flag=false;
		}
	}
	if(submit_flag){
		jQuery(".contacter_contacter").each(function(i){
        var value=jQuery(this).val();
        if(!value){
        	jQuery(this).focus();
					jQuery.jBox.tip("请填写姓名",'提示');
					submit_flag=false;
				}
    });
   } 
   if(submit_flag){
    jQuery(".contacter_code_value").each(function(i){
        var value=jQuery(this).val();
        if(!value){
        	jQuery(this).focus();
					jQuery.jBox.tip("请填写证件号码",'提示');
					submit_flag=false;
				}
    });
   }
   
   if(submit_flag){
   	 jQuery(".travel_address_select").each(function(i){
        var value=jQuery(this).val();
        if(!value){
        	jQuery(this).focus();
					jQuery.jBox.tip("请选择上车地点",'提示');
					submit_flag=false;
				}
    });
  }
    if(submit_flag){
    	document.getElementById("pay_form").submit();
    }
		
	}
	}
</script>