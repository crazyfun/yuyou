<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',
	// application components
	'import'=>array(
		'application.models.Traveorder',
		'application.extensions.phpmail.*',
		'application.helpers.*',
	),
	'language'=>'zh_cn',
	'components'=>array(
		'db'=>array(
		  'class'=>'system.db.CDbConnection',
			'connectionString' => 'mysql:host=localhost;dbname=yeetu2',
			'emulatePrepare'=> true,
			'username' => 'root',
			'password' => '111111',
			'charset' => 'utf8',
			'tablePrefix'=>'yt_',
			'schemaCachingDuration'=>3600,
		),
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
	),
);