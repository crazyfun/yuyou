<?php 
    $region=Region::model();
    $start_region_select=$region->get_options_regions();
    $this->widget('AddItems', array( 
          'model'=>$model, 
          'name'=>'Flash广告管理',
          //用户操作
          'user_operate'=>array(
              array(
               'name'=>'返回到Flash广告管理',
               'value'=>$this->createUrl("index",array()),
             ),
             array(
				       'name'=>'新增Flash广告',
				       'value'=>$this->createUrl("add",array())
				     ),
          ),
          //增加的内容字段
    'add_datas'=>array( 
      'title'=>array(
				'name'=>'图片名称',
				'type'=>'text',//搜索框的类型
				'value'=>'',
				'htmlOptions'=>array(),
      ),
      'flash_img'=>array(
				'name'=>'广告图片',
				'type'=>'file',//搜索框的类型
				'value'=>'',
				'htmlOptions'=>array(),
      ), 
      'img_href'=>array(
				'name'=>'图片链接',
				'type'=>'text',//搜索框的类型
				'value'=>'',
				'htmlOptions'=>array(),
      ),    
      'region_ids'=>array(
        'name'=>'出发地',
        'type'=>'multi',
        'value'=>$start_region_select,
        'htmlOptions'=>array('multiple'=>true,'size'=>'5'),
       ), 
      'describe'=>array(
        'name'=>'描述',
        'type'=>'textarea',
        'value'=>'',
        'htmlOptions'=>array(),
       ),     
       'sort'=>array(
        'name'=>'排序',
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