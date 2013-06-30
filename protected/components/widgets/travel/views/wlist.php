
<?php   

    									$this->widget('zii.widgets.CListView',array(
													'dataProvider'=>$dataProvider,
													'itemView'=>"list/".$list_view,
													'ajaxUpdate'=>$ajaxUpdate,
													'summaryText'=>'',
						              'summaryCssClass'=>'',
													'viewData'=>array('cssPath'=>$cssPath,'jsPath'=>$jsPath),
												));
?>

