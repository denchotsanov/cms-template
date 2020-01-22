<?php

use yii\web\Request;

$baseUrl = str_replace('/backend/web', '', (new Request)->getBaseUrl()) . '/admin';

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-admin',
    'version'=>'2.0.0',
    'name'=> 'ADmin',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'rbac'=>[]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => $baseUrl,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_identity-backend',
                'httpOnly' => true
            ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'tsadmin-backend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'baseUrl' => $baseUrl,
            'scriptUrl' => '/backend/web/index.php',
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => 'site/index',
                'login' => 'site/login',
                'signup' => 'site/signup',
                'logout' => 'site/logout',
                '<controller:[\w-]+>/<action:[\w-]+>/<id:\d+>' => '<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];
