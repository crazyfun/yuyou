<?php
	   $information_category=InformationCategory::model();
	   $parent_select=Util::com_search_item(array(''=>'请选择分类'),$information_category->get_parent_select(CV::$model_type['help']));
       $this->widget('SearchItems', array( 
          'model_name'=>'Information', 
          'user_operate'=>array(
              array(
               'name'=>'增加帮助',
               'value'=>$this->createUrl("add",array()),
              ),
          ),
          //搜索的内容字段
          'search_datas'=>array(
             'title'=>array(
               'name'=>'标题',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['title'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
     
					 'type_id'=>array(
							'name'=>'分类',
							'type'=>'select',
							'select'=>$page_params['type_id'],
							'value'=>$parent_select,
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
							'name'=>'title',
							'type'=>'raw',
							'value'=>'$data->title',
						 ),

             array(
                'name'=>'information_image',
                'type'=>'raw',
                'value'=>'$data->show_attribute("information_image")',
             ),
			  
             array(
                'name'=>'type_id',
                'type'=>'raw',
                'value'=>'$data->show_attribute("type_id");',
             ),
			 
		
			 				array(
								'name'=>'sort',
								'type'=>'raw',
								'value'=>'$data->sort',
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