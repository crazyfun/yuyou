<?php
	     $coupon_type=Util::com_search_item(array(''=>'类型'),CV::$consume_type);
       $this->widget('SearchItems', array( 
          'model_name'=>'couponResume', 
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
           
        'operate_user'=>array(
               'name'=>'操作人',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['operate_user'],
               'value'=>'',
               'htmlOptions'=>array(),
           ), 
 
			 'type'=>array(
					'name'=>'类型',
					'type'=>'select',
					'select'=>$page_params['type'],
					'value'=>$coupon_type,
					'htmlOptions'=>array(),
			 ),
        'start_time'=>array(
               'name'=>'开始时间',
               'type'=>'date',//搜索框的类型
               'select'=>$page_params['start_time'],
               'value'=>'',
               'htmlOptions'=>array('dateFmt'=>'yyyy-MM-dd'),
           ),
         'end_time'=>array(
               'name'=>'结束时间',
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
				'name'=>'user_id',
				'type'=>'raw',
				'value'=>'$data->show_attribute("user_id")',
			 ),
			 
			 array(
				'name'=>'type',
				'type'=>'raw',
				'value'=>'$data->show_attribute("type")',
			 ),
			 
      array(
         'name'=>'value',
         'type'=>'raw',
         'value'=>'$data->show_attribute("value")',
    	 ),
			 array(
				'name'=>'remain',
				'type'=>'raw',
				'value'=>'$data->show_attribute("remain")',
			), 
    	 array(
         'name'=>'comment',
         'type'=>'raw',
         'value'=>'$data->show_attribute("comment")',
     	),
			array(
				'name'=>'create_id',
				'type'=>'raw',
				'value'=>'$data->show_attribute("create_id")',
			),
			
			array(
				'name'=>'create_time',
				'type'=>'raw',
				'value'=>'$data->show_attribute("create_time")',
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