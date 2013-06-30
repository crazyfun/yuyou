<?php
   
	   $status=Util::com_search_item(array(''=>'不限'),CV::$hotels_status);
	   $pay_status=Util::com_search_item(array(''=>'不限'),CV::$hotels_pay_status);
	   
       $this->widget('SearchItems', array( 
          'model_name'=>'HotelsOrder', 
          'user_operate'=>array(
             array(
               'name'=>'订单管理',
               'value'=>$this->createUrl("index"),
             ),
            
				     array(
				       'name'=>'未处理订单',
				       'value'=>$this->createUrl("index",array('travel_status'=>'1'))
				     ),
				     
				      array(
				       'name'=>'已成生成的订单',
				       'value'=>$this->createUrl("index",array('travel_status'=>'2'))
				     ),
				     
				      array(
				       'name'=>'已入住的订单',
				       'value'=>$this->createUrl("index",array('travel_status'=>'3'))
				     ),
				     
				     
				      array(
				       'name'=>'已取消的订单',
				       'value'=>$this->createUrl("index",array('travel_status'=>'4'))
				     ),
				    
          ),
          //搜索的内容字段
          'search_datas'=>array(
             'hotels_title'=>array(
               'name'=>'酒店名称',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['hotels_title'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
              'user_login'=>array(
               'name'=>'用户名称',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['user_login'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
           
             
             'hotels_start_date'=>array(
               'name'=>'入住开始时间',
               'type'=>'date',//搜索框的类型
               'select'=>$page_params['hotels_start_date'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
              'hotels_end_date'=>array(
               'name'=>'入住结束时间',
               'type'=>'date',//搜索框的类型
               'select'=>$page_params['hotels_end_date'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
             'status'=>array(
               'name'=>'订单状态',
               'type'=>'select',//搜索框的类型
               'select'=>$page_params['status'],
               'value'=>$status,
               'htmlOptions'=>array(),
             ),
             
             'pay_status'=>array(
               'name'=>'付款状态',
               'type'=>'select',//搜索框的类型
               'select'=>$page_params['pay_status'],
               'value'=>$pay_status,
               'htmlOptions'=>array(),
             ),
             
             'company_name'=>array(
               'name'=>'旅行社',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['company_name'],
               'value'=>'',
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
							'name'=>'hotels_id',
							'type'=>'raw',
							'value'=>'$data->show_attribute("hotels_id")',
						 ),

             array(
                'name'=>'user_id',
                'type'=>'raw',
                'value'=>'$data->show_attribute("user_id")',
             ),
             
             array(
                'name'=>'联系人',
                'type'=>'raw',
                'value'=>'$data->show_attribute("contacter")',
             ),
             
             
             array(
                'name'=>'联系电话',
                'type'=>'raw',
                'value'=>'$data->show_attribute("contacter_phone")',
             ),
			  
             array(
                'name'=>'start_date',
                'type'=>'raw',
                'value'=>'$data->show_attribute("start_date")',
             ),
             
               array(
                'name'=>'end_date',
                'type'=>'raw',
                'value'=>'$data->show_attribute("end_date")',
             ),
             array(
                'name'=>'房型',
                'type'=>'raw',
                'value'=>'$data->HotelsBeds->show_attribute("name")',
             ),
             array(
                'name'=>'床型',
                'type'=>'raw',
                'value'=>'$data->HotelsPrice->show_attribute("bed")',
             ),
             array(
                'name'=>'价格',
                'type'=>'raw',
                'value'=>'$data->HotelsPrice->price',
             ),
              array(
                'name'=>'numbers',
                'type'=>'raw',
                'value'=>'$data->show_attribute("numbers")',
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
                'name'=>'company_id',
                'type'=>'raw',
                'value'=>'$data->show_attribute("company_id")',
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
                'name'=>'操作',
                'type'=>'raw',
                'value'=>'$data->get_operate()',
             ),
          
          ),
          //批量操作按钮
          'operates'=>array(
             
              
             
          ),
          //是否需要全选列
          'checked_all'=>true,
          //是否使用ajax翻页
          'ajax'=>false,    
       ));
?>