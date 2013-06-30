<?php 
       $parent_menus=Util::com_search_item(array('0'=>'一级菜单'),$model->get_top_parent_menu());
       $this->widget('AddItems', array( 
          'model'=>$model, 
          'name'=>'后台菜单',
          //用户操作
          'user_operate'=>array(
              array(
               'name'=>'返回到后台菜单管理',
               'value'=>$this->createUrl("index",array()),
             ),
             array(
               'name'=>'新增菜单',
               'value'=>$this->createUrl("add",array())
             ),
          ),
          //增加的内容字段
          'add_datas'=>array(
             'menu_name'=>array(
               'name'=>'菜单名称',
               'type'=>'text',//搜索框的类型
               'value'=>'',
               'htmlOptions'=>array(),
               'desc'=>''
               
               
             ),
             
             'menu_alias'=>array(
               'name'=>'菜单别名',
               'type'=>'text',//搜索框的类型
               'value'=>'',
               'htmlOptions'=>array(),
               'desc'=>''
               
               
             ),
             
             'menu_parent'=>array(
                'name'=>'父菜单',
                'type'=>'select',
                'value'=>$parent_menus,
                'htmlOptions'=>array(),
             ),
             
             'menu_sort'=>array(
                'name'=>'菜单排序',
                'type'=>'text',
                'value'=>'',
                'htmlOptions'=>array(),
             ),
             
             
             'menu_controller'=>array(
                'name'=>'菜单控制器',
                'type'=>'text',
                'value'=>'',
                'htmlOptions'=>array(),
                'desc'=>'一级分类：控制器为空，二级分类：控制器的名称。不填则继承父类的控制器'
             ),
             
              'menu_action'=>array(
                'name'=>'菜单方法',
                'type'=>'text',
                'value'=>'',
                'htmlOptions'=>array(),
                'desc'=>'控制器的方法名称,默认为index'
             ),
             
             'is_show'=>array(
                'name'=>'是否显示',
                'type'=>'select',
                'value'=>CV::$is_show_select,
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
       
    
    



    
    
    
    
    



