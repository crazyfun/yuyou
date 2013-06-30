<?php   
    									$this->widget('zii.widgets.CListView',array(
													'dataProvider'=>$dataProvider,
													'itemView'=>"message/".$view,
													'ajaxUpdate'=>$ajaxUpdate,
													'summaryText'=>'',
						              'summaryCssClass'=>'',
													'viewData'=>array('cssPath'=>$cssPath,'jsPath'=>$jsPath),
												));
?>

