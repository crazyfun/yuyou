<?php 
       $channels=Channels::model();
       $channels_datas=$channels->get_move_select(0,0,"travel");
       $channels_datas=Util::com_search_item(array(''=>'不限'),$channels_datas);
       $this->widget('AddItems', array( 
          'model'=>$model, 
          'name'=>'克隆线路',
          //用户操作
          'user_operate'=>array( 
          ),
          //增加的内容字段
     'add_datas'=>array(
        'channel_id'=>array(
					'name'=>'克隆到',
					'type'=>'select',//搜索框的类型
					'value'=>$channels_datas,
					'htmlOptions'=>array(),
					'desc'=>'如果选择了不限，则为克隆线路的类型',
         ), 
         
       
			),

			 //最下面操作按钮
			'operates'=>array(
				array(
				   
				),
			),
    ));
?>
