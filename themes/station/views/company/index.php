<?php
    
       $this->widget('SearchItems', array( 
          'model_name'=>'Company', 
          'user_operate'=>array(
             
          ),
          //搜索的内容字段
          'search_datas'=>array(
            
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
            
          ),
          //是否需要全选列
          'checked_all'=>true,
          //是否使用ajax翻页
          'ajax'=>false,    
       ));
?>