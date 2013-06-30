<?php 
       $region=Region::model();
       $regions_datas=$region->get_options_regions();
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
          
             'company_id'=>array(
               'name'=>'公司',
               'type'=>'auto',//搜索框的类型
               'value'=>$model->Company->company_name,
               'htmlOptions'=>array('serviceUrl'=>'/admin.php/main/company'),
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
       
    
    



    
    
    
    
    



