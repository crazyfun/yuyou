<?php 
    $this->widget('AddItems', array( 
          'model'=>$model, 
          'name'=>'文档标签管理',
          //用户操作
          'user_operate'=>array(
              array(
               'name'=>'返回到文档标签管理',
               'value'=>$this->createUrl("index",array()),
             ),
             array(
				       'name'=>'新增文档标签',
				       'value'=>$this->createUrl("add",array())
				     ),
          ),
          //增加的内容字段
    'add_datas'=>array(
      'tag_name'=>array(
				'name'=>'标签',
				'type'=>'text',//搜索框的类型
				'value'=>'',
				'htmlOptions'=>array(),
      ),     
      'count'=>array(
        'name'=>'标签数',
        'type'=>'number',
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