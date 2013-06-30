<?php
//session_start();
//$region_data=$_SESSION['region_session'];
// uncomment the following to define a path alias
//Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'誉游网',
  'homeUrl'=>'http://www.lypub.com',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
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
	'theme'=>'default',
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'1qaz2wsx',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			//'ipFilters'=>array('127.0.0.1','::1'),
		),
		"comment"=>array(
				'layout'=> 'application.modules.comment.views.layouts.main',
		),

	),

	// application components
	'components'=>array(
		'user'=>array(  
        //'class'=>'CWebUser',//你可以自定义你的Cwebuser  
        //'identityCookie'=>array('domain' => '.lypub.com','path' => '/'),//配置用户cookie作用域  
        // enable cookie-based authentication  
        'allowAutoLogin'=>true,//允许同步登录  
        'stateKeyPrefix'=>'yuyou',//你的前缀，必须指定为一样的  
        'loginUrl'=>array('/login/index'),  
    ),  
    'session' => array(  
        //'cookieParams' => array('domain' =>'.lypub.com','lifetime' => 0),//配置会话ID作用域 生命期和超时  
        //'timeout' => '',  
        //这里千万不要指定cookieMode => none，否则无法对应sessionid导致无法登录，更别说同步了。（有些不负责的博客竟然说同步登录需要设定这个属性为none！！！！太坑爹了。。。）  
    ),   
    'statePersister'=>array( //指定cookie加密的状态文件  
        'class'=>'CStatePersister',//指定类       
        //'stateFile'=>'/protected/runtime/state.bin',//配置通用状态文件路径，注意，如果你的站点是分布式的，你必须把该文件复制一份到不同服务器上，否则无法跨域。因为里面有个通用密钥，密钥不同则无法验证身份。  
    ),  
    
    
		'urlManager'=>array(
			'urlFormat'=>'path',
			'urlSuffix'=>'.shtml',
			'showScriptName'=>false,
			'rules'=>array(
         //'http://'.$region_data['english'].'.yuyou.com/channel_<channel:\w+>'=>array('/travel/index', 'urlSuffix'=>'', 'urlFormat'=>'path','caseSensitive'=>false),
			 ),
			),
			
			'request'=>array(
          'enableCookieValidation'=>true,
        	'enableCsrfValidation'=>false,
      ),
        
			'authManager'=>array(
         'class'=>'CDbAuthManager',//认证类名称
         'defaultRoles'=>array('guest'),//默认角色
         'itemTable' => 'tr_authitem',//认证项表名称
         'itemChildTable' => 'tr_authitemchild',//认证项父子关系
         'assignmentTable' => 'tr_authassignment',//认证项赋权关系
       ),
       
		

		// uncomment the following to use a MySQL database
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
		'errorHandler'=>array(
          'errorAction'=>'error/error404',
      ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning,trace',
				),
				
                array( // configuration for the toolbar
                    'class'=>'XWebDebugRouter',
                    'config'=>'alignLeft, opaque, runInDebug, fixedPos, collapsed, yamlStyle', 
                    'levels'=>'error, warning, trace, profile, info',
                    'allowedIPs'=>array('127.0.0.1','::1','192.168.1.54','192\.168\.1[0-5]\.[0-9]{3}'),
                ),
                
                                
	/*
								 array(
                    'class'=>'CWebLogRoute',
                    'levels'=>'trace',     //级别为trace
                    'categories'=>'system.db.*' //只显示关于数据库信息,包括数据库连接,数据库执行语句
          
                 ),
                 
                 */
           
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),


	'cache2'=>array(
            'class'=>'system.caching.CMemCache',
            'servers'=>array(
                array('host'=>'127.0.0.1', 'port'=>11211, 'weight'=>60),
                array('host'=>'127.0.0.1', 'port'=>11211, 'weight'=>40),
            ),
        ),
/*

     'cache2'=>array(
            'class'=>'system.caching.CFileCache',
     ),
*/
        
     'cache'=>array(
            'class'=>'system.caching.CFileCache',
     ),

    'request'=>array(
          'enableCookieValidation'=>true,
        	'enableCsrfValidation'=>false,
    ),
		'session'=>array(
			'class'=>'CDbHttpSession',
			'connectionID' => 'db',
      'sessionTableName' => 'dbsession',
		 ),

		'image'=>array(
            'class'=>'application.extensions.image.CImageComponent',
            'driver'=>'GD', 
        ),
	),

 'params'=>array(
	   'web_salt'=>'artEr#@119tA35vB&*',
	   'default_password'=>'admin_123456',
	   'phone_name'=>'crazy_fun',
	   'phone_password'=>'357896321',
	   'web_domain'=>'.lypub.com',
	),
	
/*
	'clientScript'=>array(
     'scriptMap'=>array(
      'global.css'=>'/assets/56c897c1/global.css',
     ),
   ),
*/


);
