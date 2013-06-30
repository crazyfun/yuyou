<?php 
       $this->widget('SearchItems', array( 
          'model_name'=>'Permissions', 
          'user_operate'=>array(
              array(
               'name'=>'增加权限',
               'value'=>$this->createUrl("add",array()),
             ),
          ),
          //搜索的内容字段
          'search_datas'=>array(
             'permissions_name'=>array(
               'name'=>'权限名',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['permissions_name'],
               'value'=>'',
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
                'name'=>'permissions_name',
                'type'=>'raw',
                'value'=>'$data->permissions_name',
              ),
              
             array(
                'name'=>'permissions_value',
                'type'=>'raw',
                'value'=>'$data->get_permissions_value_name()',
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



