<?php 
    $this->widget('AddItems', array( 
          'model'=>$model, 
          'name'=>'留言管理',
          //用户操作
          'user_operate'=>array(
             array(
               'name'=>'返回到留言管理',
               'value'=>$this->createUrl("index",array()),
             ),
          ),
          //增加的内容字段
    'add_datas'=>array(
       'replay'=>array(
        	'name'=>'回复内容',
        	'type'=>'textarea',
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