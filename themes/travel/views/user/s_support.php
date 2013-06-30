<?php 
  $config_values=ConfigValues::model();
  $type=$config_values->get_ralation_values(10);
  $type=Util::com_search_item(array(''=>'类型'),$type);
  $support_status=Util::com_search_item(array(''=>'回复状态'),CV::$support_status);

?>

								   <div class="membermsg"><!--站内消息-->
                     <b>【通知】</b>您有<font color="#FF0000"><?php $messages=Messages::model(); echo $messages->get_unread_message();?></font>条未读消息<a href="<?php echo $this->createUrl("user/message");?>">查看详情</a>
                    </div>
                    <div><a class="memberbnt" href="<?php echo $this->createUrl("user/addsupport");?>">提交新问题</a></div>
                    <div class="clear_both"></div>
                    <div class="memberbody"><!--用户内容-->
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
                            	<span>标题：<?php echo EHtml::createText("title",$page_params['title'],array());?></span>
                                <span>类型：<?php echo EHtml::createSelect("type",$page_params['type'],$type,array());?></span>
                                <span>回复状态：<?php echo EHtml::createSelect("status",$page_params['status'],$support_status,array());?></span>
                                <span>开始时间：<?php echo EHtml::createDate("start_time",$page_params['start_time'],array());?></span><br/>
                                <span>结束时间：<?php echo EHtml::createDate("end_time",$page_params['end_time'],array());?></span>
                                	<?php echo CHtml::submitButton("搜索",array('class'=>'membercbnt'));?>
                            </div>
                      <?php $this->endWidget(); ?>        
               
                    	  <div class="memberlibox">	
<?php 
  $this->widget('zii.widgets.grid.CGridView',array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
            array(
                'name'=>'编号',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_attribute("id")',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
            array(
                'name'=>'标题',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->title',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
            
            array(
                'name'=>'type',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_attribute("type")',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
            
            
            array(
                'name'=>'create_time',
                'type'=>'raw',
                'value'=>'$data->show_attribute("create_time")',
             
            ),
          
           array(
                'name'=>'status',
                'type'=>'raw',
                'value'=>'$data->show_attribute("status")',
             
            ),
            array(
                'name'=>'操作',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->get_web_operate()',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
           
            
         
    ),
    'ajaxUpdate'=>true,
    )); 
?>     	 	
                    	  	   
                    	  </div>
                            
                        </div>
                    </div> 