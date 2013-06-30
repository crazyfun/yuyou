<?php
       $reply_time=Util::com_search_item(array(''=>'不限'),CV::$GROUP_REPLY_TIME);
       $status=Util::com_search_item(array(''=>'不限'),CV::$GROUP_CUSTOMIZE_STATUS);
       $this->widget('SearchItems', array( 
          'model_name'=>'GroupCustomize', 
          'user_operate'=>array(
              
          ),
          //搜索的内容字段
          'search_datas'=>array(
             'contact_name'=>array(
               'name'=>'联系人',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['contact_name'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
     
     'company_name'=>array(
               'name'=>'公司名称',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['company_name'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
					 'reply_time'=>array(
               'name'=>'回复时间',
               'type'=>'select',//搜索框的类型
               'select'=>$page_params['reply_time'],
               'value'=>$reply_time,
               'htmlOptions'=>array(),
             ),
			 			
			 			 'start_region'=>array(
               'name'=>'出发地',
               'type'=>'ajaxselect',//搜索框的类型
               'select'=>$page_params['start_region'],
               'value'=>'',
               'htmlOptions'=>array('title'=>'可直接选择城市或输入城市','text_value'=>$page_params['start_region_text'],'type_value'=>'region','tabs'=>"[{'name':'城市','url':'/api/region','id':'','type':'region'}]",'serviceUrl'=>"/api/mixregion",'multi'=>false,'level'=>3),
             ),
             
             
             'end_region'=>array(
               'name'=>'出发地',
               'type'=>'ajaxselect',//搜索框的类型
               'select'=>$page_params['end_region'],
               'value'=>'',
               'htmlOptions'=>array('title'=>'可直接选择城市或输入城市','text_value'=>$page_params['end_region_text'],'type_value'=>'region','tabs'=>"[{'name':'城市','url':'/api/region','id':'','type':'region'}]",'serviceUrl'=>"/api/mixregion",'multi'=>false,'level'=>3),
             ),
             
             
			 			'status'=>array(
							'name'=>'过期状态',
							'type'=>'select',
							'select'=>$page_params['status'],
							'value'=>$status,
							'htmlOptions'=>array(),
			 			),
			 			
			 			'search_start_time'=>array(
							'name'=>'开始时间',
							'type'=>'date',
							'select'=>$page_params['search_start_time'],
							'value'=>'',
							'htmlOptions'=>array(),
			 			),
			 			
			 			'search_end_time'=>array(
							'name'=>'结束时间',
							'type'=>'date',
							'select'=>$page_params['search_end_time'],
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
							'name'=>'contact_name',
							'type'=>'raw',
							'value'=>'$data->show_attribute("contact_name")',
						 ),
             	array(
							'name'=>'contact_phone',
							'type'=>'raw',
							'value'=>'$data->show_attribute("contact_phone")',
						 ),
             array(
                'name'=>'contact_tel',
                'type'=>'raw',
                'value'=>'$data->show_attribute("contact_tel")',
             ),
			  
             array(
                'name'=>'contact_email',
                'type'=>'raw',
                'value'=>'$data->show_attribute("contact_email");',
             ),
			       
			       array(
                'name'=>'reply_time',
                'type'=>'raw',
                'value'=>'$data->show_attribute("reply_time");',
             ),
             array(
                'name'=>'company_name',
                'type'=>'raw',
                'value'=>'$data->show_attribute("company_name");',
             ),
              array(
                'name'=>'start_time',
                'type'=>'raw',
                'value'=>'$data->show_attribute("start_time");',
             ),
              array(
                'name'=>'end_time',
                'type'=>'raw',
                'value'=>'$data->show_attribute("end_time");',
             ),
              array(
                'name'=>'start_region',
                'type'=>'raw',
                'value'=>'$data->show_attribute("start_region");',
             ),
             
              array(
                'name'=>'end_region',
                'type'=>'raw',
                'value'=>'$data->show_attribute("end_region");',
             ),
             
             
             array(
                'name'=>'status',
                'type'=>'raw',
                'value'=>'$data->show_attribute("status");',
             ),
             
             array(
                'name'=>'create_time',
                'type'=>'raw',
                'value'=>'$data->show_attribute("create_time");',
             ),
             
             array(
                'name'=>'操作',
                'type'=>'raw',
                'value'=>'$data->get_operate()',
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