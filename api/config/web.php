<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'PZa2hZnGqiaW7T2lFbFXBoYM21-Y2XMo',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
                    'maxFileSize' => 10240 * 5, // 50M
                    'maxLogFiles' => 10
                ],
            ],
        ],
        'db' => $db,
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages', // if advanced application, set @frontend/messages
                    'sourceLanguage' => 'es',
                    'fileMap' => [
                    //'main' => 'main.php',
                    ],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [   
                'audit' => 'audit',    
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => ['api/establecimiento'],
                    'pluralize' => false,
                    'extraPatterns' => [
                        'OPTIONS view' => 'view',
                        'GET view/{id}' => 'view',
                        //agregamos estas lineas si queres omitir el ? en la url y paamos los parametros por url pero es al pedo
                        'OPTIONS vista' => 'view',
                        'GET vista/{id}' => 'view',
                        
                    ],
                ],
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
                
            ],
        ],
    ],
    'params' => $params,
    
    'modules' => [
        'api' => [
            'class' => 'app\modules\api\v1\Module',
        ],
        
        'user' => [
            'class' => Da\User\Module::class,
            'enableEmailConfirmation' => false,
            'allowUnconfirmedEmailLogin' => true,
            'administrators' => ['gestorUsuarios','adminAudit','test'],
            'administratorPermissionName'=>'gestorUsuarios',
        // ...other configs from here: [Configuration Options](installation/configuration-options.md), e.g.
        // 'administrators' => ['admin'], // this is required for accessing administrative actions
        // 'generatePasswords' => true,
        // 'switchIdentitySessionKey' => 'myown_usuario_admin_user_key',
        ],
        'audit' => [
            'class' => 'bedezign\yii2\audit\Audit',
            'db' => 'db',
            'ignoreActions' => ['audit/*', 'debug/*'],
            'accessIps' => ['*'],
            'accessUsers' => ['*', 'adminAudit', '2', '3', '4','5'], // TO-DO:id del usuario assert, separar en config
            //'accessRoles' => , 
            'userIdentifierCallback' => ['app\modules\ui\models\User', 'userIdentifierCallback'],
            //'userFilterCallback' => ['app\modules\usuarios\models\SegUsuario', 'userFilterCallback'],
            'logConfig' => [
                'levels' => YII_DEBUG ? ['error', 'warning', 'info', 'trace'] : ['error', 'warning'],
            ],
            'maxAge' => '14',
            'panels' => [
                'audit/request',
                'audit/log',
                'audit/mail',
                'audit/trail',
                'audit/error', // Links the extra error reporting functions (`exception()` and `errorMessage()`)
                'audit/extra', // Links the data functions (`data()`)
            ]
        ],        
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*', '127.0.0.1', '::1', '192.168.89.1'],
        
    ];
}

return $config;
