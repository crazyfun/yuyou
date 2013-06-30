<?php
class ErrorController extends Controller
{
	
	public $breadcrumbs=array();
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
public function filters() {
		return array(
		  'accessControl', // perform access control for CRUD operations
		);
	}
	
 public function actions()
	{
		return array(
			'page'=>array(
				'class'=>'CViewAction',
		  ),
		  'error404'=>'application.controllers.error.Error404Action',
		  'error403'=>'application.controllers.error.Error403Action',
		  'error500'=>'application.controllers.error.Error500Action',
		  'errorover'=>'application.controllers.error.ErroroverAction'
		);
	}
}
