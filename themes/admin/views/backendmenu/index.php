<?php 
       $parent_menus=Util::com_search_item(array(''=>'父菜单'),$model->get_top_parent_menu());
       $this->widget('SearchItems', array( 
          'model_name'=>'BackendMenu', 
          'user_operate'=>array(
              array(
               'name'=>'增加后台菜单',
               'value'=>$this->createUrl("add",array()),
             ),
          ),
          //搜索的内容字段
          'search_datas'=>array(
             'menu_name'=>array(
               'name'=>'菜单名称',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['menu_name'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
             'menu_parent'=>array(
               'name'=>'父菜单',
               'type'=>'select',//搜索框的类型
               'select'=>$page_params['menu_parent'],
               'value'=>$parent_menus,
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
                'name'=>'menu_name',
                'type'=>'raw',
                'value'=>'$data->show_menu_name()',
              ),
              
             array(
                'name'=>'menu_parent',
                'type'=>'raw',
                'value'=>'$data->BackendMenu->menu_name',
              ),
              
            array(
                'name'=>'menu_sort',
                'type'=>'raw',
                'value'=>'$data->menu_sort',
              ),
              
            array(
                'name'=>'menu_controller',
                'type'=>'raw',
                'value'=>'$data->menu_controller',
            ),
            
             array(
                'name'=>'menu_action',
                'type'=>'raw',
                'value'=>'$data->menu_action',
            ),
          
             array(
                'name'=>'is_show',
                'type'=>'raw',
                'value'=>'$data->show_is_show()',
            ),  
            array(
                'name'=>'create_id',
                'type'=>'raw',
                'value'=>'$data->User->real_name',
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



