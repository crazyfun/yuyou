<?php 
       $this->widget('AddItems', array( 
          'model'=>$model, 
          'name'=>'',
          //用户操作
          'user_operate'=>array(
              array(
               'name'=>'返回到下载链接列表',
               'value'=>$this->createUrl("index",array('downloads_id'=>$model->downloads_id)),
             ),
             array(
				       'name'=>'新增下载链接列表',
				       'value'=>$this->createUrl("add",array('downloads_id'=>$model->downloads_id))
				     ),
          ),
          //增加的内容字段
     'add_datas'=>array(
        'downloads_id'=>array(
					'name'=>'',
					'type'=>'hidden',//搜索框的类型
					'value'=>'',
					'htmlOptions'=>array(),
         ), 
        'server_name'=>array(
					'name'=>'服务器名称',
					'type'=>'text',//搜索框的类型
					'value'=>'',
					'htmlOptions'=>array(),
         ), 
         
       'server_address'=>array(
					'name'=>'服务器地址',
					'type'=>'text',//搜索框的类型
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