<?php
class ErrorController extends AController
{

 public function actions()
	{
		return array(
			'page'=>array(
				'class'=>'CViewAction',
		  ),
		  'error404'=>'application.station.controllers.error.Error404Action',
		  'error403'=>'application.station.controllers.error.Error403Action',
		  'error500'=>'application.station.controllers.error.Error500Action',
		);
	}
}
