<?php 
       $coupon_type=CV::$consume_type;
       $this->widget('AddItems', array( 
          'model'=>$model, 
          //用户操作
          'user_operate'=>array(
              array(
               'name'=>'返回到用户管理',
               'value'=>$this->createUrl("index",array()),
             ),
          ),
          //增加的内容字段
          'add_datas'=>array(
          
             'user_id'=>array(
               'name'=>'',
               'type'=>'hidden',//搜索框的类型
               'value'=>'',
               'htmlOptions'=>array(),
               'desc'=>''
             ),
             'type'=>array(
               'name'=>'类型',
               'type'=>'select',//搜索框的类型
               'value'=>$coupon_type,
               'htmlOptions'=>array(),
               'desc'=>''
             ),

             'value'=>array(
                'name'=>'值',
                'type'=>'number',
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
       
    
    



    
    
    
    
    



