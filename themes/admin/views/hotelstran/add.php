<?php 
       $this->widget('AddItems', array( 
          'model'=>$model, 
          'name'=>'',
          //用户操作
          'user_operate'=>array(
              array(
               'name'=>'返回到酒店交通列表',
               'value'=>$this->createUrl("index",array('hotels_id'=>$model->hotels_id)),
             ),
             array(
				       'name'=>'新增酒店交通',
				       'value'=>$this->createUrl("add",array('hotels_id'=>$model->hotels_id))
				     ),
          ),
          //增加的内容字段
     'add_datas'=>array(
     
        'hotels_id'=>array(
					'name'=>'',
					'type'=>'hidden',//搜索框的类型
					'value'=>'',
					'htmlOptions'=>array(),
         ), 
         
        
        'tran_name'=>array(
					'name'=>'交通信息',
					'type'=>'text',//搜索框的类型
					'value'=>'',
					'htmlOptions'=>array(),
         ), 
         
        'sort_order'=>array(
					'name'=>'排序',
					'type'=>'number',//搜索框的类型
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