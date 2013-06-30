<?php 
  
    $move_select=$model->get_move_select("0","",$pattern);
    $this->widget('AddItems', array( 
          'model'=>$model, 
          'name'=>'移动栏目',
          //用户操作
          'user_operate'=>array(
          ),
          //增加的内容字段
    	'add_datas'=>array( 
      	'parent_id'=>array(
					'name'=>'父栏目',
					'type'=>'select',//搜索框的类型
					'value'=>$move_select,
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