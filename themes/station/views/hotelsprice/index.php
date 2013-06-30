<?php
      
       $this->widget('SearchItems', array( 
          'model_name'=>'HotelsPrice', 
          'user_operate'=>array(
              array(
               'name'=>'增加房型',
               'value'=>$this->createUrl("add",array('bed_id'=>$bed_id)),
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
							'name'=>'bed_id',
							'type'=>'raw',
							'value'=>'$data->show_attribute("bed_id")',
						 ),
 					
             array(
                'name'=>'price',
                'type'=>'raw',
                'value'=>'$data->show_attribute("price")',
             ),
               array(
                'name'=>'price_desc',
                'type'=>'raw',
                'value'=>'$data->show_attribute("price_desc")',
             ),
              array(
                'name'=>'o_price',
                'type'=>'raw',
                'value'=>'$data->show_attribute("o_price")',
             ),
             
              array(
                'name'=>'settle_price',
                'type'=>'raw',
                'value'=>'$data->show_attribute("settle_price")',
             ),
             
              array(
                'name'=>'settle_price_desc',
                'type'=>'raw',
                'value'=>'$data->show_attribute("settle_price_desc")',
             ),
             
              array(
                'name'=>'line',
                'type'=>'raw',
                'value'=>'$data->show_attribute("line")',
             ),
             
              array(
                'name'=>'bed',
                'type'=>'raw',
                'value'=>'$data->show_attribute("bed")',
             ),
             
              array(
                'name'=>'breakfast',
                'type'=>'raw',
                'value'=>'$data->show_attribute("breakfast")',
             ),
             
              array(
                'name'=>'numbers',
                'type'=>'raw',
                'value'=>'$data->show_attribute("numbers")',
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
               'value'=>'javascript:batch_operate(\''.$this->createUrl("delete",array('bed_id'=>$bed_id)).'\');'
             ),
          ),
          //是否需要全选列
          'checked_all'=>true,
          //是否使用ajax翻页
          'ajax'=>false,    
       ));
?>