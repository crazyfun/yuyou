                    
                    
								   <div class="membermsg"><!--站内消息-->
                     <b>【通知】</b>您有<font color="#FF0000"><?php $messages=Messages::model(); echo $messages->get_unread_message();?></font>条未读消息<a href="<?php echo $this->createUrl("user/message");?>">查看详情</a>
                    </div>
                    <div class="memberbody"><!--用户内容-->
                    	<div><a class="membera" href="<?php echo $this->createUrl("user/editcontacter");?>">增加联系人</a></div>
                    	<div class="member_coupon"><!--账户明细-->
                    		<?php
	  												$form=$this->beginWidget('EActiveForm', array(
	        											'id'=>'search_form',
          											'action'=>"",
	        											'enableAjaxValidation'=>false,
	        											'htmlOptions'=>array('id'=>'search_form','enctype'=>'multipart/form-data'),
         									));
   											?>
                        	<div class="member_cbnt">
                            	<span>类型：<?php echo EHtml::createText("contacter",$page_params['contacter'],$coupon_type,array());?></span>
                               <?php echo CHtml::submitButton("搜索",array('class'=>'membercbnt'));?>
                            </div>
                      <?php $this->endWidget(); ?>       
               
                    	  <div class="memberlibox">	
<?php 
  $this->widget('zii.widgets.grid.CGridView',array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
            array(
                'name'=>'contacter',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_attribute("contacter")',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
            array(
                'name'=>'contacter_phone',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_attribute("contacter_phone")',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
             array(
                'name'=>'code_type',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_attribute("code_type")',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
            array(
                'name'=>'code_value',
                'type'=>'raw',
                'value'=>'$data->show_attribute("code_value")',
             
            ),
            array(
                'name'=>'is_child',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_attribute("is_child")',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
            
            array(
                'name'=>'操作',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->get_operate()',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
    ),
    'ajaxUpdate'=>true,
    )); 
?>     	
                    	  	   
                    	  </div>
                            
                        </div>
                    </div> 