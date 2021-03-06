<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'v1' => [
            'class' => 'backend\modules\v1\Module',
        ],
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'request'=> [
            'parsers'=> ['application/json' => 'yii\web\JsonParser',]
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            // uncomment if you want to cache RBAC items hierarchy
            // 'cache' => 'cache',
        ],
        'urlManager' => [
           // 'baseUrl' => 'http://gfast:8060',
          //  'hostInfo' => 'http://gfastbackend',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,

            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/user'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/guitarrasapi'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/guitarras'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/carrinho'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/favoritos'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/subcategorias', 'extraPatterns' => [ 'GET {id}/guitarras' => 'guitarra',], ],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/categorias', 'extraPatterns' => [
                    'GET {id}/subcategorias' => 'subcategorias',
                ],],
               // 'pluralize' => false,

            ],
        ],
    ],

];
