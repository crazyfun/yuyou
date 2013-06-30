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
             'name'=>array(
               'name'=>'模版名称',
               'type'=>'text',//搜索框的类型
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             'theme_dir'=>array(
               'name'=>'模版路径',
               'type'=>'text',//搜索框的类型
               'value'=>'',
               'htmlOptions'=>array(),
             ),        
             'theme_preview'=>array(
               'name'=>'缩略图',
               'type'=>'file',//搜索框的类型
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             'make_name'=>array(
               'name'=>'制作人',
               'type'=>'text',//搜索框的类型
               'value'=>'',
               'htmlOptions'=>array(),
             ),            
             'make_time'=>array(
               'name'=>'制作时间',
               'type'=>'date',//搜索框的类型
               'value'=>'',
               'htmlOptions'=>array(),
             ),             
             'theme_desc'=>array(
                'name'=>'模版描述',
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
       
    
    



    
    
    
    
    



