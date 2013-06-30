<?php
       $this->widget('SearchItems', array( 
          'model_name'=>'HotelsImages', 
          'user_operate'=>array(
              array(
               'name'=>'增加酒店图片',
               'value'=>$this->createUrl("add",array('hotels_id'=>$hotels_id)),
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
							'name'=>'hotels_id',
							'type'=>'raw',
							'value'=>'$data->show_attribute("hotels_id")',
						 ),
 					
        		 array(
                'name'=>'image_id',
                'type'=>'raw',
                'value'=>'$data->show_attribute("image_id")',
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