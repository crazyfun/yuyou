<?php 

    $this->widget('AddItems', array( 
          'model'=>$model, 
          'name'=>'文档关键字管理',
          //用户操作
          'user_operate'=>array(
              array(
               'name'=>'返回到文档关键字管理',
               'value'=>$this->createUrl("index",array()),
             ),
             array(
				       'name'=>'新增文档',
				       'value'=>$this->createUrl("add",array())
				     ),
          ),
          //增加的内容字段
    'add_datas'=>array(
      'name'=>array(
				'name'=>'关键字',
				'type'=>'text',//搜索框的类型
				'value'=>'',
				'htmlOptions'=>array(),
      ),     
      'href'=>array(
        'name'=>'链接',
        'type'=>'text',
        'value'=>'',
        'htmlOptions'=>array(),
       ),     
      'percent'=>array(
        'name'=>'百分比',
        'type'=>'text',
        'value'=>'',
        'desc'=>'替换的关键字的百分比',
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