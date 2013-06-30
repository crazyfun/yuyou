<?php 
      
       $this->widget('AddItems', array( 
          'model'=>$model, 
          'name'=>'出游订单号',
          //用户操作
          'user_operate'=>array(
          ),
          //增加的内容字段
     'add_datas'=>array(
			  'order_serial'=>array(
				'name'=>'请输入订单号',
				'type'=>'text',
				'value'=>'',
				'htmlOptions'=>array(),
			 ),
			),
			 //最下面操作按钮
			'operates'=>array(
				array(
				   
				),
			),
  ));
?>