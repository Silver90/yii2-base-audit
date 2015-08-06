<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],

    'components' => [

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'ZlYrYBIMC4jhXl7gPyQeVq7tn1XNA1hO',
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
            'class' => '\bedezign\yii2\audit\components\web\ErrorHandler',
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
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,

    'modules' => [
        'audit' => [
            'class' => 'bedezign\yii2\audit\Audit',
            // the layout that should be applied for views within this module
            'layout' => 'main',
            // Name of the component to use for database access
            'db' => 'db',
            // List of actions to track. '*' is allowed as the last character to use as wildcard
            'trackActions' => ['*'],
            // Actions to ignore. '*' is allowed as the last character to use as wildcard (eg 'debug/*')
            'ignoreActions' => ['audit/*', 'debug/*'],
            // Maximum age (in days) of the audit entries before they are truncated
            'maxAge' => 'debug',
            // IP address or list of IP addresses with access to the viewer, null for everyone (if the IP matches)
            'accessIps' => ['127.0.0.1', '192.168.*'],
            // Role or list of roles with access to the viewer, null for everyone (if the user matches)
            'accessRoles' => ['admin'],
            // User ID or list of user IDs with access to the viewer, null for everyone (if the role matches)
            'accessUsers' => [1, 2],
            // Compress extra data generated or just keep in text? For people who don't like binary data in the DB
            'compressData' => true,
            // The callback to use to convert a user id into an identifier (username, email, ...). Can also be html.
            'userIdentifierCallback' => ['app\models\User', 'userIdentifierCallback'],
            // If the value is a simple string, it is the identifier of an internal to activate (with default settings)
            // If the entry is a '<key>' => '<string>|<array>' it is a new panel. It can optionally override a core panel or add a new one.
            'panels' => [
                'audit/javascript',
                'audit/mail',
                'audit/request',
                'audit/error',
                'audit/trail',
                'app/views' => [
                    'class' => 'app\panels\ViewsPanel',
                    // ...
                ],
            ],
            'panelsMerge' => [
                'app/views' => [
                    'class' => 'app\panels\ViewsPanel',
                ],
            ]
        ],
    ],
];


if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
