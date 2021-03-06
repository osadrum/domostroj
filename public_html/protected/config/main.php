<?php
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Я хочу дом',
    'language' => 'ru',
    'theme' => 'domostroj',
	// preloading 'log' component
	'preload'=>array('log', 'bootstrap'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.extensions.*',
        'ext.YiiMailer.YiiMailer',
    ),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
            'generatorPaths'=>array(
                'bootstrap.gii',
            ),
			'class'=>'system.gii.GiiModule',
			'password'=>'gii',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
        'pages'=>array(
            'cacheId'=>'pagesPathsMap',
        ),
        'admin',
        'catalog'
    ),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
        'authManager'=>array(
            'class'=>'PhpAuthManager',
            'defaultRoles' => array('guest'),
        ),
		'urlManager'=>array(
			'urlFormat'=>'path',
            'showScriptName'=>false,
            'rules'=>array(
                array('class'=>'application.modules.pages.components.PagesUrlRule'),
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
        'clientScript' => array(
            'scriptMap' => array(
                'jquery.js' => '/js/jquery.js',
            ),
        ),
        'db'=> require('db.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
        'bootstrap'=>array(
            'class'=>'ext.bootstrap.components.Bootstrap',
        ),
        'image' => array(
            'class' => 'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver' => 'GD',
            // ImageMagick setup path
            'params' => array('directory' => '/usr/bin'),
        ),
        'cache'=>array(
            'class'=>'CFileCache',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
    'params'=>array(
        // this is used in contact page
        'adminEmail'=>'webmaster@example.com',
        'imageTypes' => array("jpg","jpeg","gif","png"),
        'docTypes' => array("pdf","doc","docx","xls","xlsx","jpg","txt"),
        'sizeLimit' => 100 * 1024 * 1024,
        'imageSizeCategory' => array(
            'small' => array(459, 182),
        ),
        'imageSizeProject' => array(
            'small' => array(368, 207),
            'medium' => array(600, 338),
            'large' => array(1920, 1080),
        ),
        'imageSizeGallery' => array(
            'small' => array(368, 207),
            'medium' => array(600, 338),
            'large' => array(1920, 1080),
        ),
        'imageSizeSlider' => array(
            'small' => array(340, 191),
            'high' => array(1920, 1080),
        ),
        'imageSizeReview' => array(
            'small' => array(100, 100),
        ),
        'imageQuality' => 100,
        'imagePath' => '/upload/images/',
        'docPath' => '/upload/docs/',
        'CKEditorTool' => array(
            array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
            array( 'TextColor', 'BGColor'),
            array('NumberedList', 'BulletedList','JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock','list'),
            array('Styles', 'Format', 'Font', 'FontSize' ),
            array( 'Image', 'Youtube', 'Link', 'Unlink','Maximize', 'ShowBlocks'),
            array('Paste', 'PasteText', 'PasteFromWord','Undo', 'Redo')
        )
    )
);
