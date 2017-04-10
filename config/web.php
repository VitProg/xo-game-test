<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'minimal',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'f43yuv3fvoq34fy2h4f8762g87rgtfd812gf',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableSession' => false
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
        'redis' => require(__DIR__ . '/redis.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'as contentNegotiator' => [
        'class' => '\yii\filters\ContentNegotiator',
        'formats' => [
            'application/octet-stream' => \yii\web\Response::FORMAT_JSON,
            'text/html' => \yii\web\Response::FORMAT_JSON,
            'application/json' => \yii\web\Response::FORMAT_JSON,
            'application/xml' => \yii\web\Response::FORMAT_XML,
        ],
    ],
    'params' => $params,
];

return $config;
