<?php 

       $this->widget('SearchItems', array( 
          'model_name'=>'User', 
          'user_operate'=>array(
              array(
               
             ),
          ),
          //搜索的内容字段
          'search_datas'=>array(
             'create_id'=>array(
               'name'=>'用户名/ID',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['create_id'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
             'login_ip'=>array(
               'name'=>'登录IP',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['login_ip'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
             'login_address'=>array(
               'name'=>'登录地址',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['login_address'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
              'start_date'=>array(
               'name'=>'登录开始时间',
               'type'=>'date',//搜索框的类型
               'select'=>$page_params['start_date'],
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             'end_date'=>array(
               'name'=>'登录结束时间',
               'type'=>'date',//搜索框的类型
               'select'=>$page_params['end_date'],
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
                'name'=>'create_id',
                'type'=>'raw',
                'value'=>'$data->User->user_login',
              ),
              
             array(
                'name'=>'login_ip',
                'type'=>'raw',
                'value'=>'$data->login_ip',
              ),
              
            array(
                'name'=>'login_address',
                'type'=>'raw',
                'value'=>'$data->login_address',
              ),
              
            array(
                'name'=>'login_time',
                'type'=>'raw',
                'value'=>'$data->format_login_time()',
            ),
              
          
          ),
         //批量操作按钮
          'operates'=>array(
             array(
               
             ),
          ),
          //是否需要全选列
          'checked_all'=>true,
          //是否使用ajax翻页
          'ajax'=>false,   
       ));
       
       ?>



