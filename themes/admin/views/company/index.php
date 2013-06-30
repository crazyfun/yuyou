<?php
       $open_status=Util::com_search_item(array(''=>'不限'),CV::$open_status);
       $company_type=Util::com_search_item(array(''=>'不限'),CV::$company_type);
      
       $this->widget('SearchItems', array( 
          'model_name'=>'Company', 
          'user_operate'=>array(
              array(
               'name'=>'增加服务商',
               'value'=>$this->createUrl("add",array()),
              ),
          ),
          //搜索的内容字段
          'search_datas'=>array(
             'company_name'=>array(
               'name'=>'公司名称',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['company_name'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
     
					 'company_type'=>array(
               'name'=>'公司性质',
               'type'=>'select',//搜索框的类型
               'select'=>$page_params['company_type'],
               'value'=>$company_type,
               'htmlOptions'=>array(),
             ),
			 			
			 			 'region_id'=>array(
               'name'=>'所属区域',
               'type'=>'ajaxselect',//搜索框的类型
               'select'=>$page_params['region_id'],
               'value'=>'',
               'htmlOptions'=>array('title'=>'可直接选择城市或输入城市','text_value'=>$page_params['region_text'],'type_value'=>'region','tabs'=>"[{'name':'城市','url':'/api/region','id':'','type':'region'}]",'serviceUrl'=>"/api/mixregion",'multi'=>false,'level'=>3),
             ),
             
             
			 			'status'=>array(
							'name'=>'开通状态',
							'type'=>'select',
							'select'=>$page_params['status'],
							'value'=>$open_status,
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
							'name'=>'company_name',
							'type'=>'raw',
							'value'=>'$data->show_attribute("company_name")',
						 ),
             	array(
							'name'=>'company_type',
							'type'=>'raw',
							'value'=>'$data->show_attribute("company_type")',
						 ),
             array(
                'name'=>'contact',
                'type'=>'raw',
                'value'=>'$data->show_attribute("contact")',
             ),
			  
             array(
                'name'=>'contact_phone',
                'type'=>'raw',
                'value'=>'$data->show_attribute("contact_phone");',
             ),
			       
			       array(
                'name'=>'telephone',
                'type'=>'raw',
                'value'=>'$data->show_attribute("telephone");',
             ),
             array(
                'name'=>'address',
                'type'=>'raw',
                'value'=>'$data->show_attribute("address");',
             ),
             
              array(
                'name'=>'region_id',
                'type'=>'raw',
                'value'=>'$data->show_attribute("region_id");',
             ),
             
             array(
                'name'=>'status',
                'type'=>'raw',
                'value'=>'$data->show_attribute("status");',
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
               'name'=>'删除所有',
               'value'=>'javascript:batch_operate(\''.$this->createUrl("delete",array()).'\');'
             ),
          ),
          //是否需要全选列
          'checked_all'=>true,
          //是否使用ajax翻页
          'ajax'=>false,    
       ));
?>