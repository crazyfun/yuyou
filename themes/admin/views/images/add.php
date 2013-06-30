<?php 
       $images_category=ImagesCategory::model();
  		 $category_select=$images_category->get_select('0');
       $this->widget('AddItems', array( 
          'model'=>$model, 
          'name'=>'图片',
          //用户操作
          'user_operate'=>array(
              array(
               'name'=>'返回到图片列表',
               'value'=>$this->createUrl("index",array()),
             ),
             array(
               'name'=>'新增图片',
               'value'=>$this->createUrl("add",array())
             ),
          ),
          //增加的内容字段
          'add_datas'=>array(
             'name'=>array(
               'name'=>'图片名称',
               'type'=>'text',//搜索框的类型
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
            'category_id'=>array(
               'name'=>'分类',
               'type'=>'select',//搜索框的类型
               'value'=>$category_select,
               'htmlOptions'=>array(),
             ),
             
              'src'=>array(
               'name'=>'图片',
               'type'=>'file',//搜索框的类型
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
             'desc'=>array(
               'name'=>'图片描述',
               'type'=>'multitext',//搜索框的类型
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
       
    
    



    
    
    
    
    



