<?php 
       $user=User::model();
       $user_datas=$user->findAll("t.company_id=:company_id AND t.admin_status=:admin_status",array(':company_id'=>$this->company_id,':admin_status'=>'2'));
       $operate_user=array();
       foreach($user_datas as $key => $value){
       	 $operate_user[$value->id]=$value->real_name;
       }
       $this->widget('AddItems', array( 
          'model'=>$model, 
          'name'=>'关联订单',
          //用户操作
          'user_operate'=>array(
              array(
               'name'=>'返回到订单列表',
               'value'=>$this->createUrl("index",array()),
             ),
           
          ),
          //增加的内容字段
     'add_datas'=>array(
			  'goperate_id'=>array(
				'name'=>'操作用户',
				'type'=>'select',
				'value'=>$operate_user,
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