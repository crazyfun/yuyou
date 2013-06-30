<?php 
       $this->widget('AddItems', array( 
          'model'=>$model, 
          'name'=>'保险',
          //用户操作
          'user_operate'=>array(
              array(
               'name'=>'返回到保险列表列表',
               'value'=>$this->createUrl("index",array()),
             ),
             array(
				       'name'=>'新增保险',
				       'value'=>$this->createUrl("add",array())
				     ),
          ),
          //增加的内容字段
     'add_datas'=>array(
        'insurance_name'=>array(
					'name'=>'保险名称',
					'type'=>'text',//搜索框的类型
					'value'=>'',
					'htmlOptions'=>array(),
         ), 
		    'insurance_company'=>array(
						'name'=>'保险公司',
						'type'=>'text',
						'value'=>'',
						'htmlOptions'=>array(),
			 ),

			 'company_address'=>array(
				'name'=>'公司地址',
				'type'=>'text',
				'value'=>'',
				'htmlOptions'=>array(),
			 ),

			 'contacter'=>array(
				'name'=>'联系人',
				'type'=>'text',
				'value'=>'',
				'htmlOptions'=>array(),
			 ),    
       'contacter_phone'=>array(
          'name'=>'联系电话',
          'type'=>'text',
          'value'=>'',
          'htmlOptions'=>array(),
       ),
       
       'insurance_price'=>array(
          'name'=>'保险价钱',
          'type'=>'number',
          'value'=>'',
          'htmlOptions'=>array(),
       ),
       
       
       'insurance_date'=>array(
          'name'=>'保险期限',
          'type'=>'number',
          'value'=>'',
          'tip'=>'天',
          'htmlOptions'=>array(),
       ),
       
       
       'start_time'=>array(
             'name'=>'签约开始时间',
             'type'=>'date',
             'value'=>'',
              'htmlOptions'=>array(),
       ),
       
       'end_time'=>array(
             'name'=>'签约到期时间',
             'type'=>'date',
             'value'=>'',
              'htmlOptions'=>array(),
       ),
       
       'insurance_desc'=>array(
             'name'=>'保险描述',
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