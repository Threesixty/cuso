<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'cuso-backend',
    'name' => 'Clubs Utilisateurs Oracle',
    'basePath' => dirname(__DIR__),
    'language' => 'fr',
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-cuso-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'authTimeout' => 3600, // auth expire 
            'identityCookie' => ['name' => '_identity-cuso-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'session-cuso-backend',
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
                'masonry-layout.js' => '//cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js',
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
            'languages' => ['fr', 'en', 'de'],
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
