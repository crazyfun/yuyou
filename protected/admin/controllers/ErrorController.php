<?php
class ErrorController extends AController
{

 public function actions()
	{
		return array(
			'page'=>array(
				'class'=>'CViewAction',
		  ),
		  'error404'=>'application.admin.controllers.error.Error404Action',
		  'error403'=>'application.admin.controllers.error.Error403Action',
		  'error500'=>'application.admin.controllers.error.Error500Action',
		);
	}
}
