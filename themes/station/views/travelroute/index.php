<?php
      
       $this->widget('SearchItems', array( 
          'model_name'=>'TravelRoute', 
          'user_operate'=>array(
              array(
               'name'=>'增加行程',
               'value'=>$this->createUrl("add",array('travel_id'=>$travel_id)),
              ),
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
							'name'=>'travel_id',
							'type'=>'raw',
							'value'=>'$data->show_attribute("travel_id")',
						 ),
 						array(
                'name'=>'route_day',
                'type'=>'raw',
                'value'=>'$data->show_attribute("route_day")',
             ),
             array(
                'name'=>'travel_route',
                'type'=>'raw',
                'value'=>'$data->show_attribute("travel_route")',
             ),
             array(
                'name'=>'route_describe',
                'type'=>'raw',
                'value'=>'$data->show_attribute("route_describe")',
             ),
             array(
                'name'=>'route_flight',
                'type'=>'raw',
                'value'=>'$data->show_attribute("route_flight")',
             ),
             array(
                'name'=>'route_stay',
                'type'=>'raw',
                'value'=>'$data->show_attribute("route_stay")',
             ),
             array(
                'name'=>'route_dining',
                'type'=>'raw',
                'value'=>'$data->show_attribute("route_dining")',
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
               'value'=>'javascript:batch_operate(\''.$this->createUrl("delete",array('travel_id'=>$travel_id)).'\');'
             ),
          ),
          //是否需要全选列
          'checked_all'=>true,
          //是否使用ajax翻页
          'ajax'=>false,    
       ));
?>