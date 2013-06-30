<?php 
       $company_address=CompanyAddress::model();
       $address_select=$company_address->get_address_select("0");
       $this->widget('AddItems', array( 
          'model'=>$model, 
          'name'=>'',
          //用户操作
          'user_operate'=>array(
              array(
               'name'=>'返回到上车地点列表',
               'value'=>$this->createUrl("index",array('travel_id'=>$model->travel_id)),
             ),
             array(
				       'name'=>'新增上车地点',
				       'value'=>$this->createUrl("add",array('travel_id'=>$model->travel_id))
				     ),
          ),
          //增加的内容字段
     'add_datas'=>array(
     
        'travel_id'=>array(
					'name'=>'',
					'type'=>'hidden',//搜索框的类型
					'value'=>'',
					'htmlOptions'=>array(),
         ), 
         
        
         'address_id'=>array(
               'name'=>'上车地点',
               'type'=>'select',//搜索框的类型
               'value'=>$address_select,
               'htmlOptions'=>array(),
               'desc'=>''
          ),
			),
			 //最下面操作按钮
			'operates'=>array(
				array(
				   
				),
			),
   ));
?>