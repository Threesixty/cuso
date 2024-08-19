<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'genesys-backend',
    'name' => 'Portail du club utilisateurs de solutions Genesys et Interactions CX',
    'basePath' => dirname(__DIR__),
    'language' => 'fr',
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-genesys-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'authTimeout' => 3600, // auth expire 
            'identityCookie' => ['name' => '_identity-genesys-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'session-genesys-backend',
            'class' => 'yii\web\Session',
            'cookieParams' => ['httponly' => true, 'lifetime' => 3600*4],
            'timeout' => 3600*4, //session expire
            'useCookies' => true,
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
        'assetManager' => [
            'assetMap' => [
                'gfonts.css' => '//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700',
                'dataTables.css' => '//cdn.datatables.net/2.1.4/css/dataTables.dataTables.css',
                'buttons.dataTables.css' => '//cdn.datatables.net/buttons/3.1.1/css/buttons.dataTables.css',
                'masonry-layout.js' => '//cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js',
                'dataTables.js' => '//cdn.datatables.net/2.1.4/js/dataTables.js',
                'dataTables.buttons.js' => '//cdn.datatables.net/buttons/3.1.1/js/dataTables.buttons.js',
                'jszip.min.js' => '//cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js',
                'buttons.html5.min.js' => '//cdn.datatables.net/buttons/3.1.1/js/buttons.html5.min.js',
                'buttons.colVis.min.js' => '//cdn.datatables.net/buttons/3.1.1/js/buttons.colVis.min.js',
                'dataTables.select.js' => '//cdn.datatables.net/select/2.0.5/js/dataTables.select.js',
                'select.dataTables.js' => '//cdn.datatables.net/select/2.0.5/js/select.dataTables.js',
            ],
            'bundles' => [
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js'=>[]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],
            ],
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
        'urlManagerFrontend' => [
            'class' => 'codemix\localeurls\UrlManager',
            'languages' => ['fr'],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableLanguageDetection' => true,
            'enableDefaultLanguageUrlCode' => true,
            'normalizer' => [
                'class' => 'yii\web\UrlNormalizer',
                'collapseSlashes' => true,
            ],
            'rules' => [
                '' => 'site/index',
                [
                    'pattern'      => '<url:[0-9a-zA-Z\-\/]+>',
                    'route'        => 'site/content',
                    'encodeParams' => false,
                ],
            ],
        ],
    ],
    'params' => $params,
];
