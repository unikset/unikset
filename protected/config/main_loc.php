<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Unikset local host',
        
        'sourceLanguage'=>'en',
    
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
                //Модуль администрирования
                'dashboard'=>array(),
		
	),

	// application components
	'components'=>array(
                'request'=>array(
                    'enableCookieValidation'=>true,
                    'enableCsrfValidation'=>true,
                ),
		'user'=>array(
                        //override class CWebUser
                        'class'=>'WebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
                        'loginUrl'=>array('user/login'),
                        //'returnUrl'=>'/',
		),
                'authManager'=>array(
                        //Перегружаем менеджер авторизации
                        'class'=>'PhpAuthManager',
                ),

		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
                        'class'=>'application.components.UrlManager',
                        //'languages'=>array('en','ru','uk'),
                        //'langParam'=>'lang',
			'urlFormat'=>'path',
                        'showScriptName' => false,
			'rules'=>array(
                                '<language:\w{2}>/<controller:\w+>/<id:\d+>'=>'<controller>/view',
                                '<language:\w{2}>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                                '<language:\w{2}>/<controller:\w+>/<action:\w+>/*'=>'<controller>/<action>',

//				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
//				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
//				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		*/
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=unikset',
			'emulatePrepare' => true,
			'username' => 'mysql',
			'password' => 'mysql',
			'charset' => 'utf8',
                        // включаем профайлер
                        'enableProfiling'=>true,
                        // показываем значения параметров
                        'enableParamLogging' => true,
		),
		
		'errorHandler'=>array(
                     // use 'site/error' action to display errors
                    'errorAction'=>'site/error',
                ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
                                array(
                                    // направляем результаты профайлинга в ProfileLogRoute (отображается
                                    // внизу страницы)
                                    'class'=>'CProfileLogRoute',
                                    'levels'=>'profile',
                                    'enabled'=>true,
                                ),
				// uncomment the following to show log messages on web pages
				
				array(
					'class'=>'CWebLogRoute',
                                        'categories' => 'application',
                                        'showInFireBug' => true,
                                        'levels'=>'error, warning, trace, profile, info',
				),
                                array(
                                    'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                                    'ipFilters'=>array('127.0.0.1'),
                                ),

				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
                'languages'=>require(dirname(__FILE__).'/languages.php'),
	),
);