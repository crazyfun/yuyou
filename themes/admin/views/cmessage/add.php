<?php 
       $config_values=ConfigValues::model();
	     $message_type=$config_values->get_ralation_values("6");
	     $message_status=CV::$message_status;
       
       
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
      'name'=>array(
				'name'=>'模块名称',
				'type'=>'text',//搜索框的类型
				'value'=>'',
				'htmlOptions'=>array(),
      ),     
      'identification'=>array(
        'name'=>'模块标识',
        'type'=>'text',
        'value'=>'',
        'htmlOptions'=>array(),
       ),     
      'view'=>array(
        'name'=>'模块视图',
        'type'=>'select',
        'value'=>$block_view,
        'htmlOptions'=>array(),
        ),
        
        
      'tlen'=>array(
        'name'=>'标题长度',
        'type'=>'number',
        'value'=>'',
        'htmlOptions'=>array(),
       ),
       
       'dott'=>array(
        'name'=>'显示...',
        'type'=>'radio',
        'value'=>CV::$block_dott,
        'htmlOptions'=>array('separator'=>'&nbsp;'),
       ),
       
       'dlen'=>array(
        'name'=>'描述长度',
        'type'=>'number',
        'value'=>'',
        'htmlOptions'=>array(),
       ),
       
      'size'=>array(
        'name'=>'图片尺寸',
        'type'=>'text',
        'value'=>'',
        'desc'=>'例如:400*300',
        'htmlOptions'=>array(),
       ),
      'archive_ids'=>array(
        'name'=>'指定文档',
        'type'=>'textarea',
        'desc'=>'多个文档请以,隔开',
        'htmlOptions'=>array(),
       ),
        
      'attr'=>array(
        'name'=>'文档属性',
        'type'=>'radio',
        'select'=>$block_attr,
        'value'=>$archive_att_select,
        'htmlOptions'=>array('separator'=>'&nbsp;'),
       ),
 
      'channel'=>array(
        'name'=>'文档栏目',
        'type'=>'select',
        'value'=>$channels_select,
        'htmlOptions'=>array(),
       ),
       
       'category'=>array(
        'name'=>'文档分类',
        'type'=>'select',
        'value'=>$category_select,
        'htmlOptions'=>array(),
       ),
       
       
       'sort'=>array(
        'name'=>'文档排序',
        'type'=>'select',
        'value'=>$sort_select,
        'htmlOptions'=>array(),
        ),
       'sort_type'=>array(
        'name'=>'排序规则',
        'type'=>'select',
        'value'=>CV::$block_sort_type,
        'htmlOptions'=>array(),
        ),
        
        'limit'=>array(
        	'name'=>'显示数量',
        	'type'=>'number',
        	'value'=>'',
        	'desc'=>'列表显示的条数，默认是10条',
        	'htmlOptions'=>array(),
        ),
        
        
       'cache'=>array(
        'name'=>'缓存时间',
        'type'=>'number',
        'value'=>'',
        'htmlOptions'=>array(),
        ), 
        
       'content'=>array(
        'name'=>'生成代码',
        'type'=>'textarea',
        'value'=>'',
        'htmlOptions'=>array('readonly'=>'readonly'),
        ), 
        
        
       
			),
			 //最下面操作按钮
			'operates'=>array(
				array(
				   
				),
			),
   ));
?>