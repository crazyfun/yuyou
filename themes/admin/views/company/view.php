<?php
       $this->widget('ViewItems', array( 
          'model'=>$model, 
          'view_datas'=>array(
              'company_name'=>'公司名称',
              'company_type'=>'公司性质',
              'region_id'=>'所属区域',
              'contact'=>'联系人',
              'contact_phone'=>'联系电话',
              'telephone'=>'公司座机',
              'email'=>'公司邮箱',
              'address'=>'公司地址',
              'traffic'=>'交通指南',
              'qq1'=>'联系qq1',
              'qq2'=>'联系qq2',
              'qq3'=>'联系qq3',
              
          ),
       ));
?>