
								   <div class="membermsg"><!--站内消息-->
                     <b>【通知】</b>您有<font color="#FF0000"><?php $messages=Messages::model(); echo $messages->get_unread_message();?></font>条未读消息<a href="<?php echo $this->createUrl("user/message");?>">查看详情</a>
                    </div>
                    <div class="memberbody"><!--用户内容-->
           <!--Start of the Tabmenu 1 -->
					<div class="tabmenu">
						<ul>
								<li><a href="<?php echo $this->createUrl("user/travelorder",array('order_status'=>'1'));?>" title="" id="tablink1" class="<?php if($page_params['order_status']=='1'){echo "tabactive";}?>">正在处理的订单</a></li>
								<li><a href="<?php echo $this->createUrl("user/travelorder",array('order_status'=>'2'));?>" title="" id="tablink2" class="<?php if($page_params['order_status']=='2'){echo "tabactive";}?>">已成功的订单</a></li>
								<li><a href="<?php echo $this->createUrl("user/travelorder",array('order_status'=>'3'));?>" title="" id="tablink3" class="<?php if($page_params['order_status']=='3'){echo "tabactive";}?>">已取消的订单</a></li>

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
                            		<span>线路：<?php echo EHtml::createText("title",$page_params['title'],array());?></span>
                            		<span>付款状态：<?php echo EHtml::createSelect("pay_status",$page_params['pay_status'],array(''=>'不限','1'=>'未付款','2'=>'已付款'),array());?></span>
                                <span>出发开始时间：<?php echo EHtml::createDate("start_time",$page_params['start_time'],array('dateFmt'=>'yyyy-MM-dd'));?></span>
                                <br/>
                                <span>出发结束时间：<?php echo EHtml::createDate("end_time",$page_params['end_time'],array('dateFmt'=>'yyyy-MM-dd'));?></span>
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
                'name'=>'出发地',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->Travel->StartRegion->region_name',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
             array(
                'name'=>'目的地',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->Travel->EndRegion->region_name',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
            array(
                'name'=>'travel_date',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_attribute("travel_date")',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
            array(
                'name'=>'总价',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_attribute("all_price")',
            ),
             array(
                'name'=>'total_price',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_attribute("total_price")',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
            array(
                'name'=>'coupon',
                'type'=>'raw',
                'value'=>'$data->show_attribute("coupon")',
             
            ),
            array(
                'name'=>'pay_status',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_attribute("pay_status")',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
            ),
            
              array(
                'name'=>'pay_time',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_attribute("pay_time")',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
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
                    	function send_travel_order_serial(order_id){
                    		jQuery.jBox("iframe:/user/travelorderserial/id/"+order_id, {
   											 title: "查看订单号",
    										 width: 500,
    										 height: 370,
    										 buttons: { '关闭': true }
 												});
                    	}
                    </script>