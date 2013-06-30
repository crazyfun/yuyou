<?php

	   $pay_status=Util::com_search_item(array(''=>'不限'),CV::$group_pay_status);
	    
       $this->widget('SearchItems', array( 
          'model_name'=>'GroupOrder', 
          'user_operate'=>array(
             array(
               'name'=>'订单管理',
               'value'=>$this->createUrl("index"),
             ),
            
				     array(
				       'name'=>'未使用的订单',
				       'value'=>$this->createUrl("index",array('travel_status'=>'1'))
				     ),
				     
				      array(
				       'name'=>'已使用的订单',
				       'value'=>$this->createUrl("index",array('travel_status'=>'2'))
				     ),
				     
				      array(
				       'name'=>'已取消的订单',
				       'value'=>$this->createUrl("index",array('travel_status'=>'3'))
				     ),
				     
				  
				    
          ),
          //搜索的内容字段
          'search_datas'=>array(
             'group_title'=>array(
               'name'=>'产品名称',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['group_title'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
             'order_serial'=>array(
               'name'=>'订单号',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['order_serial'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
              'user_login'=>array(
               'name'=>'下单用户',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['user_login'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
             'cell_phone'=>array(
               'name'=>'手机号码',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['cell_phone'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
             'pay_status'=>array(
               'name'=>'付款状态',
               'type'=>'select',//搜索框的类型
               'select'=>$page_params['pay_status'],
               'value'=>$pay_status,
               'htmlOptions'=>array(),
             ),
             
              'create_start_date'=>array(
               'name'=>'创建开始时间',
               'type'=>'date',//搜索框的类型
               'select'=>$page_params['create_start_date'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
              'create_end_date'=>array(
               'name'=>'创建结束时间',
               'type'=>'date',//搜索框的类型
               'select'=>$page_params['create_end_date'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
          ), 
          'dataprovider'=>$dataProvider,
          //列表显示的字段
          'attributes'=>array(
             array(
                'name'=>'id',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->id',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
             ),
             
             array(
                'name'=>'订单号',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->show_attribute("order_serial")',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
             ),

			 			array(
							'name'=>'group_id',
							'type'=>'raw',
							'value'=>'$data->show_attribute("group_id")',
						 ),

             array(
                'name'=>'user_id',
                'type'=>'raw',
                'value'=>'$data->show_attribute("user_id")',
             ),
             
             array(
                'name'=>'cell_phone',
                'type'=>'raw',
                'value'=>'$data->show_attribute("cell_phone")',
             ),
             
              array(
                'name'=>'产品价钱',
                'type'=>'raw',
                'value'=>'$data->Group->price',
             ),
             array(
                'name'=>'amount',
                'type'=>'raw',
                'value'=>'$data->show_attribute("amount")',
             ),
			  
             array(
                'name'=>'total_price',
                'type'=>'raw',
                'value'=>'$data->show_attribute("total_price")',
             ),
			 
              array(
                'name'=>'status',
                'type'=>'raw',
                'value'=>'$data->show_attribute("status")',
             ),

             
              array(
                'name'=>'pay_status',
                'type'=>'raw',
                'value'=>'$data->show_attribute("pay_status")',
             ),
             

            
             
             array(
                'name'=>'pay_time',
                'type'=>'raw',
                'value'=>'$data->show_attribute("pay_time")',
             ),
              array(
                'name'=>'create_time',
                'type'=>'raw',
                'value'=>'$data->show_attribute("create_time")',
             ),
             
              array(
                'name'=>'user_time',
                'type'=>'raw',
                'value'=>'$data->show_attribute("user_time")',
             ),
             array(
                'name'=>'操作',
                'type'=>'raw',
                'value'=>'$data->get_group_operate()',
             ),
          
          ),
          //批量操作按钮
          'operates'=>array(
             array(
               
             ),
          ),
          //是否需要全选列
          'checked_all'=>true,
          //是否使用ajax翻页
          'ajax'=>false,    
       ));
?>