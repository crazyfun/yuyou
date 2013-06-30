
<?php $coupon_type=Util::com_search_item(array(''=>'类型'),CV::$consume_type); ?>

                 
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
                            	<span>类型：<?php echo EHtml::createSelect("type",$page_params['type'],$coupon_type,array());?></span>
                                <span>开始时间：<?php echo EHtml::createDate("start_time",$page_params['start_time'],array('dateFmt'=>'yyyy-MM-dd'));?></span>
                                <span>结束时间：<?php echo EHtml::createDate("end_time",$page_params['end_time'],array('dateFmt'=>'yyyy-MM-dd'));?></span>
                           
                                	<?php echo CHtml::submitButton("搜索",array('class'=>'membercbnt'));?>
                            </div>
                      <?php $this->endWidget(); ?>       
               
                    	  <div class="memberlibox">	
<?php 
  $this->widget('zii.widgets.grid.CGridView',array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
            array(
                'name'=>'type',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_attribute("type")',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
            array(
                'name'=>'value',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_attribute("value")',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
             array(
                'name'=>'剩余积分',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->remain',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
            array(
                'name'=>'comment',
                'type'=>'raw',
                'value'=>'$data->comment',
             
            ),
            array(
                'name'=>'create_time',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_attribute("create_time")',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
    ),
    'ajaxUpdate'=>true,
    )); 
?>     	
                    	  	   
                    	  </div>
                            
                        </div>
                    </div> 