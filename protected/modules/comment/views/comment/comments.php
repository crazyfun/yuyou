<?php
		Yii::app()->clientScript->registerScriptFile('/js/jbox/jquery.jBox-2.3.min.js');
    Yii::app()->clientScript->registerScriptFile('/js/jbox/i18n/jquery.jBox-zh-CN.js');
    
?>
<?php   
    	$this->widget('zii.widgets.CListView',array(
						'dataProvider'=>$dataProvider,
						'itemView'=>$comment_item,
						'ajaxUpdate'=>'comments_datas',
						'ajaxUpdate'=>true,
						'summaryText'=>'',
						'summaryCssClass'=>'',
						'enablePagination'=>$enablePagination,
						'viewData'=>array('level'=>$level,'user_flag'=>$user_flag),
				));
       
?>