<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',
	// application components
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.components.payment.*',
		'application.components.widgets.*',	
		'application.components.widgets.travel.*',
		'application.extensions.*',
		'application.extensions.image.*',
		'application.extensions.phpmail.*',
		'application.extensions.ipconvert.*',
		'application.extensions.LinkListPager.*',
		'application.extensions.yiidebugtb.*',
		'application.extensions.excel.*',
		'application.extensions.excel.PHPExcel.*',
		'application.extensions.libchart.*',
		'application.helpers.*',
	),
	'language'=>'zh_cn',
	'components'=>array(
		'db'=>array(
		  'class'=>'system.db.CDbConnection',
			'connectionString' => 'mysql:host=localhost;dbname=yuyou',
			'emulatePrepare'=> true,
			'username' => 'yuyou',
			'password' => 'yuyou@2013',
			'charset' => 'utf8',
			'tablePrefix'=>'tr_',
			'schemaCachingDuration'=>3600,
		),
	),
);
