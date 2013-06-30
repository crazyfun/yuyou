<?php 
       $this->widget('AddItems', array( 
          'model'=>$model, 
          'name'=>'',
          //用户操作
          'user_operate'=>array(
              array(
               'name'=>'返回到线路景区列表',
               'value'=>$this->createUrl("index",array('travel_id'=>$model->travel_id)),
             ),
             array(
				       'name'=>'新增线路景区',
				       'value'=>$this->createUrl("add",array('travel_id'=>$model->travel_id))
				     ),
          ),
          //增加的内容字段
     'add_datas'=>array(
     
        'travel_id'=>array(
					'name'=>'',
					'type'=>'hidden',//搜索框的类型
					'value'=>'',
					'htmlOptions'=>array(),
         ), 
         
        
        'travel_area'=>array(
					'name'=>'景区名称',
					'type'=>'text',//搜索框的类型
					'value'=>'',
					'htmlOptions'=>array(),
         ), 
         
         'import'=>array(
					'name'=>'导入景区图',
					'type'=>'check',//搜索框的类型
					'value'=>'',
					'desc'=>'导入和景区名称相同的景区图片',
					'htmlOptions'=>array(),
         ), 
         
			),

			 //最下面操作按钮
			'operates'=>array(
				array(
				   
				),
			),
       ));
?>