<?php
 
	   $status=Util::com_search_item(array(''=>'不限'),CV::$travel_order_status);
	   $pay_status=Util::com_search_item(array(''=>'不限'),CV::$travel_pay_status);
	    $user=User::model();
       $user_datas=$user->findAll("t.company_id=:company_id AND t.admin_status=:admin_status",array(':company_id'=>$this->company_id,':admin_status'=>'2'));
       $operate_user=array();
       foreach($user_datas as $key => $value){
       	 $operate_user[$value->id]=$value->real_name;
       }
       $operate_user=Util::com_search_item(array(''=>'不限'),$operate_user);
       $reserved=Util::com_search_item(array(''=>'不限'),CV::$travel_reserved);
       $this->widget('SearchItems', array( 
          'model_name'=>'TravelOrder', 
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
				       'name'=>'已出游的订单',
				       'value'=>$this->createUrl("index",array('travel_status'=>'3'))
				     ),
				     
				     
				      array(
				       'name'=>'已取消的订单',
				       'value'=>$this->createUrl("index",array('travel_status'=>'4'))
				     ),
				    
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
             
             
              'relation_operate_id'=>array(
               'name'=>'关联用户',
               'type'=>'select',//搜索框的类型
               'select'=>$page_params['relation_operate_id'],
               'value'=>$operate_user,
               'htmlOptions'=>array(),
             ),
             
             'reserved'=>array(
               'name'=>'预留状态',
               'type'=>'select',//搜索框的类型
               'select'=>$page_params['reserved'],
               'value'=>$reserved,
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
                'name'=>'联系人',
                'type'=>'raw',
                'value'=>'$data->show_attribute("contacter_name")',
             ),
             
             
             array(
                'name'=>'联系电话',
                'type'=>'raw',
                'value'=>'$data->show_attribute("contacter_phone")',
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
               'name'=>'reserved',
               'type'=>'raw',
               'value'=>'$data->show_attribute("reserved")',
             
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
                'value'=>'$data->get_dijie_operate()',
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