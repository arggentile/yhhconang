<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'db' => $db,
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
    ],
    'params' => $params,
    'modules' => [
        'user' => [
            'class' => Da\User\Module::class,
        ],
        'audit' => [
            'class' => 'bedezign\yii2\audit\Audit',
            'db' => 'db',
            'ignoreActions' => ['audit/*', 'debug/*'],
            'accessIps' => ['*'],
            'accessUsers' => ['*', 'adminAudit', '2'], // TO-DO:id del usuario assert, separar en config
            //'accessRoles' => , 
            //'userIdentifierCallback' => ['app\modules\usuarios\models\SegUsuario', 'userIdentifierCallback'],
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
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'app\tests\fixtures'
        ],
        'migrate' => [
            'class' => \yii\console\controllers\MigrateController::class,
            'migrationPath' => [
                '@app/migrations',
                '@app/modules/common/migrations',
                '@yii/rbac/migrations'
            ],
            'migrationNamespaces' => [
                'bedezign\yii2\audit\migrations',
                'Da\User\Migration'
            ]
        ],
        'sincronizacion-empleados' => [
            'class' => 'app\commands\SincronizacionEmpleadosController'
        ],
        'sincronizacion-organismos' => [
            'class' => 'app\commands\SincronizacionOrganismosController'
        ],
    ]
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
