<?php 
       $this->widget('AddItems', array( 
          'model'=>$model, 
          'name'=>'友情链接类型',
          //用户操作
          'user_operate'=>array(
              array(
               'name'=>'返回到友情链接类型列表',
               'value'=>$this->createUrl("index",array()),
             ),
             array(
               'name'=>'新增友情连接类型',
               'value'=>$this->createUrl("add",array())
             ),
          ),
          //增加的内容字段
          'add_datas'=>array(
             'type_name'=>array(
               'name'=>'友情链接类型名称',
               'type'=>'text',//搜索框的类型
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
       
    
    



    
    
    
    
    



