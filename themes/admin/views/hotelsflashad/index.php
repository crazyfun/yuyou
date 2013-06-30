<?php
       $this->widget('SearchItems', array( 
          'model_name'=>'FlashAd', 
          'user_operate'=>array(
              array(
               'name'=>'增加flash广告',
               'value'=>$this->createUrl("add",array()),
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
         'name'=>'title',
         'type'=>'raw',
         'value'=>'$data->show_attribute("title")',
     	),
    	 array(
         'name'=>'flash_img',
         'type'=>'raw',
         'value'=>'$data->show_attribute("flash_img")',
     	),
			array(
			  'name'=>'img_href',
			  'type'=>'raw',
			  'value'=>'$data->img_href'
			),
			array(
				'name'=>'describe',
				'type'=>'raw',
				'value'=>'$data->describe',
			),
			
			array(
				'name'=>'sort',
				'type'=>'raw',
				'value'=>'$data->sort',
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