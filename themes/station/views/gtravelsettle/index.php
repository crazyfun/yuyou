<?php
       $travel_settle=CV::$travel_settle;
       $travel_settle=Util::com_search_item(array(''=>'不限'),$travel_settle);
       $this->widget('SearchItems', array( 
          'model_name'=>'TravelOrder', 
          'user_operate'=>array(
            
          ),
          //搜索的内容字段
          'search_datas'=>array(
             'travel_title'=>array(
               'name'=>'线路名称',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['travel_title'],
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
             
             'travel_start_date'=>array(
               'name'=>'出发开始时间',
               'type'=>'date',//搜索框的类型
               'select'=>$page_params['travel_start_date'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
              'travel_end_date'=>array(
               'name'=>'出发结束时间',
               'type'=>'date',//搜索框的类型
               'select'=>$page_params['travel_end_date'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
             'company_name'=>array(
               'name'=>'供应商',
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
             
              'settle_status'=>array(
               'name'=>'结算状态',
               'type'=>'select',//搜索框的类型
               'select'=>$page_params['settle_status'],
               'value'=>$travel_settle,
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
							'name'=>'travel_id',
							'type'=>'raw',
							'value'=>'$data->show_attribute("travel_id")',
						 ),

             array(
                'name'=>'user_id',
                'type'=>'raw',
                'value'=>'$data->show_attribute("user_id")',
             ),
             
             array(
                'name'=>'travel_date',
                'type'=>'raw',
                'value'=>'$data->show_attribute("travel_date")',
             ),
			 
		
			 				array(
								'name'=>'adult_nums',
								'type'=>'raw',
								'value'=>'$data->show_attribute("adult_nums")',
			 				),
      
             array(
                'name'=>'child_nums',
                'type'=>'raw',
                'value'=>'$data->show_attribute("child_nums")',
             ),
			       
             
             array(
                'name'=>'adult_price',
                'type'=>'raw',
                'value'=>'$data->show_attribute("adult_price")',
             ),
             
             array(
                'name'=>'fa_price',
                'type'=>'raw',
                'value'=>'$data->show_attribute("fa_price")',
             ),
             
             
              array(
                'name'=>'child_price',
                'type'=>'raw',
                'value'=>'$data->show_attribute("child_price")',
             ),
             
             
              array(
                'name'=>'fc_price',
                'type'=>'raw',
                'value'=>'$data->show_attribute("fc_price")',
             ),
             array(
                'name'=>'coupon',
                'type'=>'raw',
                'value'=>'$data->show_attribute("coupon")',
             ),
             array(
                'name'=>'total_price',
                'type'=>'raw',
                'value'=>'$data->show_attribute("total_price")',
             ),
             
             
             array(
                'name'=>'总结算',
                'type'=>'raw',
                'value'=>'$data->get_total_settle_price($data->id)',
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
                'name'=>'供应商',
                'type'=>'raw',
                'value'=>'$data->Travel->Company->company_name',
             ),
             
             array(
                'name'=>'pay_time',
                'type'=>'raw',
                'value'=>'$data->show_attribute("pay_time")',
             ),
             
              array(
                'name'=>'结算状态',
                'type'=>'raw',
                'value'=>'$data->show_attribute("settle_status")',
             ),
             
             
              array(
                'name'=>'create_time',
                'type'=>'raw',
                'value'=>'$data->show_attribute("create_time")',
             ),
             array(
                'name'=>'操作',
                'type'=>'raw',
                'value'=>'$data->get_zutuan_settle_operate()',
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