<?php
       $channels=Channels::model();
       $channels_select=$channels->get_channel_select('0','',"hotels");
       $channels_select=Util::com_search_item(array(''=>'选择栏目'),$channels_select);
       $channel_category=ChannelCategory::model();
       $category_select=$channel_category->get_select("59");
       $category_select=Util::com_search_item(array(''=>'选择分类'),$category_select);
       $config_values=ConfigValues::model();
       $archive_att=$config_values->get_select_values('1');
       $archive_att=Util::com_search_item(array(''=>'酒店属性'),$archive_att);
       $archives_status=CV::$archives_status;
       array_pop($archives_status);
       $status=Util::com_search_item(array(''=>'审核状况'),$archives_status);
       $region=Region::model();
       if($page_params['status']=='3'){
        $operate=array(
            
        );
      }else{
      	 $operate=array(
             
            
        );
      }
       $this->widget('SearchItems', array( 
          'model_name'=>'Archives', 
          'user_operate'=>array(
              array(
               'name'=>'酒店管理',
               'value'=>$this->createUrl("index",array('channel_id'=>$page_params['channel_id'])),
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
        
        'category_id'=>array(
               'name'=>'分类',
               'type'=>'select',//搜索框的类型
               'select'=>$page_params['category_id'],
               'value'=>$category_select,
               'htmlOptions'=>array(),
        ),
        
        
         'hotel_region'=>array(
               'name'=>'酒店区域',
               'type'=>'ajaxselect',//搜索框的类型
               'select'=>$page_params['hotel_region'],
               'value'=>'',
               'htmlOptions'=>array('title'=>'可直接选择城市或输入城市','text_value'=>$page_params['hotel_region_text'],'type_value'=>'region','tabs'=>"[{'name':'城市','url':'/api/region','id':'','type':'region'}]",'serviceUrl'=>"/api/mixregion",'multi'=>false,'level'=>3),
        ),
         'attr'=>array(
               'name'=>'属性',
               'type'=>'select',//搜索框的类型
               'select'=>$page_params['attr'],
               'value'=>$archive_att,
               'htmlOptions'=>array(),
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
         'name'=>'category_id',
         'type'=>'raw',
         'value'=>'$data->show_attribute("category_id")',
     	),
     	 array(
         'name'=>'hotel_region',
         'type'=>'raw',
         'value'=>'$data->show_attribute("hotel_region")',
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
			  'name'=>'hotel_address',
			  'type'=>'raw',
			  'value'=>'$data->show_attribute("hotel_address")',
			),
			
			array(
			  'name'=>'hotel_level',
			  'type'=>'raw',
			  'value'=>'$data->show_attribute("hotel_level")',
			),
			
			
			array(
			  'name'=>'brand_id',
			  'type'=>'raw',
			  'value'=>'$data->show_attribute("brand_id")',
			),
			array(
			  'name'=>'酒店房型',
			  'type'=>'raw',
			  'value'=>'$data->show_hotels_beds()',
			),
			array(
			  'name'=>'周边景区',
			  'type'=>'raw',
			  'value'=>'$data->show_hotels_area()',
			),

		array(
			  'name'=>'酒店图片',
			  'type'=>'raw',
			  'value'=>'$data->show_hotels_images()',
			),
			
			array(
			  'name'=>'交通信息',
			  'type'=>'raw',
			  'value'=>'$data->show_hotels_tran()',
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
          'value'=>'$data->get_hotels_operate()',
      ),
          
     ),
          //批量操作按钮
        'operates'=>$operate,
          //是否需要全选列
          'checked_all'=>false,
          //是否使用ajax翻页
          'ajax'=>false,    
       ));
?>