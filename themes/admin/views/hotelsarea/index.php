<?php
      
       $this->widget('SearchItems', array( 
          'model_name'=>'HotelsArea', 
          'user_operate'=>array(
              array(
               'name'=>'增加周边景区',
               'value'=>$this->createUrl("add",array('hotels_id'=>$hotels_id)),
              ),
          ),
          //搜索的内容字段
          'search_datas'=>array(
             'hotels_id'=>array(
               'name'=>'',
               'type'=>'hidden',//搜索框的类型
               'select'=>$hotels_id,
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             'area_name'=>array(
               'name'=>'景区名称',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['area_name'],
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
							'name'=>'hotels_id',
							'type'=>'raw',
							'value'=>'$data->show_attribute("hotels_id")',
						 ),
 						array(
                'name'=>'area_name',
                'type'=>'raw',
                'value'=>'$data->show_attribute("area_name")',
             ),
         
             array(
                'name'=>'sort_order',
                'type'=>'raw',
                'value'=>'$data->show_attribute("sort_order")',
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
               'value'=>'javascript:batch_operate(\''.$this->createUrl("delete",array('hotels_id'=>$hotels_id)).'\');'
             ),
          ),
          //是否需要全选列
          'checked_all'=>true,
          //是否使用ajax翻页
          'ajax'=>false,    
       ));
?>