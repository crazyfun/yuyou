<?php
       $this->widget('SearchItems', array( 
          'model_name'=>'Insurance', 
          'user_operate'=>array(
              array(
               'name'=>'增加保险',
               'value'=>$this->createUrl("add",array()),
              ),
          ),
          //搜索的内容字段
          'search_datas'=>array(
             'insurance_name'=>array(
               'name'=>'保险名称',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['insurance_name'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
             
             'insurance_company'=>array(
               'name'=>'保险公司',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['insurance_company'],
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
							'name'=>'insurance_name',
							'type'=>'raw',
							'value'=>'$data->show_attribute("insurance_name")',
						 ),

             array(
                'name'=>'insurance_company',
                'type'=>'raw',
                'value'=>'$data->show_attribute("insurance_company")',
             ),
			  
             array(
                'name'=>'company_address',
                'type'=>'raw',
                'value'=>'$data->show_attribute("company_address");',
             ),
             
              array(
                'name'=>'contacter',
                'type'=>'raw',
                'value'=>'$data->show_attribute("contacter");',
             ),
             
              array(
                'name'=>'contacter_phone',
                'type'=>'raw',
                'value'=>'$data->show_attribute("contacter_phone");',
             ),
             
              array(
                'name'=>'insurance_price',
                'type'=>'raw',
                'value'=>'$data->show_attribute("insurance_price");',
             ),
             
              array(
                'name'=>'insurance_desc',
                'type'=>'raw',
                'value'=>'$data->show_attribute("insurance_desc");',
             ),
             
              array(
                'name'=>'insurance_date',
                'type'=>'raw',
                'value'=>'$data->show_attribute("insurance_date");',
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