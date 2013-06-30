<?php
       $channels=Channels::model();
       $channels_select=$channels->get_channel_select('0','',"travel");
       $channels_select=Util::com_search_item(array(''=>'选择栏目'),$channels_select);
       $channel_category=ChannelCategory::model();
       $category_select=$channel_category->get_select("0");
       $category_select=Util::com_search_item(array(''=>'选择分类'),$category_select);
       $config_values=ConfigValues::model();
       $archive_att=$config_values->get_select_values('1');
       $archive_att=Util::com_search_item(array(''=>'线路属性'),$archive_att);
       $archives_status=CV::$archives_status;
       array_pop($archives_status);
       $status=Util::com_search_item(array(''=>'审核状况'),$archives_status);
       $region=Region::model();
       if($page_params['status']=='3'){
        $operate=array(
             array(
               'name'=>'彻底删除所有',
               'value'=>'javascript:batch_operate(\''.$this->createUrl("delete",array()).'\');'
             ),
        );
      }else{
      	 $operate=array(
             array(
               'name'=>'批量删除',
               'value'=>'javascript:batch_operate(\''.$this->createUrl("status",array('status'=>'3')).'\');'
             ),
             
             array(
               'name'=>'批量审核',
               'value'=>'javascript:batch_operate(\''.$this->createUrl("status",array('status'=>'2')).'\');'
            ),
        );
      }
       $this->widget('SearchItems', array( 
          'model_name'=>'Archives', 
          'user_operate'=>array(
              array(
               'name'=>'线路管理',
               'value'=>$this->createUrl("index",array('channel_id'=>$page_params['channel_id'])),
             ),
             array(
				       'name'=>'新增线路',
				       'value'=>$this->createUrl("add",array('channel_id'=>$page_params['channel_id']))
				     ),
				     array(
				       'name'=>'栏目管理',
				       'value'=>$this->createUrl("channels/index",array())
				     ),
				     array(
				       'name'=>'审核线路',
				       'value'=>$this->createUrl("index",array('status'=>'1','channel_id'=>$page_params['channel_id']))
				     ),
				    
				      array(
				       'name'=>'线路回收站',
				       'value'=>$this->createUrl("index",array('status'=>'3','channel_id'=>$page_params['channel_id']))
				     ),
          ),
      //搜索的内容字段
     'search_datas'=>array(
       'keyword'=>array(
               'name'=>'关键字',
               'type'=>'text',//搜索框的类型
               'select'=>$page_params['keyword'],
               'value'=>'',
               'htmlOptions'=>array(),
        ),
        'channel_id'=>array(
               'name'=>'栏目',
               'type'=>'select',//搜索框的类型
               'select'=>$page_params['channel_id'],
               'value'=>$channels_select,
               'htmlOptions'=>array(),
        ),

         'region_id'=>array(
               'name'=>'出发地',
               'type'=>'ajaxselect',//搜索框的类型
               'select'=>$page_params['region_id'],
               'value'=>'',
               'htmlOptions'=>array('title'=>'可直接选择城市或输入城市','text_value'=>$page_params['region_id_text'],'type_value'=>'region','tabs'=>"[{'name':'城市','url':'/api/region','id':'','type':'region'}]",'serviceUrl'=>"/api/mixregion",'multi'=>false,'level'=>3),
        ),
         'attr'=>array(
               'name'=>'属性',
               'type'=>'select',//搜索框的类型
               'select'=>$page_params['attr'],
               'value'=>$archive_att,
               'htmlOptions'=>array(),
        ),
        
         'company_id'=>array(
               'name'=>'所属公司',
               'type'=>'auto',//搜索框的类型
               'select'=>$page_params['company_id'],
               'value'=>$page_params['company_name'],
               'htmlOptions'=>array('serviceUrl'=>'/admin.php/main/company'),
        ),
         'status'=>array(
               'name'=>'审核状态',
               'type'=>'select',//搜索框的类型
               'select'=>$page_params['status'],
               'value'=>$status,
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
         'name'=>'channel_id',
         'type'=>'raw',
         'value'=>'$data->show_attribute("channel_id")',
    	 ),
			  
    	
     	 array(
         'name'=>'start_region',
         'type'=>'raw',
         'value'=>'$data->show_attribute("start_region")',
     	),
     	
     	 array(
         'name'=>'end_region',
         'type'=>'raw',
         'value'=>'$data->show_attribute("end_region")',
     	),
     	
    
     	
     	array(
			  'name'=>'title',
			  'type'=>'raw',
			  'value'=>'$data->show_attribute("title")',
			),
			array(
			  'name'=>'number',
			  'type'=>'raw',
			  'value'=>'$data->show_attribute("number")',
			),
			array(
			  'name'=>'company_id',
			  'type'=>'raw',
			  'value'=>'$data->show_company_name()',
			),
		
			
			
			array(
			  'name'=>'出发时间',
			  'type'=>'raw',
			  'value'=>'$data->show_travel_date()',
			),
			
			array(
			  'name'=>'线路景区',
			  'type'=>'raw',
			  'value'=>'$data->show_travel_scenic()',
			),
			
			array(
			  'name'=>'线路行程',
			  'type'=>'raw',
			  'value'=>'$data->show_travel_route()',
			),

			array(
			  'name'=>'景区图片',
			  'type'=>'raw',
			  'value'=>'$data->show_travel_images()',
			),
			
			array(
			  'name'=>'报名地点',
			  'type'=>'raw',
			  'value'=>'$data->show_travel_company()',
			),
			array(
			  'name'=>'上车地点',
			  'type'=>'raw',
			  'value'=>'$data->show_travel_address()',
			),
			
			array(
				'name'=>'update_time',
				'type'=>'raw',
				'value'=>'$data->show_attribute("update_time")',
			),
			
			array(
				'name'=>'status',
				'type'=>'raw',
				'value'=>'$data->show_attribute("status")',
			),
			
			array(
				'name'=>'create_id',
				'type'=>'raw',
				'value'=>'$data->show_attribute("create_id")',
			),
			
			
    	array(
         'name'=>'操作',
         'type'=>'raw',
          'value'=>'$data->get_operate()',
      ),
          
     ),
          //批量操作按钮
        'operates'=>$operate,
          //是否需要全选列
          'checked_all'=>true,
          //是否使用ajax翻页
          'ajax'=>false,    
       ));
?>