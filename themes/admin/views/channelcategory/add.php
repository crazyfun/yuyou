<?php 
       $parent_select=$model->get_select('0');
       $parent_select=Util::com_search_item(array('0'=>'根分类'),$parent_select);
       $this->widget('AddItems', array( 
          'model'=>$model, 
          'name'=>'栏目分类',
          //用户操作
          'user_operate'=>array(
              array(
               'name'=>'返回到栏目分类列表',
               'value'=>$this->createUrl("index",array()),
             ),
             array(
               'name'=>'新增栏目分类',
               'value'=>$this->createUrl("add",array())
             ),
          ),
          //增加的内容字段
          'add_datas'=>array(
             'name'=>array(
               'name'=>'分类名称',
               'type'=>'text',//搜索框的类型
               'value'=>'',
               'htmlOptions'=>array(),
             ),
             
            'parent_id'=>array(
               'name'=>'父类',
               'type'=>'select',//搜索框的类型
               'value'=>$parent_select,
               'htmlOptions'=>array(),
             ),
             
             'sort'=>array(
               'name'=>'排序',
               'type'=>'number',//搜索框的类型
               'value'=>$parent_select,
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
       
    
    



    
    
    
    
    



