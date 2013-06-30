<?php 
	   $friendlink_types=Util::com_search_item(array(''=>'请选择类型'),$model->get_friendlink_type());
       $this->widget('AddItems', array( 
          'model'=>$model, 
          'name'=>'友情链接',
          //用户操作
          'user_operate'=>array(
              array(
               'name'=>'返回到友情链接列表',
               'value'=>$this->createUrl("index",array()),
             ),
             array(
				       'name'=>'新增友情链接',
				       'value'=>$this->createUrl("add",array())
				     ),
          ),
          //增加的内容字段
          'add_datas'=>array(
		     'friendlink_img'=>array(
				'name'=>'网站LOGO',
				'type'=>'file',
				'value'=>'',
				'htmlOptions'=>array(),
			 ),

             'friendlink_name'=>array(
				'name'=>'链接名称',
				'type'=>'text',//搜索框的类型
				'value'=>'',
				'htmlOptions'=>array(),
             ),
             
             'friendlink_href'=>array(
                'name'=>'链接地址',
                'type'=>'text',
                'value'=>'',
                'htmlOptions'=>array(),
             ),

			 'friendlink_type'=>array(
				'name'=>'网站类型',
				'type'=>'select',
				'value'=>$friendlink_types,
				'htmlOptions'=>array(),
			 ),

			 'friendlink_sort'=>array(
				'name'=>'链接排序',
				'type'=>'text',
				'value'=>'',
				'htmlOptions'=>array(),
			 ),
             
             'friendlink_desc'=>array(
                'name'=>'网站简介',
                'type'=>'multitext',
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