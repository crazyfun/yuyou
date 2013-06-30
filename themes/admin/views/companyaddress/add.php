<?php 
    
       $this->widget('AddItems', array( 
          'model'=>$model, 
          'name'=>'上车地点',
          //用户操作
          'user_operate'=>array(
              array(
               'name'=>'返回到上车地点列表',
               'value'=>$this->createUrl("index",array()),
             ),
             array(
				       'name'=>'新增上车地点',
				       'value'=>$this->createUrl("add",array())
				     ),
          ),
          //增加的内容字段
     'add_datas'=>array(
        'time'=>array(
					'name'=>'上车时间',
					'type'=>'date',//搜索框的类型
					'value'=>'',
					'htmlOptions'=>array('dateFmt'=>'H:m:s'),
         ), 
		    'address'=>array(
						'name'=>'上车地址',
						'type'=>'text',
						'value'=>'',
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