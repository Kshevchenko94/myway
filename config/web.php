<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'language' => 'ru-RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'datecontrol' =>  [
            'class' => '\kartik\datecontrol\Module',

            // format settings for displaying each date attribute (ICU format example)
            'displaySettings' => [
                \kartik\datecontrol\Module::FORMAT_DATE => 'php:j F Y',
                \kartik\datecontrol\Module::FORMAT_TIME => 'hh:mm:ss',
                \kartik\datecontrol\Module::FORMAT_DATETIME => 'php:j F Y H:i:s',
            ],

            // format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                \kartik\datecontrol\Module::FORMAT_DATE => 'php:Y-m-d',
                \kartik\datecontrol\Module::FORMAT_TIME => 'php:H:i:s',
                \kartik\datecontrol\Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
            ],

            'autoWidget' => true,

        ]
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'QYVSgP8mMb5SgP9uSdqI9n0Uo7lcIBw8',
			'baseUrl'=>'',
        ],
		'formatter' => [
			'class' => 'yii\i18n\Formatter',
			'dateFormat' => 'php:j F Y',
			'datetimeFormat' => 'php:j F Y в H:i:s',
			'timeFormat' => 'php:H:i:s',
            'locale' => 'ru-RU',
            'timeZone'=>'Europe/Moscow',
		],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
			'loginUrl' => ['login/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'profile/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
				'goals'=>'goals/index',
				'goals/id/<id:\d+>'=>'goals/view',
				'news'=>'news/index',
				'news/update/<id:\d+>'=>'news/update',
				'news/delete/<id:\d+>'=>'news/delete',
				'profile/edit'=>'profile/edit',
				'search'=>'profile/search',
				'profile/avatar/<id:\d+>'=>'profile/avatar',
				'profile/<id:\d+>'=>'profile/index',
				'signup'=>'login/signup',
				''=>'login/login',
				'logout/<id:\d+>'=>'login/logout',
            ],
        ],
        'storage' => [
            'class'=>'app\components\Storage',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    /*$config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];*/

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
