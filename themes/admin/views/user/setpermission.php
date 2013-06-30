<?php 
        $admin_status=Util::com_search_item(array(''=>'是否是创始人'),CV::$admin_status);
        $station=new Station();
        $station_select=$station->get_station_select();
        $station_select=Util::com_search_item(array(''=>'选择分站','0'=>'主站'),$station_select);
       $this->widget('SearchItems', array( 
          'model_name'=>'User', 
          'user_operate'=>array(
              array(
              
             ),
          ),
          //搜索的内容字段
          'search_datas'=>array(
             'user_login'=>array(
               'name'=>'用户名/ID',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['user_login'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
             'real_name'=>array(
               'name'=>'真实姓名',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['real_name'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
             'user_email'=>array(
               'name'=>'用户Email',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['user_email'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
             'cell_phone'=>array(
               'name'=>'联系电话',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['cell_phone'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
             'admin_status'=>array(
               'name'=>'创始人',
               'type'=>'select',//搜索框的类型
               'select'=>$page_params['admin_status'],
               'value'=>$admin_status,
               'htmlOptions'=>array(),
             ),
             
             'station_id'=>array(
               'name'=>'分站',
               'type'=>'select',//搜索框的类型
               'select'=>$page_params['station_id'],
               'value'=>$station_select,
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
                'name'=>'user_login',
                'type'=>'raw',
                'value'=>'$data->user_login',
              ),
              
             array(
                'name'=>'real_name',
                'type'=>'raw',
                'value'=>'$data->real_name',
              ),
              
            array(
                'name'=>'user_email',
                'type'=>'raw',
                'value'=>'$data->user_email',
              ),
              
            array(
                'name'=>'cell_phone',
                'type'=>'raw',
                'value'=>'$data->cell_phone',
            ),
            
            
            array(
                'name'=>'station_id',
                'type'=>'raw',
                'value'=>'$data->show_station()',
            ),
            array(
                'name'=>'admin_status',
                'type'=>'raw',
                'value'=>'$data->show_admin_status()',
            
            ),
            
            array(
                'name'=>'permissions',
                'type'=>'raw',
                'value'=>'$data->show_user_permissions()',
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
          ),
          //批量操作按钮
          'operates'=>array(
             array(
             ),
          ),
          //是否需要全选列
          'checked_all'=>false,
          //是否使用ajax翻页
          'ajax'=>false,    
       ));
       
       ?>



