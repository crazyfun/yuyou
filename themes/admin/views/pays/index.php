<?php
	     $pay_type=$model->get_pay_type_select();
	     $pay_status=Util::com_search_item(array(''=>'支付状态'),CV::$pay_status);
       $this->widget('SearchItems', array( 
          'model_name'=>'Pays', 
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
			 'type'=>array(
					'name'=>'支付类型',
					'type'=>'select',
					'select'=>$page_params['type'],
					'value'=>$pay_type,
					'htmlOptions'=>array(),
			 ),
			 
			 'outer_serial'=>array(
               'name'=>'外部流水号',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['outer_serial'],
               'value'=>'',
               'htmlOptions'=>array(),
           ),  
        'status'=>array(
               'name'=>'支付状态',
               'type'=>'select',//搜索框的类型
               'select'=>$page_params['status'],
               'value'=>$pay_status,
               'htmlOptions'=>array(),
           ),   
        'start_time'=>array(
               'name'=>'支付开始时间',
               'type'=>'date',//搜索框的类型
               'select'=>$page_params['start_time'],
               'value'=>'',
               'htmlOptions'=>array('dateFmt'=>'yyyy-MM-dd'),
           ),
           
         'end_time'=>array(
               'name'=>'支付结束时间',
               'type'=>'date',//搜索框的类型
               'select'=>$page_params['end_time'],
               'value'=>'',
               'htmlOptions'=>array('dateFmt'=>'yyyy-MM-dd'),
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
				'name'=>'type',
				'type'=>'raw',
				'value'=>'$data->show_attribute("type")',
			 ),
      array(
         'name'=>'user_id',
         'type'=>'raw',
         'value'=>'$data->show_attribute("user_id")',
    	 ),
			 array(
				'name'=>'outer_serial',
				'type'=>'raw',
				'value'=>'$data->outer_serial',
			), 
    	 array(
         'name'=>'price',
         'type'=>'raw',
         'value'=>'$data->price',
     	),
			array(
				'name'=>'status',
				'type'=>'raw',
				'value'=>'$data->show_attribute("status")',
			),
			
			array(
				'name'=>'comment',
				'type'=>'raw',
				'value'=>'$data->show_attribute("comment")',
			),
			
		 array(
				'name'=>'create_time',
				'type'=>'raw',
				'value'=>'$data->show_attribute("create_time")',
			),
			
		 array(
				'name'=>'pay_time',
				'type'=>'raw',
				'value'=>'$data->show_attribute("pay_time")',
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