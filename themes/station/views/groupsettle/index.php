<?php
       $group_settle=CV::$group_settle;
       $group_settle=Util::com_search_item(array(''=>'不限'),$group_settle);
       $this->widget('SearchItems', array( 
          'model_name'=>'TravelOrder', 
          'user_operate'=>array(
          ),
          //搜索的内容字段
          'search_datas'=>array(
             'group_title'=>array(
               'name'=>'产品名称',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['group_title'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
              'settle_status'=>array(
               'name'=>'结算状态',
               'type'=>'select',//搜索框的类型
               'select'=>$page_params['settle_status'],
               'value'=>$group_settle,
               'htmlOptions'=>array(),
             ),
					 
          ), 
          'dataprovider'=>$dataProvider,
          //列表显示的字段
          'attributes'=>array(
			 			array(
							'name'=>'title',
							'type'=>'raw',
							'value'=>'$data->show_attribute("title")',
						 ),

            
            array(
                'name'=>'总价',
                'type'=>'raw',
                'value'=>'$data->get_all_price($data->id)',
             ),
             
             array(
                'name'=>'总结算',
                'type'=>'raw',
                'value'=>'$data->get_all_settle_price($data->id)',
             ),

            
            
             array(
                'name'=>'结算状态',
                'type'=>'raw',
                'value'=>'$data->show_attribute("settle_status")',
             ),
             array(
                'name'=>'操作',
                'type'=>'raw',
                'value'=>'$data->get_settle_operate()',
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