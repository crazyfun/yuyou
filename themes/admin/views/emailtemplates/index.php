<?php 
       $template_type=Util::com_search_item(array('模板类型'),CV::$template_type);
       $this->widget('SearchItems', array( 
          'model_name'=>'EmailTemplates', 
          'user_operate'=>array(
              array(
               'name'=>'增加模版',
               'value'=>$this->createUrl("add",array()),
             ),
          ),
          //搜索的内容字段
          'search_datas'=>array(
             'templates_name'=>array(
               'name'=>'模版名称',
               'type'=>'text',//搜索框的类型
               'value'=>'',
               'htmlOptions'=>array(),
             ),  
             
             'type'=>array(
               'name'=>'模版类型',
               'type'=>'select',//搜索框的类型
               'value'=>$template_type,
               'htmlOptions'=>array(),
             ),
                         
          ), 
          'dataprovider'=>$dataProvider,
          
          
          //列表显示的字段
          'attributes'=>array(
             array(
                'name'=>'id',
                'type'=>'raw',//字段的属性 参考yii
                'value'=>'$data->id',//如果为空则以$data->id为值 如果有值则 已$data->func()填充
              ),
             array(
                'name'=>'templates_name',
                'type'=>'raw',
                'value'=>'$data->templates_name',
              ),
             
              array(
                'name'=>'templates_title',
                'type'=>'raw',
                'value'=>'$data->templates_title',
              ),
             array(
                'name'=>'type',
                'type'=>'raw',
                'value'=>'$data->show_attribute("type")',
              ),
              
             array(
                'name'=>'templates_content',
                'type'=>'raw',
                'value'=>'$data->templates_content',
              ),
              
           
              
            array(
                'name'=>'create_id',
                'type'=>'raw',
                'value'=>'$data->User->user_login',
            ),
			
            array(
                'name'=>'create_time',
                'type'=>'raw',
                'value'=>'$data->format_create_time()',
            ),
              
            array(
                'name'=>'操作',
                'type'=>'raw',
                'value'=>'$data->get_operate()',
              ),
          
          ),
          //批量操作按钮
          'operates'=>array(
             array(
               'name'=>'删除所有',
               'value'=>'javascript:batch_operate(\''.$this->createUrl("delete",array()).'\');'
             ),
          ),
          //是否需要全选列
          'checked_all'=>true,
          //是否使用ajax翻页
          'ajax'=>false,    
       ));
?>