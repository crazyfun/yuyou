<?php
	   $friendlink_types=Util::com_search_item(array(''=>'请选择类型'),$model->get_friendlink_type());
       $this->widget('SearchItems', array( 
          'model_name'=>'FriendLink', 
          'user_operate'=>array(
              array(
               'name'=>'增加友情链接',
               'value'=>$this->createUrl("add",array()),
              ),
          ),
          //搜索的内容字段
          'search_datas'=>array(
             'friendlink_name'=>array(
               'name'=>'友情链接的名称',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['friendlink_name'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
			 'friendlink_href'=>array(
				'name'=>'友情链接的地址',
				'type'=>'text',
				'select'=>$page_params['friendlink_href'],
				'value'=>'',
				'htmlOptions'=>array(),
			 ),
			 'friendlink_type'=>array(
				'name'=>'友情链接类型',
				'type'=>'select',
				'select'=>$page_params['friendlink_type'],
				'value'=>$friendlink_types,
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
				'name'=>'friendlink_img',
				'type'=>'raw',
				'value'=>'$data->show_friendlink_img();',
			 ),

             array(
                'name'=>'friendlink_name',
                'type'=>'raw',
                'value'=>'$data->friendlink_name',
             ),
			  
             array(
                'name'=>'friendlink_href',
                'type'=>'raw',
                'value'=>'$data->friendlink_href',
             ),
			 
			 array(
				'name'=>'friendlink_type',
				'type'=>'raw',
				'value'=>'$data->Type->type_name',
			 ),

			 array(
				'name'=>'friendlink_sort',
				'type'=>'raw',
				'value'=>'$data->friendlink_sort',
			 ),
              
			 array(
                'name'=>'friendlink_desc',
                'type'=>'raw',
                'value'=>'$data->friendlink_desc',
             ),
              
             array(
                'name'=>'create_id',
                'type'=>'raw',
                'value'=>'$data->User->real_name',
             ),
			
             array(
                'name'=>'create_time',
                'type'=>'raw',
                'value'=>'$data->format_create_time()',
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