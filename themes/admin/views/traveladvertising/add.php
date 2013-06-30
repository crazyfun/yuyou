<?php 
       $advertising_type=CV::$advertising_type;
       $region=Region::model();
       $start_region_select=$region->get_options_regions();
       $travel_advertising=TravelAdvertising::model();
       $position=$travel_advertising->get_travel_postion();
       $this->widget('AddItems', array( 
          'model'=>$model, 
          'name'=>'广告管理',
          //用户操作
          'user_operate'=>array(
              array(
               'name'=>'返回到广告管理',
               'value'=>$this->createUrl("index",array()),
             ),
             array(
				       'name'=>'新增广告',
				       'value'=>$this->createUrl("add",array())
				     ),
          ),
          //增加的内容字段
      'add_datas'=>array(
		   
      'title'=>array(
        'name'=>'标题',
        'type'=>'text',
        'value'=>'',
        'htmlOptions'=>array(),
       ), 
       
       'position'=>array(
        'name'=>'广告位置',
        'type'=>'select',
        'value'=>$position,
        'htmlOptions'=>array(),
       ), 
       
       'region_ids'=>array(
        'name'=>'出发地',
        'type'=>'multi',
        'value'=>$start_region_select,
        'htmlOptions'=>array('multiple'=>true,'size'=>'5'),
       ), 
       
      'type'=>array(
        'name'=>'广告类型',
        'type'=>'select',
        'value'=>$advertising_type,
        'htmlOptions'=>array(),
       ),  

       'content'=>array(
        'name'=>'内容',
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