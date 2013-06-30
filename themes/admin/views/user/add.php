<?php 
       $admin_status=CV::$admin_status;
       if(!empty($model->id)){
       	 $user_login_options=array('readonly'=>'readonly');
       }else{
       	 $user_login_options=array();
       }
       $this->widget('AddItems', array( 
          'model'=>$model, 
          'name'=>'用户',
          //用户操作
          'user_operate'=>array(
              array(
               'name'=>'返回到用户管理',
               'value'=>$this->createUrl("index",array()),
             ),
              array(
               'name'=>'新增用户',
               'value'=>$this->createUrl("add",array())
             ),
          ),
          //增加的内容字段
          'add_datas'=>array(
             'user_login'=>array(
               'name'=>'用户名',
               'type'=>'text',//搜索框的类型
               'value'=>'',
               'htmlOptions'=>$user_login_options,
               'desc'=>'新增的用户默认密码为:admin_123456'
               
               
             ),
             
             'real_name'=>array(
                'name'=>'真实姓名',
                'type'=>'text',
                'value'=>'',
                'htmlOptions'=>array(),
             ),
             
             'user_email'=>array(
                'name'=>'用户邮箱',
                'type'=>'text',
                'value'=>'',
                'htmlOptions'=>array(),
             ),
             
             
             'genter'=>array(
                'name'=>'性别',
                'type'=>'select',
                'value'=>CV::$sex,
                'htmlOptions'=>array(),
             ),
             
              'credits'=>array(
                'name'=>'积分',
                'type'=>'number',
                'value'=>'',
                'htmlOptions'=>array(),
             ),
             
             'conpon'=>array(
                'name'=>'抵用卷',
                'type'=>'number',
                'value'=>'',
                'htmlOptions'=>array('readonly'=>'readonly'),
             ),
             
              'birthday'=>array(
                'name'=>'生日',
                'type'=>'date',
                'value'=>'',
                'htmlOptions'=>array(),
             ),
             
             'code'=>array(
                'name'=>'身份证',
                'type'=>'text',
                'value'=>'',
                'htmlOptions'=>array(),
             ),
             
             
             'cell_phone'=>array(
                'name'=>'联系电话',
                'type'=>'text',
                'value'=>'',
                'htmlOptions'=>array(),
             ),
             
             'address'=>array(
                'name'=>'联系地址',
                'type'=>'text',
                'value'=>'',
                'htmlOptions'=>array(),
             ),
             
            'admin_status'=>array(
                'name'=>'管理员',
                'type'=>'select',
                'value'=>CV::$admin_status,
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
       
    
    



    
    
    
    
    



