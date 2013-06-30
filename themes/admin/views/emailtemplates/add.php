<?php 
       $this->widget('AddItems', array( 
          'model'=>$model, 
          'name'=>'模版',
          //用户操作
          'user_operate'=>array(
              array(
               'name'=>'返回到模版列表',
               'value'=>$this->createUrl("index",array()),
             ),
             array(
				       'name'=>'新增模版',
				       'value'=>$this->createUrl("add",array())
				     ),
          ),
          //增加的内容字段
          'add_datas'=>array(
             
             'templates_name'=>array(
               'name'=>'模版名称',
               'type'=>'text',//搜索框的类型
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             'templates_title'=>array(
               'name'=>'模版主题',
               'type'=>'text',//搜索框的类型
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
             'type'=>array(
               'name'=>'模版类型',
               'type'=>'select',//搜索框的类型
               'value'=>CV::$template_type,
               'htmlOptions'=>array(),
             ),
             
             
             'templates_content'=>array(
                'name'=>'模版内容',
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
       
    
    



    
    
    
    
    



