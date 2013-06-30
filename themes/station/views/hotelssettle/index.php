<?php
       $hotels_settle=CV::$hotels_settle;
       $hotels_settle=Util::com_search_item(array(''=>'不限'),$hotels_settle);
       $this->widget('SearchItems', array( 
          'model_name'=>'HotelsOrder', 
          'user_operate'=>array(
            
          ),
          //搜索的内容字段
          'search_datas'=>array(
            
              'user_login'=>array(
               'name'=>'用户名称',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['user_login'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
             'start_date'=>array(
               'name'=>'入住开始时间',
               'type'=>'date',//搜索框的类型
               'select'=>$page_params['start_date'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
              'end_date'=>array(
               'name'=>'退房结束时间',
               'type'=>'date',//搜索框的类型
               'select'=>$page_params['end_date'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
             'company_name'=>array(
               'name'=>'报名门市',
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
               'value'=>$hotels_settle,
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
                'name'=>'user_id',
                'type'=>'raw',
                'value'=>'$data->show_attribute("user_id")',
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
								'name'=>'numbers',
								'type'=>'raw',
								'value'=>'$data->show_attribute("numbers")',
			 				),
      
             array(
                'name'=>'live_numbers',
                'type'=>'raw',
                'value'=>'$data->show_attribute("live_numbers")',
             ),
			       
             array(
								'name'=>'live_contacter',
								'type'=>'raw',
								'value'=>'$data->show_attribute("live_contacter")',
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
								'value'=>'$data->HotelsPrice->show_attribute("price")',
			 				),
      
             array(
								'name'=>'结算价',
								'type'=>'raw',
								'value'=>'$data->HotelsPrice->show_attribute("settle_price")',
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
                'name'=>'company_id',
                'type'=>'raw',
                'value'=>'$data->Company->company_name',
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
                'value'=>'$data->get_hotels_settle_operate()',
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