<?php 

       $this->widget('AddItems', array( 
          'model'=>$model, 
          //用户操作
          'user_operate'=>array(
              array(
               'name'=>'返回到修改密码管理',
               'value'=>$this->createUrl("index",array()),
             ),
          ),
          //增加的内容字段
          'add_datas'=>array(
             'new_password'=>array(
               'name'=>'新密码',
               'type'=>'text',//搜索框的类型
               'value'=>'',
               'htmlOptions'=>array(),
               'desc'=>''
               
               
             ),
             
             'con_new_password'=>array(
                'name'=>'确认新密码',
                'type'=>'text',
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
       
    
    



    
    
    
    
    



