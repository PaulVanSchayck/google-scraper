<?php

// Quick and dirty environment switching for deployment
if ( isset($_SERVER['APIKEY']) ) {
    $params['secret']['apikey'] = $_SERVER['APIKEY'];
    $db = [
        'class' => 'yii\db\Connection',
        'dsn' => "mysql:host={$_SERVER['RDS_HOSTNAME']};dbname=google-scraper",
        'username' => $_SERVER['RDS_USERNAME'],
        'password' => $_SERVER['RDS_PASSWORD'],
        'charset' => 'utf8',
    ];
} else {
    $params = require(__DIR__ . '/params.php');
    $db = require(__DIR__ . '/db.php');
}


$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'ASIqK6KEt6CXbO02NaOJ',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
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
            ],
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
