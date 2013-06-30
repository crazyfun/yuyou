                    <div class="membermsg"><!--站内消息-->
                     <b>【通知】</b>您有<font color="#FF0000"><?php $messages=Messages::model(); echo $messages->get_unread_message();?></font>条未读消息<a href="<?php echo $this->createUrl("user/message");?>">查看详情</a>
                    </div>
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
                            	   <span>线路名称：<?php echo EHtml::createText("travel_name",$page_params['travel_name'],array());?></span>
                                	<?php echo CHtml::submitButton("搜索",array('class'=>'membercbnt'));?>
                            </div>
                      <?php $this->endWidget(); ?>       
               
                    	  <div class="memberlibox">	
<?php 
  $this->widget('zii.widgets.grid.CGridView',array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
            
            array(
                'name'=>'travel_id',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_travel()',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
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