<?php
      $travel_area=TravelArea::model();
      $travel_area_select=$travel_area->get_select($travel_id);
      $travel_area_select=Util::com_search_item(array(''=>"景区名称"),$travel_area_select);
       $this->widget('SearchItems', array( 
          'model_name'=>'TravelImages', 
          'user_operate'=>array(
              array(
               'name'=>'增加线路图片',
               'value'=>$this->createUrl("add",array('travel_id'=>$travel_id)),
              ),
          ),
          //搜索的内容字段
          'search_datas'=>array(
             'travel_area'=>array(
               'name'=>'景区名称',
               'type'=>'select',//搜索框的类型
               'select'=>$page_params['travel_area'],
               'value'=>$travel_area_select,
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
							'name'=>'travel_id',
							'type'=>'raw',
							'value'=>'$data->show_attribute("travel_id")',
						 ),
 						array(
                'name'=>'travel_area_id',
                'type'=>'raw',
                'value'=>'$data->show_attribute("travel_area_id")',
             ),
        		 array(
                'name'=>'image_id',
                'type'=>'raw',
                'value'=>'$data->show_attribute("image_id")',
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