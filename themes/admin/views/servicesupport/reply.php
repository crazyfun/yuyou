<?php 
       $this->widget('AddItems', array( 
          'model'=>$model, 
          'name'=>'回复',
          //用户操作
          'user_operate'=>array(
              array(
               'name'=>'返回到详细页',
               'value'=>$this->createUrl("view",array('id'=>$model->relation_id)),
             ),
          ),
          //增加的内容字段
       'add_datas'=>array(
		     'reply_content'=>array(
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