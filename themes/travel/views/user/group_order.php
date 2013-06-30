
								   <div class="membermsg"><!--站内消息-->
                     <b>【通知】</b>您有<font color="#FF0000"><?php $messages=Messages::model(); echo $messages->get_unread_message();?></font>条未读消息<a href="<?php echo $this->createUrl("user/message");?>">查看详情</a>
                    </div>
                    <div class="memberbody"><!--用户内容-->
           <!--Start of the Tabmenu 1 -->
					<div class="tabmenu">
						<ul>
								<li><a href="<?php echo $this->createUrl("user/grouporder",array('order_status'=>'1'));?>" title="" id="tablink1" class="<?php if($page_params['order_status']=='1'){echo "tabactive";}?>">未使用的订单</a></li>
								<li><a href="<?php echo $this->createUrl("user/grouporder",array('order_status'=>'2'));?>" title="" id="tablink2" class="<?php if($page_params['order_status']=='2'){echo "tabactive";}?>">已使用的订单</a></li>
								<li><a href="<?php echo $this->createUrl("user/grouporder",array('order_status'=>'3'));?>" title="" id="tablink3" class="<?php if($page_params['order_status']=='3'){echo "tabactive";}?>">已取消的订单</a></li>

						</ul>
				</div>
				<!--End of the Tabmenu 1 -->
                    	<div class="member_coupon"><!--账户明细-->
                    		<?php
	  												$form=$this->beginWidget('EActiveForm', array(
	        											'id'=>'search_form',
          											'action'=>"",
	        											'enableAjaxValidation'=>false,
	        											'htmlOptions'=>array('id'=>'search_form','enctype'=>'multipart/form-data'),
         									));
         									echo CHtml::hiddenField("order_status",$page_params['order_status'],array());
   											?>
                        	<div class="member_cbnt">
                            		<span>团购产品：<?php echo EHtml::createText("title",$page_params['title'],array());?></span>
                            		<span>付款状态：<?php echo EHtml::createSelect("pay_status",$page_params['pay_status'],array(''=>'不限','1'=>'未付款','2'=>'已付款'),array());?></span>
                                <span>下单开始时间：<?php echo EHtml::createDate("start_time",$page_params['start_time'],array('dateFmt'=>'yyyy-MM-dd'));?></span>
                                <br/>
                                <span>下单结束时间：<?php echo EHtml::createDate("end_time",$page_params['end_time'],array('dateFmt'=>'yyyy-MM-dd'));?></span>
                                <?php echo CHtml::submitButton("搜索",array('class'=>'membercbnt'));?>
                            </div>
                      <?php $this->endWidget(); ?>       
               
                    	  <div class="memberlibox">	
<?php 
  $this->widget('zii.widgets.grid.CGridView',array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(

            array(
                'name'=>'group_id',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_group_title()',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
            
             array(
                'name'=>'cell_phone',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_attribute("cell_phone")',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
            array(
                'name'=>'amount',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_attribute("amount")',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
             array(
                'name'=>'产品价格',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->Group->price',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
            array(
                'name'=>'total_price',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_attribute("total_price")',
            ),
            
             array(
                'name'=>'status',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_attribute("status")',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
             array(
                'name'=>'pay_status',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_attribute("pay_status")',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
            array(
                'name'=>'pay_time',
                'type'=>'raw',
                'value'=>'$data->show_attribute("pay_time")',
             
            ),
            array(
                'name'=>'create_time',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_attribute("create_time")',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
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
                    <script language="javascript">
                    	function send_group_order_serial(order_id){
                    		jQuery.jBox("iframe:/user/grouporderserial/id/"+order_id, {
   											 title: "查看订单号",
    										 width: 500,
    										 height: 370,
    										 buttons: { '关闭': true }
 												});
                    	}
                    </script>