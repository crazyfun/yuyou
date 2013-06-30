<?php
  $config_values=ConfigValues::model();
  $type=$config_values->get_ralation_values(10);
  $type=Util::com_search_item(array(''=>'类型'),$type);
  $support_status=Util::com_search_item(array(''=>'回复状态'),CV::$support_status);

       $this->widget('SearchItems', array( 
          'model_name'=>'ServiceCustom', 
          'user_operate'=>array(
              array(
               
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
             
             
              'type'=>array(
               'name'=>'类型',
               'type'=>'select',//搜索框的类型
               'select'=>$page_params['type'],
               'value'=>$type,
               'htmlOptions'=>array(),
             ),
             
             'status'=>array(
               'name'=>'回复状态',
               'type'=>'select',//搜索框的类型
               'select'=>$page_params['status'],
               'value'=>$support_status,
               'htmlOptions'=>array(),
             ),
             
              'start_time'=>array(
               'name'=>'开始时间',
               'type'=>'date',//搜索框的类型
               'select'=>$page_params['start_time'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
             'end_time'=>array(
               'name'=>'结束时间',
               'type'=>'date',//搜索框的类型
               'select'=>$page_params['end_time'],
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
							'name'=>'title',
							'type'=>'raw',
							'value'=>'$data->title',
						 ),
						array(
							'name'=>'type',
							'type'=>'raw',
							'value'=>'$data->show_attribute("type")',
						 ),
         
             array(
                'name'=>'create_time',
                'type'=>'raw',
                'value'=>'$data->show_attribute("create_time")',
             ),
			  
             array(
                'name'=>'status',
                'type'=>'raw',
                'value'=>'$data->show_attribute("status");',
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