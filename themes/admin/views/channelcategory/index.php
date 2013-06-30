<?php 
       $parent_select=$model->get_select('0');
       $parent_select=Util::com_search_item(array(''=>'选择父类'),$parent_select);
       $this->widget('SearchItems', array( 
          'model_name'=>'ChannelCategory', 
          'user_operate'=>array(
              array(
               'name'=>'增加栏目分类',
               'value'=>$this->createUrl("add",array()),
             ),
          ),
          //搜索的内容字段
          'search_datas'=>array(
             'name'=>array(
               'name'=>'分类名称',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['name'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
             'parent_id'=>array(
               'name'=>'父类',
               'type'=>'select',//搜索框的类型
               'select'=>$page_params['parent_id'],
               'value'=>$parent_select,
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
                'name'=>'name',
                'type'=>'raw',
                'value'=>'$data->name',
              ),
           array(
                'name'=>'parent_id',
                'type'=>'raw',
                'value'=>'$data->show_attribute("parent_id")',
              ),  
           array(
                'name'=>'sort',
                'type'=>'raw',
                'value'=>'$data->sort',
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



